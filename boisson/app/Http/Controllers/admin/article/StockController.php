<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\helper\Filter;
use App\Models\Product;
use App\Models\Emballage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Articles\StockRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();
        // $emballages = [];
        // dd($between);
        $stocks = $this->getData()["stocks"];
        // dd($stocks);
        $collumns = [
            ["data" => "article_ref"],
            ["data" => "type"],
            ["data" => "designation"],
            ["data" => "sum_entry"],
            ["data" => "sum_out"],
            ["data" => "final"],
        ];

        $collumns = json_encode($collumns);

        return view("admin.stock.index", compact(
            "articles",
            "emballages",
            "stocks",
            "between",
            "collumns"
        ));
    }

    public function getData()
    {
        $between = Stock::getDefaultBetween();
        $startDate = request()->get("start_date") ?? $between[0];
        $endDate = request()->get("end_date") ?? $between[1];
        $filterType = request()->get("filter_type") ?? Filter::TYPES["tout"];
        $between = [$startDate, $endDate];
        $keyword = strtolower(request()->get("chercher"));

        $stocks = Stock::entriesOuts($between);

        if ($filterType != "tout") {
            $stocks = $stocks->filter(function ($stock) use ($filterType) {
                return $stock->type == $filterType;
            });
        }

        if ($keyword) {
            $stocks = $stocks->filter(function ($stock) use ($keyword) {
                $designation = strtolower($stock->designation);
                return $stock->reference == $keyword ||  Str::contains($designation, $keyword);
            });
        }

        return [
            "stocks" => $stocks,
            "between" => $between,
        ];
    }

    public function printReport()
    {
        // return view('admin.stock.invoice',  $this->getDocumentData());
        $pdf = Pdf::loadView('admin.stock.invoice',  $this->getDocumentData());

        return $pdf->stream();
    }

    private function getDocumentData()
    {
        $data = $this->getData();
        $stocks = $data["stocks"];
        $between = $data["between"];

        return [
            "stocks" => $stocks,
            "sum_quantity" => $stocks->sum("final"),
            "between" => $between
        ];
    }

    public function create()
    {
        abort(404);
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.stock.create", compact("articles", "emballages"));
    }


    public function store(Request $request)
    {
        abort(404);
        $datas = StockRequest::All();
       
        if (count($datas)) {
            foreach ($datas as $data) {
                Stock::create($data);
            }
            return back()->with("success", CustomMessage::Success("Stock"));
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }
}
