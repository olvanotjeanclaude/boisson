<?php

namespace App\Http\Controllers\api\article;

use App\Http\Controllers\Controller;
use App\Models\Emballage;
use App\Models\Package;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Supplier;
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

    public function getArticleBySupplier($supplier_id,$type){
        dd($type);
        $supplier = Supplier::findOrFail($supplier_id);
        $articles = [];

        if(count($supplier->pricings)){
            foreach ($supplier->pricings as $pricing) {
                if($pricing){
                    $data = (object)[
                      "reference" =>$pricing->product->reference,
                      "designation" =>$pricing->product->designation
                    ];
                    $articles[] = $data;
                }
            }
        }
        return response()->json($articles);
    }
}
