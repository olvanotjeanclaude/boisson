<?php

namespace App\Http\Controllers\admin\achat;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\AchatSupplierValidation;
use App\Models\Stock;

class AchatFournisseurController extends Controller
{
    public function index()
    {
        return view("admin.achat-supplier.index");
    }

    public function create()
    {
        $suppliers  = Supplier::orderBy("identification")->get();
        $preInvoices = Stock::preInvoices();
        $firstAchat = $preInvoices->first();
        $amount = $preInvoices->sum("sub_amount");
        return view("admin.achat-supplier.create",compact("suppliers","preInvoices","firstAchat","amount"));
    }

    public function store(Request $request)
    {
        // $request->validate(AchatSupplierValidation::rules(), AchatSupplierValidation::messages());
        $request->validate([
            "supplier_id" =>"required",
            "article_reference" =>"required",
            "quantity" =>"required"
        ]);
        if (isset($request->saveData)) {
            $newInvoice = $this->saveAchat($request);

            if ($newInvoice) {
                return redirect()->route("admin.print.achat", $newInvoice->number);
            }

            return back()->with("error", CustomMessage::DEFAULT_ERROR);
        }

        $data = $this->getArticleData(
            $request->article_reference,
            $request->quantity,
            $request
        );

        // dd($data, $request->all());

        if (count($data)) {
            Stock::create($data);
        }

        return back();
    }

    private function saveAchat(Request $request)
    {
        if (isset($request->saveData)) {
        //    dd("...");
        }

        return false;
    }

    private function getArticleData($articleRef, $quantity, $request): array
    {
        $data = [];
        $article = Stock::getArticleByReference($articleRef);
        
        $pricing = $article->supplier_prices()
            ->where("supplier_id", $request->supplier_id)
            ->first();

        if ($article) {
            $data = [
                "article_reference" => $article->reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "supplier_id" => $request->supplier_id,
                "pricing_id" => $pricing->id ?? null,
                "entry" => $quantity ?? 0,
                "user_id" => auth()->user()->id,
                "action_type" => Stock::ACTION_TYPES["new_stock"],
                "date" =>now()->toDateString(),
                "is_pending" =>true
            ];
        }
        return $data;
    }
    
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        
        $stock->delete();

        return back();
    }
}
