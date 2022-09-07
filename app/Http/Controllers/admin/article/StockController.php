<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use App\Models\Product;

use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();
        $articles = Product::orderBy("designation")->get();
        // $emballages = Emballage::orderBy("designation")->get();
        $emballages = [];

        if (isset($request->start_date)) {
            $between[0] = $request->start_date;
        }
        if (isset($request->end_date)) {
            $between[1] = $request->end_date;
        }

        $stocks = Stock::between($between)->sortBy("designation");
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

    public function store(Request $request)
    {
        $article = Stock::getArticleByReference($request->article_reference);

        if ($article) {
            Stock::create([
                "article_reference" => $request->article_reference,
                "stockable_id" => $article->id,
                "stockable_type" => get_class($article),
                "date" => now()->toDateString(),
                "entry" => $request->quantity,
                "user_id" =>auth()->user()->id
            ]);

            return back()->with("success", CustomMessage::Success("Stock"));
        }

        return back()->with("error", "Erreur inattendue. Peut être que l'article a été supprimé.");
    }
}
