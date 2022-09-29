<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Printing\StockOut;

class StockOutController extends Controller
{
    public function index()
    {
        $stockOuts = Stock::outs();
        return view("admin.stock-out.index", [
            "stockOuts" => $stockOuts
        ]);
    }

    public function create()
    {
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.stock-out.create", compact("articles", "emballages"));
    }

    public function show($invoiceNumber)
    {
        $stocks = Stock::whereInvoiceNumber($invoiceNumber)->get();
        $stock = $stocks->first();

        return view("admin.stock-out.show", compact("stocks", "stock"));
    }

    public function print($invoiceNumber,StockOut $document)
    {
        return $document->print($invoiceNumber);
    }

    public function download($invoiceNumber, StockOut $document)
    {
       return $document->download($invoiceNumber);
    }

    public function store(Request $request)
    {
        $request->validate([
            "article_reference" => "required",
            "date" => "required",
            "out" => "required|numeric",
            "comment" => "required"
        ]);

        $stocks = Stock::EntriesOuts();
        $stock = $stocks->where("reference", $request->article_reference)->first();
        $article = Stock::getArticleByReference($request->article_reference);

        if ($article) {
            if ($stock) {
                if ($request->out > $stock->final) {
                    $errors = "Article $article->designation insuffisant!";
                }
            } else {
                $errors = ucfirst($article->designation) . " n'existe pas dans le stock";
            }

            if (isset($errors)) {
                return back()->withErrors(["errors" => $errors])->withInput();
            }

            $data = [
                "invoice_number" => generateInteger(7),
                "status" => Stock::STATUS["pending"],
                "article_reference" => $article->reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "out" => $request->out,
                "user_id" => auth()->user()->id,
                "action_type" => Stock::ACTION_TYPES["sample_out"],
                "date" => $request->date,
                "comment" => $request->comment
            ];

            $saved = Stock::create($data);

            if ($saved) {
                return redirect("/admin/sorti-stocks")->with("success", CustomMessage::Success("Sorti de stock"));
            }
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }

    public function validStockOut($invoiceNumber, StockOut $document)
    {
        return $document->valid($invoiceNumber);
    }

    public function cancel($invoiceNumber,StockOut $document)
    {
        return $document->cancel($invoiceNumber);
    }
}
