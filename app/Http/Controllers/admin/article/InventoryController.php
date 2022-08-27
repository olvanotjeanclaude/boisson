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

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();
        $articles = SupplierOrders::UniqueArticles("products");
        $packages = SupplierOrders::UniqueArticles("packages");

        if (isset($request->start_date)) {
            $between[0] = $request->start_date;
        }
        if (isset($request->end_date)) {
            $between[1] = $request->end_date;
        }

        $inventories = Inventory::orderBy("date")->get();

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

        $submitAjustmentBtn = "<button type='submit' class='btn btn-outline-primary'>Demandee L'Ajustement</button>";

        // dd($stocks);
        return response()->json([
            "stock" => $stock,
            "messages" => $messages,
            "submitAjustmentBtn" => $stock && $stock->difference != 0 ? $submitAjustmentBtn : ""
        ]);
    }

    public function getAdjustStockForm(Request $request)
    {
        // dd($request->all());
        $article = Articles::getArticleByReference($request->article_ref);
        abort_if(is_null($article), 404);

        return view("admin.inventaire.create", compact("article"));
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
                "inventorieable_id" => $article->id,
                "inventorieable_type" => get_class($article),
                "date" => $stock->date,
            ],[
                "unique_id" => generateInteger(8),
                "real_quantity" => $stock->real_quantity,
                "difference" => $stock->difference,
                "motif" => $request->motif,
                "user_id" => auth()->user()->id,
                "status" =>Inventory::STATUS["pending"]
            ]);

            if ($saved) {
                return back()->with("success", "Demande envoyé avec success");
            }
        }
        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function adjustStock(Request $request)
    {
        dd($request->all());
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
