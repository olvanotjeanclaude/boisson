<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\helper\Columns;
use App\Models\Product;
use App\Traits\Articles;
use App\Models\Emballage;
use App\Models\Inventory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Stock::EntriesOuts();
        $between = Stock::getDefaultBetween();
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();
        $columns = Columns::format_columns($this->getColumns());
        $columns = json_encode($columns);

        return view("admin.inventaire.index", compact(
            "stocks",
            "articles",
            "emballages",
            "columns",
            "between"
        ));
    }

    public function ajaxPostData(Request $request)
    {
        $keyword = $request->search["value"];

        $inventories = Inventory::orWhere(function ($query) use ($keyword) {
            return \App\Traits\Articles::search($query, "article", $keyword);
        })
            ->orderBy("date", "desc")
            ->orderBy("id", "desc");


        // if ($request->ajax()) {
        return DataTables::of($inventories)
            ->setRowId(fn ($inventory) => "row_$inventory->id")
            ->addColumn("status", fn ($inventory) => $inventory->status_html)
            ->addColumn("sortie", fn ($inventory) => $inventory->out)
            ->addColumn("ecart", fn ($inventory) => $inventory->difference)
            ->addColumn("date", fn ($inventory) => format_date($inventory->date))
            ->addColumn("designation", fn ($inventory) => Str::upper($inventory->article->designation))
            ->addColumn('action', function ($inventory) {
                if ($inventory->out > 0) {
                    $route = route('admin.inventaires.getValidOutForm', $inventory->id);
                } else {
                    $route = route('admin.inventaires.getAdjustStockForm', $inventory->id);
                }

                $show = '<a class="btn btn-info" href="' . $route . '">
                            <i class="la la-eye"></i>
                            Voir
                        </a>';

                return $show;
            })
            // ->orderColumn('status', 'status $1')
            ->rawColumns(["status", "action"])
            ->make(true);
        // }
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
        $stockDiff = $this->getStockDifference(
            $request->date,
            $request->article_reference,
            $request->real_quantity
        );
        // dd($stockDiff);
        $stock = $stockDiff["stock"] ?? null;
        $article = $stockDiff["article"] ?? null;

        if ($stock && $article) {
            $saved = Inventory::create([
                "article_reference" => $article->reference,
                "article_id" => $article->id,
                "article_type" => get_class($article),
                "date" => $stock->date,
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
        abort_if(is_null($inventory->article), 404);
        $updated = false;

        switch ($request->status) {
            case Inventory::STATUS["accepted"]:
                $article = $inventory->article;
                $between = [Stock::MinDate($inventory->date), $inventory->date];
                $stock = Stock::EntriesOuts($between);
                $stock = $stock->where("reference", $article->reference)->first();

                // dd($stock, $inventory);

                if ($stock) {
                    $entry = $inventory->difference > 0 ? $inventory->difference : 0;
                    $out = $inventory->difference < 0 ? abs($inventory->difference) : 0;
                   
                    $updated =  Stock::create([
                        "inventory_id" => $inventory->id,
                        "status" => Stock::STATUS["accepted"],
                        "article_reference" => $article->reference,
                        "stockable_id" => $article->id,
                        "stockable_type" => get_class($article),
                        "entry" => $entry,
                        "out" => $out,
                        "user_id" => $inventory->user_id,
                        "action_type" => Stock::ACTION_TYPES["new_stock"],
                        "date" => $inventory->date,
                    ]);

                    if ($updated) {
                        $inventory->update(["status" => Inventory::STATUS["accepted"]]);
                        return redirect("/admin/inventaires")->with("success", "Stock a ete ajuste avec success!");
                    }
                }

                return back()->withErrors(["errors" => "Veuillez faire un bon de commande!"]);
                break;
            case Inventory::STATUS["pending"]:
                $inventory->stock()->delete();
                $updated = $inventory->update(["status" => Inventory::STATUS["pending"]]);
                break;
            case Inventory::STATUS["canceled"]:
                $inventory->stock()->delete();
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
                $article_ref = '<input type="hidden" value="' . $stock->reference . '"
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
        if (!$date) {
            $date = date("Y-m-d");
        }
        if ($article) {
            $between = [Stock::MinDate($date), $date];
            $stock = Stock::EntriesOuts($between);
            $stock = $stock->where("reference", $article->reference)->first();
            // dd($stock);

            if ($stock) {
                $stock->date = $date;
                $stock->real_quantity = $realQtt;
                $stock->difference = $stock->real_quantity - $stock->final;
                $difference = abs($stock->difference);

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

    private function getColumns()
    {
        return ["status", "date", "designation",  "ecart", "action"];
    }
}
