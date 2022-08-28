<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Traits\Articles;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Models\SupplierOrders;
use App\Http\Controllers\Controller;
use App\Models\Supplier;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $articles = SupplierOrders::UniqueArticles("products");
        $packages = SupplierOrders::UniqueArticles("packages");

        $inventories = Inventory::has("article")
            ->orderBy("date", "desc")
            ->orderBy("id", "desc")
            ->get();

        // dd($stocks);

        return view("admin.inventaire.index", compact("inventories", "articles", "packages"));
    }

    public function checkStock(Request $request)
    {
        // return response()->json($request->all());

        $stockDiff = $this->getStockDifference(
            $request->date,
            $request->article_reference,
            $request->real_quantity
        );

        $stock = $stockDiff["stock"] ?? null;
        $messages = $stockDiff["messages"] ?? [];

        $submitAjustmentBtn = "<button type='submit' class='btn btn-outline-primary'>Demander L'Ajustement</button>";

        // dd($stocks);
        return response()->json([
            "stock" => $stock,
            "messages" => $messages,
            "submitAjustmentBtn" => $stock && $stock->difference != 0 ? $submitAjustmentBtn : ""
        ]);
    }

    public function getAdjustStockForm(Inventory $inventory, Request $request)
    {

        $article = $inventory->article;

        abort_if(is_null($article), 404);

        return view("admin.inventaire.create", compact("article", "inventory"));
    }

    public function adjustStockRequest(Request $request)
    {
        // dd($request->all(), "eto");
        $stockDiff = $this->getStockDifference(
            $request->date,
            $request->article_reference,
            $request->real_quantity
        );

        $stock = $stockDiff["stock"] ?? null;
        $article = $stockDiff["article"] ?? null;

        if ($stock && $article) {
            $saved = Inventory::updateOrcreate([
                "article_reference" => $article->reference,
                "article_id" => $article->id,
                "article_type" => get_class($article),
                "date" => $stock->date,
            ], [
                "unique_id" => generateInteger(8),
                "real_quantity" => $stock->real_quantity,
                "difference" => $stock->difference,
                "motif" => $request->motif,
                "user_id" => auth()->user()->id,
                "status" => Inventory::STATUS["pending"]
            ]);

            if ($saved) {
                return back()->with("success", "Demande envoyé avec success");
            }
        }
        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function adjustStock(Inventory $inventory, Request $request)
    {
        // dd($inventory);
        abort_if(is_null($inventory->article), 404);
        $updated = false;

        switch ($request->status) {
            case Inventory::STATUS["accepted"]:
                $article = $inventory->article;
                $between = [Stock::MinDate($inventory->date), $inventory->date];
                $supplierOrders = SupplierOrders::ByArticleBetween($article->reference, $between)->get();

                $absGap = abs($inventory->difference);

                // dd($supplierOrders, $inventory,$absGap);

                if (count($supplierOrders) > 0) {
                    if ($inventory->difference > 0) {
                        $supOrder = $supplierOrders->firstOrFail();
                        $newQtt = $supOrder->quantity + $inventory->difference;
                        // dd("Ampio le stock",$supOrder);
                        $updated = $supOrder->update([
                            "quantity" => $newQtt,
                            "isAdjustment" => true,
                            "update_user_id" => auth()->user()->id
                        ]);
                    } else if ($inventory->difference < 0) {
                        $maxSupOrder = $supplierOrders->where("quantity", ">", $absGap)->first();
                        $sameSupOrder = $supplierOrders->where("quantity", $absGap)->first();

                        if ($maxSupOrder) {
                            // dd("anesorana ny quantite le be ndrindra");
                            $updated =  $maxSupOrder->update([
                                "quantity" =>  $maxSupOrder->quantity - $absGap,
                                "isAdjustment" => true,
                                "update_user_id" => auth()->user()->id
                            ]);
                        } else if ($sameSupOrder) {
                            // dd("mtovy ny quantite");
                            $updated = $sameSupOrder->update([
                                "quantity" => 0,
                                "isAdjustment" => true,
                                "update_user_id" => auth()->user()->id
                            ]);
                        } else {
                            $sumGap = 0;
                            $rowIds = [];

                            foreach ($supplierOrders as $supOrder) {
                                $sumGap += $supOrder->quantity;
                                $rowIds[$supOrder->id] = $supOrder->quantity;
                                if ($sumGap >= $absGap) {
                                    break;
                                }
                            }

                            if ($sumGap == $absGap) {
                                // dd("sum anaty array manome an le difference");
                                $updated =  $supplierOrders->whereIn("id", array_keys($rowIds))
                                    ->update([
                                        "quantity" => 0,
                                        "isAdjustment" => true,
                                        "update_user_id" => auth()->user()->id
                                    ]);
                            } else if ($sumGap > 0) {
                                $lastOrder = $supplierOrders->where("id", array_key_last($rowIds))
                                    ->first();

                                $beforeLastOrders = array_slice($rowIds, 0, count($rowIds) - 1);
                                $newQtt = $absGap - array_sum($beforeLastOrders);
                                // dd("le farany atao update an le diffeence", $newQtt);
                                $updated =  $lastOrder->update([
                                    "quantity" => $newQtt,
                                    "isAdjustment" => true,
                                    "update_user_id" => auth()->user()->id
                                ]);
                            }
                        }
                    }

                    if ($updated) {
                        $inventory->update(["status" => Inventory::STATUS["accepted"]]);
                        return redirect("/admin/inventaires")->with("success", "Stock a ete ajuste avec success!");
                    }
                }

                return back()->withErrors(["errors" => "Veuillez faire un bon de commande!"]);
                break;
            case Inventory::STATUS["pending"]:
                $updated = $inventory->update(["status" => Inventory::STATUS["pending"]]);
                break;
            case Inventory::STATUS["canceled"]:
                $updated = $inventory->update(["status" => Inventory::STATUS["canceled"]]);
                break;
            default:
                break;
        }

        if ($updated) {
            return redirect("/admin/inventaires")->with("success", "Inventaire a ete modifie avec success");
        }

        return back()->withErrors(["errors" => "Veuillez faire un bon de commande!"]);
    }


    private function getStockInfoHtml($stock): array
    {
        $messages = [];

        if ($stock) {
            $messages[] = "Entrée : $stock->sum_entry";
            $messages[] = "Sortie : $stock->sum_out";
            $messages[] = "Final : $stock->final";
            $messages[] = "Difference : " . ($stock->difference > 0 ? '+' . $stock->difference : $stock->difference);

            if ($stock->difference != 0) {
                $date = '<input type="hidden" value="' . $stock->date . '"  name="date"/>';
                $article_ref = '<input type="hidden" value="' . $stock->article_reference . '"
                  name="article_reference"/>';
                $realQtt = '<input type="hidden" id="real_quantity"  
                  value="' . $stock->real_quantity . '" 
                  name="real_quantity"/>';
                $textArea = '<label class="label-control mt-1" for="motif">Note</label>';
                $textArea .= "<textarea class='form-control' name='motif' id='motif' required placeholder='Ecrire...'></textarea>";
                $textArea .= '<div class="invalid-feedback">Veuillez entrer le note!</div>';

                $messages[] = $article_ref;
                $messages[] = $date;
                $messages[] = $realQtt;
                $messages[] = $textArea;
            }
        }

        return $messages;
    }

    private function getStockDifference($date, $article_ref, $realQtt)
    {
        $messages = [];

        $article = Articles::getArticleByReference($article_ref);

        if ($article) {
            $stock = Stock::date($date)->filter(function ($stock) {
                return $stock->article_type != "App\Models\Emballage";
            })
                ->where("article_reference", $article->reference)
                ->first();

            if ($stock) {
                $stock->date = $date;
                $stock->real_quantity = $realQtt;
                $stock->difference = $stock->real_quantity - $stock->final;
                $difference = $stock->difference < 0 ? -1 * $stock->difference : $stock->difference;

                if ($stock->difference < 0) {
                    $message = strtoupper($article->designation) . " manque <span class='font-weight-bold text-danger'>$difference</span>";
                } else if ($stock->difference == 0) {
                    $message = strtoupper($article->designation) . " est <span class='text-success font-weight-bold'>bon</span>";
                } else {
                    $message = "Quantité " . strtoupper($article->designation) . " est plus <span class='font-weight-bold text-warning'>$difference</span>";
                }
                $messages[] = "<h4 class='font-weight-bold'>$message</h4>";

                $messages = array_merge($messages, $this->getStockInfoHtml($stock));
            } else {
                $messages[] =  Str::title($article->designation) . " n'exite pas dans le stock!";
            }
        } else {
            $messages[] = "L'article est non disponible";
        }

        return [
            "article" => $article ?? null,
            "stock" => $stock ?? null,
            "messages" => $messages
        ];
    }
}
