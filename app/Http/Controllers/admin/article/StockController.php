<?php

namespace App\Http\Controllers\admin\article;

use App\Articles\FormatRequest;
use App\Models\Stock;
use App\Models\Product;

use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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

        $stocks = Stock::between($between);
        // $stocks = [];
        // dd($stocks);
        $bottles = [];

        return view("admin.stock.index", compact(
            "articles",
            "emballages",
            "stocks",
            "bottles",
            "between"
        ));
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
