<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\helper\Filter;
use App\Models\Product;

use App\Models\Emballage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Articles\FormatRequest;
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
        $stocks = $this->getData();
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
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $between = [$startDate, $endDate];
        $keyword = strtolower(request()->get("chercher"));

        $stocks =  Stock::between($between);

        if ($filterType != "tout") {
            $stocks = $stocks->filter(function ($stock) use ($filterType) {
                return $stock->type == $filterType;
            });
        }

        if ($keyword) {
            $stocks = $stocks->filter(function ($stock) use ($keyword) {
                $designation = strtolower($stock->designation);
                return $stock->article_ref == $keyword ||  Str::contains($designation, $keyword);
            });
        }

        return $stocks;
    }

    public function printReport()
    {
        // return view('admin.stock.invoice',  $this->getDocumentData());
        $pdf = Pdf::loadView('admin.stock.invoice',  $this->getDocumentData());

        return $pdf->stream();
    }

    private function getDocumentData()
    {
        $between = Stock::getDefaultBetween();
        $startDate = request()->get("start_date") ?? date("Y-m-d");
        $endDate = request()->get("end_date") ?? date("Y-m-d");
        $filterType = request()->get("filter_type") ?? Filter::TYPES[0];
        $between = [$startDate, $endDate];
        $keyword = strtolower(request()->get("chercher"));

        $stocks =  Stock::between($between);

        if ($filterType != "tout") {
            $stocks = $stocks->filter(function ($stock) use ($filterType) {
                return $stock->type == $filterType;
            });
        }

        if ($keyword) {
            $stocks = $stocks->filter(function ($stock) use ($keyword) {
                $designation = strtolower($stock->designation);
                return $stock->article_ref == $keyword ||  Str::contains($designation, $keyword);
            });
        }

        return [
            "stocks" => $stocks,
            "sum_quantity" => $stocks->sum("final"),
            "between" => $between
        ];
    }

    public function create()
    {
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.stock.create", compact("articles", "emballages"));
    }


    public function store(Request $request, FormatRequest $formatRequest)
    {
        $article = Stock::getArticleByReference($request->article_reference);
        if ($article) {
            // dd($formatRequest);
            if (get_class($article) == "App\Models\Emballage") {
                $datas[] =  [
                    "article_reference" => $article->reference,
                    "stockable_id" => $article->id,
                    "stockable_type" => get_class($article),
                    "date" => now()->toDateString(),
                    "entry" => $request->quantity,
                    "user_id" => auth()->user()->id
                ];
            } else {
                $datas = array_map(function ($article) {
                    // dd($article);
                    return [
                        "article_reference" => $article["article_reference"],
                        "stockable_id" => $article["saleable_id"],
                        "stockable_type" => $article["saleable_type"],
                        "date" => now()->toDateString(),
                        "entry" => $article["quantity"],
                        "user_id" => auth()->user()->id
                    ];
                }, $formatRequest->getArticleAndConsignation($article->reference, $request->quantity));
            }

            if (count($datas)) {
                foreach ($datas as $data) {
                    Stock::create($data);
                }
                return back()->with("success", CustomMessage::Success("Stock"));
            }
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }
}
