<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class StockOutController extends Controller
{
    public function getValidOutForm(Inventory $inventory, Request $request)
    {

        $article = $inventory->article;

        abort_if(is_null($article), 404);

        return view("admin.inventaire.valid-out-form", compact("article", "inventory"));
    }
    
    public function storeOut(Request $request)
    {
        $request->validate(["article_reference", "quantity", "motif", "numeric"]);

        $stocks = Stock::between();
        $stock = $stocks->where("article_ref", $request->article_reference)->first();
        $article = Stock::getArticleByReference($request->article_reference);

        if ($article) {
            if ($stock) {
                if ($request->quantity > $stock->final) {
                    $errors = "Article $article->designation insuffisant!";
                }
            } else {
                $errors = ucfirst($article->designation) . " n'existe pas dans le stock";
            }

            if (isset($errors)) {
                return back()->withErrors(["errors" => $errors]);
            }

            $saved = $this->storeInventory($article, $stock);

            if ($saved) {
                return back()->with("success", CustomMessage::Success("Stock"));
            }
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }

    private function storeInventory($article, $stock)
    {
        $request = request();

        return   Inventory::updateOrcreate([
            "article_reference" => $article->reference,
            "article_id" => $article->id,
            "article_type" => get_class($article),
            "date" => now()->toDateString(),
        ], [
            "unique_id" => generateInteger(8),
            "out" => $request->quantity,
            "real_quantity" => 0,
            "difference" => 0,
            "motif" => $request->motif,
            "user_id" => auth()->user()->id,
            "status" => Inventory::STATUS["pending"]
        ]);
    }

    public function validStockOut(Inventory $inventory, Request $request)
    {
        abort_if(is_null($inventory->article), 404);
        $updated = false;

        switch ($request->status) {
            case Inventory::STATUS["accepted"]:
                $article = $inventory->article;
                $between = [Stock::MinDate($inventory->date), $inventory->date];
                $stock = Stock::between($between)->where("article_ref", $article->reference)->first();

                if ($stock) {
                    $updated =  Stock::create([
                        "article_reference" => $article->reference,
                        "stockable_id" => $article->id,
                        "stockable_type" => get_class($article),
                        "date" => now()->toDateString(),
                        "entry" => -$inventory->out,
                        "user_id" => auth()->user()->id,
                        "inventory_id" => $inventory->id
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
}
