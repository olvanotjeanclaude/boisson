<?php

namespace App\Http\Controllers\admin\achat;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Articles\StockRequest;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Printing\StockIn;

class AchatFournisseurController extends Controller
{
    public function index()
    {
        $entries = Stock::entries();
       
        return view("admin.achat-supplier.index", compact("entries"));
    }

    public function create()
    {
        $suppliers  = Supplier::orderBy("identification")->get();
        $preInvoices = Stock::preInvoices();

        $amount = $preInvoices->sum("sub_amount");
        // $articles = Product::orderBy("designation")->where("buying_price", ">", 0)->get();
        // $emballages = Emballage::orderBy("designation")->where("buying_price", ">", 0)->get();
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.achat-supplier.create", compact(
            "suppliers",
            "preInvoices",
            "articles",
            "emballages",
            "amount"
        ));
    }

    public function store(Request $request)
    {
        // $request->validate(AchatSupplierValidation::rules(), AchatSupplierValidation::messages());
        $request->validate([
            "article_reference" => isset($request->saveData) ? "" : "required",
            "quantity" =>  isset($request->saveData) ? "" : "required",
            "supplier_id" => isset($request->saveData) ? "required" : "",
            "reference_facture" => isset($request->saveData) ? "required" : "",
            "date" => isset($request->saveData) ? "required" : "",
        ]);

        if (isset($request->saveData)) {
            $invoiceNumber = $this->saveAchat($request);

            if ($invoiceNumber) {
                return redirect("/admin/achat-fournisseurs/$invoiceNumber");
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $stockRequest = StockRequest::All();

        // dd($stockRequest, $request->all());

        if (count($stockRequest)) {
            foreach ($stockRequest as $data) {
                Stock::create($data);
            }
        }

        return back();
    }

    public function saveAutoStock(Request $request)
    {
        $request->validate([
            "entry" => "required|numeric|min:1",
        ]);

        $articles = [];

        if ($request->article_references) {
            foreach ($request->article_references as $reference) {
                $article = Stock::getArticleByReference($reference);
                if ($article) {
                    $articles[] = $article;
                }
            }
        } else {
            $articles  = [...Product::all(), ...Emballage::all()];
        }

        $invoiceNumber = generateInteger(7);

        foreach ($articles as $article) {
            $data = [
                "status" => Stock::STATUS["accepted"],
                "article_reference" => $article->reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "entry" => $request->entry,
                "invoice_number" => $invoiceNumber,
                "user_id" => auth()->user()->id,
                "action_type" => Stock::ACTION_TYPES["new_stock"],
                "date" => now()->toDateString(),
            ];

            Stock::create($data);
        }

        return redirect("admin/stocks")
            ->with("success", CustomMessage::Success("Le stock"));
    }

    public function oldSaveAutoStock(Request $request)
    {
        $request->validate([
            "entry" => "required|numeric|min:1",
        ]);

        $articles = [
            "has_buying_price" => [],
            "doesnt_has_buying_price" => []
        ];

        $noProducts = Product::where("buying_price", 0)->get();
        $noEmballages = Emballage::where("buying_price", 0)->get();
        $noBuyingPrice = [...$noProducts, ...$noEmballages];

        if ($request->article_references) {
            foreach ($request->article_references as $reference) {
                $article = Stock::getArticleByReference($reference);
                if ($article) {
                    if ($article->buying_price > 0) {
                        $articles["has_buying_price"][] = $article;
                    } else {
                        $articles["doesnt_has_buying_price"][] = $article;
                    }
                }
            }
        }

        if (
            $request->entry &&
            !$request->article_references &&
            !$request->buying_price &&
            count($noBuyingPrice)
        ) {
            return back()->withErrors(["Entrer le prix d'achat par defaut pour l'articles qui n'ont pas de prix d'achat"]);
        }

        if (count($articles["doesnt_has_buying_price"]) && !$request->buying_price) {
            $articleDesignations = [];
            foreach ($articles["doesnt_has_buying_price"] as $article) {
                $articleDesignations[] = $article->designation;
            }
            $messages[] = join(" | ", $articleDesignations) . " : pas de prix d'achat!";
            $messages[] = "Veuillez entrer le prix d'achat par defaut";

            return back()->withErrors($messages)->withInput();
        }

        // dd($articles, $request->all());

        $articles = [...Product::all(), ...Emballage::all()];
        $invoiceNumber = generateInteger(7);

        foreach ($articles as $article) {
            $article->update(["buying_price" => $request->buying_price]);

            $data = [
                "status" => Stock::STATUS["accepted"],
                "article_reference" => $article->reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "entry" => $request->entry,
                "invoice_number" => $invoiceNumber,
                "user_id" => auth()->user()->id,
                "action_type" => Stock::ACTION_TYPES["new_stock"],
                "date" => now()->toDateString(),
            ];

            Stock::create($data);
        }

        return redirect("admin/stocks")
            ->with("success", CustomMessage::Success("Le stock"));
    }

    private function saveAchat(Request $request)
    {
        $preInvoices = Stock::preInvoices();
        if (isset($request->saveData) && count($preInvoices)) {
            $invoiceNumber = (string) generateInteger(7);

            foreach ($preInvoices as $key => $preInvoice) {
                $data = [
                    "invoice_number" => $invoiceNumber,
                    "supplier_id" => $request->supplier_id,
                    "reference_facture" => $request->reference_facture,
                    "date" => $request->date,
                    "comment" => $request->comment,
                    "status" => Stock::STATUS["accepted"]
                ];

                $preInvoice->update($data);
            }

            return $invoiceNumber;
        }

        return false;
    }

    public function show($invoiceNumber, StockIn $document)
    {
        return view("admin.achat-supplier.show", $document->getDocData($invoiceNumber));
    }

    public function print($invoiceNumber, StockIn $document)
    {
        return $document->print($invoiceNumber);
    }

    public function download($invoiceNumber, StockIn $document)
    {
        return $document->download($invoiceNumber);
    }

    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);

        $stock->delete();

        return back();
    }

    public function cancel($invoiceNumber, StockIn $document)
    {
        return $document->cancel($invoiceNumber);
    }
}
