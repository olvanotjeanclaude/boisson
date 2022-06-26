<?php

namespace App\Http\Controllers\api\article;

use App\Http\Controllers\Controller;
use App\Models\Emballage;
use App\Models\Package;
use App\Models\PricingSuplier;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($type)
    {
        $type = Stock::ARTICLE_TYPES[$type] ?? 0;

        switch ($type) {
            case 'article':
                $articles = Product::orderBy("designation")->get();
                break;
            case 'emballage':
                $articles = Emballage::orderBy("designation")->get();
                break;
            case 'deconsignation':
                $articles = Emballage::orderBy("designation")->get();
                break;
            case "groupe d'article":
                $articles = Package::orderBy("designation")->get();
                break;
            default:
                $articles = [];
                break;
        }

        return response()->json($articles);
    }

    public function show($reference, Request $request)
    {
        $articleDigit = strlen($reference);

        switch ($articleDigit) {
            case '6':
                $article = Product::orderBy("designation")->where("reference", $reference)->first();
                break;
            case '5':
                $article = Emballage::orderBy("designation")->where("reference", $reference)->first();
                break;
            case '4':
                $article = Package::orderBy("designation")->where("reference", $reference)->first();
                break;
            default:
                $article = null;
                break;
        }

        return response()->json($article);
    }

    public function getArticleBySupplier($supplier_id)
    {
        $articles = [
            "articles" => [],
            "emballages" => [],
        ];

        $datas = PricingSuplier::has("supplier")
            ->whereHasMorph(
                'product',
                [Product::class, Package::class,Emballage::class]
            )
            ->where("supplier_id", $supplier_id)
            ->groupBy("article_type","article_id")-> get();

        $emballages = PricingSuplier::Emballages($supplier_id);

        if (count($datas)) {
            foreach ($datas as $pricing) {
                if ($pricing && $pricing->product) {
                    $articles["articles"][] = $pricing->product;
                }
            }
        }

        if (count($emballages)) {
            foreach ($emballages as $pricing) {
                // dd($pricing);
                if ($pricing) {
                    $articles["emballages"][] = $pricing;
                }
            }
        }

       
        return response()->json($articles);
    }
}
