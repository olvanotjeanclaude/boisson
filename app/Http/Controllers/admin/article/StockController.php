<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Emballage;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Articles\FormatRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();
        $articles = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();
        // $emballages = [];

        if (isset($request->start_date)) {
            $between[0] = $request->start_date;
        }
        if (isset($request->end_date)) {
            $between[1] = $request->end_date;
        }

        $stocks = Stock::between($between)
            ->filter(function ($stock) {
                return $stock->designation == "article";
            });
        // ->where("type","LIKE","%consignation%");
        // $stocks = [];
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

    public function getData(Request $request)
    {
        $between = Stock::getDefaultBetween();
        if (isset($request->start_date)) {
            $between[0] = $request->start_date;
        }
        if (isset($request->end_date)) {
            $between[1] = $request->end_date;
        }

        $stocks = Stock::between($between);
        // dd($stocks);
        $datatables = DataTables::of($stocks);

        return $datatables->make();
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
