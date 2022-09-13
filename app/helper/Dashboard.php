<?php

namespace App\helper;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Emballage;
use App\Models\DocumentVente;
use Illuminate\Support\Facades\DB;

class Dashboard
{
    public function getSaleDetail($between, $filterType = "all")
    {
        $sales = DB::table("sales")->select([
            "invoice_number", "article_reference", "saleable_id", "saleable_type",
            "received_at",
            "isWithEmballage",
            DB::raw("SUM(sales.quantity) as sum_quantity")
        ])
            // ->where("saleable_type", "App\Models\Product")
            // ->where(fn ($query) => Filter::querySales($query, $filterType))
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->groupBy("sales.article_reference", "sales.invoice_number","isWithEmballage");
        // dd($between, $sales->get());

        return $sales;
    }

    public function getSaleAndPaymentDetails($between, $filterType = "all")
    {
        // $between = [now()->subDays(3)->toDateString(),now()->toDateString()];
        return DB::table("document_ventes")
            ->rightJoinSub($this->getSaleDetail($between, $filterType), "sales", function ($join) {
                $join->on("document_ventes.number", "sales.invoice_number");
            })
            ->select([
                "sales.article_reference",  "sales.saleable_id", "sales.saleable_type",
                "sales.received_at",
                "sales.sum_quantity",
                "sales.isWithEmballage",
                "document_ventes.number",
                "document_ventes.payment_type as payment_type",
                DB::raw("SUM(document_ventes.paid) as sum_paid"),
                DB::raw("SUM(document_ventes.checkout) as sum_checkout"),
            ])
            // ->where(fn ($query) => Filter::querySales($query, $filterType))
            ->where(fn ($query) => Filter::queryBetween($query, $between, "document_ventes.received_at"))
            ->whereNotNull("document_ventes.payment_type")
            ->groupBy("sales.article_reference", "document_ventes.number", "sales.isWithEmballage")
            ->get();
    }

    public function getRecaps($between, $filterType = "all")
    {
        $solds =  $this->getSolds($between, $filterType);
        $articles = $solds->where("saleable_type", "App\Models\Product");
        $consignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", false);;
        $deconsignations = $solds->where("saleable_type", "App\Models\Emballage")
            ->where("isWithEmballage", true);
        //    dd($consignations->toArray(),$deconsignations->toArray());
        return  [
            "Article" => $articles->sum("quantity"),
            "Consignation" => $consignations->sum("quantity"),
            "Deconsignation" => $deconsignations->sum("quantity"),
        ];
    }

    public function mapSalePayment($sale)
    {
        $article = DocumentVente::getArticleByReference($sale->article_reference);

        if ($article) {
            $sale->designation = $article->designation;
            $sale->payment_name = DocumentVente::PAYMENT_TYPES[$sale->payment_type] ?? "-";
        }

        return $sale;
    }

    public function getPaymentTypes($payments)
    {
        $paymentTypes = [];
        foreach (DocumentVente::PAYMENT_TYPES as $key => $name) {
            if (isset($payments[$key])) {
                $payment = $payments[$key];
                $price = $payment->sum("sum_paid");
                $paymentTypes[$name] = formatPrice($price);
            }
        }

        return $paymentTypes;
    }

    public function getSolds($between, $articleType = "all")
    {
        $sales = Sale::whereHasMorph('saleable', [Product::class, Emballage::class])
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->where(function ($query) use ($articleType) {
                switch ($articleType) {
                    case 'article':
                        $query = $query->where("saleable_type", "App\Models\Product");
                        break;
                    case 'consignation':
                        $query = $query->where("saleable_type", "App\Models\Emballage")
                            ->where("isWithEmballage", false);
                        break;
                    case 'deconsignation':
                        $query = $query->where("saleable_type", "App\Models\Emballage")
                            ->where("isWithEmballage", true);
                        break;
                    default:
                        # code...
                        break;
                }
            })
            ->orderBy("saleable_type")
            ->get();
        // ->groupBy(fn ($sale) => $sale->article_reference)
        // ->map(function ($sale, $article_ref) {
        //     return (object)[
        //         "article_reference" => $sale[0]->saleable->reference,
        //         "saleable_type" => $sale[0]->saleable_type,
        //         "saleable_id" => $sale[0]->saleable_id,
        //         "designation" => $sale[0]->saleable->designation,
        //         "pricing" => $sale[0]->pricing,
        //         "sub_amount" => $sale[0]->sub_amount,
        //         "sum_quantity" => $sale->sum("quantity"),
        //     ];
        // });

        // dd($sales);
        return in_array($articleType, Filter::TYPES) ? $sales : collect([]);
    }

    public function getRecettes($sales, $between)
    {
        $solds = $this->getSolds($between);
        return  [
            "sum_amount" => $solds->sum("sub_amount"),
            "sum_paid" => $sales->sum("paid"),
            "sum_checkout" => $sales->sum("checkout"),
            "sum_caisse" => $sales->sum("paid") - $sales->sum("checkout")
        ];
    }

    public function getDocVente($between)
    {
        return DocumentVente::has("sales")
            ->where(fn ($query) => Filter::queryBetween($query, $between));
    }
}
