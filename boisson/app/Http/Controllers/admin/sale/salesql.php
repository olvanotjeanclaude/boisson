<?php

use Illuminate\Support\Facades\DB;

$docSales = DB::table("document_ventes")
    ->select([
        "document_ventes.status as doc_status",
        "document_ventes.number as doc_number",
        // "customers.identification as cl_name",
        // "customers.code as cl_code",
        DB::raw("CONCAT(customers.code,'-',customers.identification) as customer"),
        DB::raw("COUNT(sales.invoice_number) AS count_sale"),
        // DB::raw("SUM(sales.quantity*sales.price) AS sum_amount"),
        "document_ventes.received_at as doc_date",
        DB::raw("SUM(document_ventes.paid) as sum_paid"),
        DB::raw("SUM(document_ventes.checkout) as sum_checkout"),
        DB::raw("CONCAT(users.name,'-',users.surname) as user"),
    ])
    // ->addSelect(DB::raw("SELECT SUM(sales.quantity*sales.price) FROM sales GROUP BY invoice_number"))
    ->join("sales", "sales.invoice_number", "document_ventes.number")
    ->join("customers", "customers.id", "document_ventes.customer_id")
    ->join("users", "users.id", "document_ventes.user_id")
    ->whereNotNull("document_ventes.received_at")
    ->whereNotNull("sales.received_at")
    ->groupBy("document_ventes.number")
    ->groupBy("document_ventes.customer_id")
    ->groupBy("document_ventes.user_id")
    ->groupBy("document_ventes.received_at")
    ->orderByDesc("document_ventes.received_at");

$docSales = DB::table('document_ventes')
    ->select([
        "status as doc_status",
        "number as doc_number",
        DB::raw("(SELECT CONCAT(code,'-',identification) FROM customers 
                        WHERE customer_id = customers.id) as customer"),
        DB::raw("(SELECT 
                            CASE WHEN isWithEmballage=0 THEN SUM(sales.quantity*sales.price) 
                                                        ELSE -SUM(sales.quantity*sales.price) 
                            END
                            FROM sales 
                            WHERE sales.invoice_number = document_ventes.number AND sales.customer_id=document_ventes.customer_id
                        ) 
                        as sum_amount"),
        "received_at as doc_date",
        DB::raw("SUM(paid) as sum_paid"),
        DB::raw("SUM(checkout) as sum_checkout"),
        DB::raw("(SELECT CONCAT(name,'-',surname) FROM users
                        WHERE users.id=document_ventes.user_id
                ) as user")
    ])
    ->whereNotNull("received_at");

 function dataSales()
    {
        $params = request()->all();
        $search = strtolower($params["search"] ?? "");
        $between = $params["between"] ?? [date("Y-m-d"), date("Y-m-d")];

        if (isset($params["start_date"]) && isset($params["end_date"])) {
            $between = [$params["start_date"], $params["end_date"]];
        }

        $docSales = $this->docSales($params)
            ->where(function ($query) use ($between) {
                $query->where(fn ($query) => Filter::queryBetween($query, $between));
            })
            ->when(is_numeric($search) && strlen($search) == 7, function ($query) use ($search) {
                return $query->where("number", "LIKE", $search);
            })
            ->orderByDesc("id")
            ->groupBy("number")
            ->get()
            ->map(function ($docSale) {
                $status = $docSale->doc_status;
                $customer = explode("-", $docSale->customer);
                $docSale->status =  Sale::getStatusHtml($docSale->doc_status);
                $docSale->action = $this->getActionButtons($docSale);
                $docSale->date = format_date($docSale->doc_date);
                $docSale->cl_code = "CL" . $customer[0] ?? "";
                $docSale->cl_name = strtolower($customer[1] ?? "");
                $docSale->paid = formatPrice($docSale->sum_paid);
                $docSale->checkout = formatPrice($docSale->sum_checkout);
                $docSale->amount = formatPrice($docSale->sum_amount);
                $docSale->rest = $docSale->sum_amount-$docSale->sum_paid;
                return $docSale;
            });

        if (!is_numeric($search) && $search) {
            $docSales = $docSales->filter(function ($sale) use ($search) {
                return Str::startsWith($sale->cl_name, $search);
            });
        }

        $sumAmount =  $docSales->sum("sum_amount");
        $sumPaid =  $docSales->sum("sum_paid");
        $sumCheckout =  $docSales->sum("sum_checkout");
        $customerAmount = $docSales->where("sum_amount",">",0);
     
        return [
            "all" => [...$docSales],
            "between" => $between,
            "columns" => $this->getFormatedCols(),
            "amount" =>  $docSales->sum("sum_amount"),
            "paid" =>$docSales->sum("sum_paid"),
            "checkout" =>   $docSales->sum("sum_checkout"),
            "reste" => $docSales->where("sum_amount",">",0)->sum("rest")
        ];
    }