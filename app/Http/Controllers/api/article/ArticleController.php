<?php

namespace App\Http\Controllers\api\article;

use App\Http\Controllers\Controller;
use App\Models\Emballage;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index($type, Request $request)
    {
        switch ($type) {
            case '1':
                $articles = Product::orderBy("designation")->get();
                break;
            case '2':
                $articles = Emballage::orderBy("designation")->get();
                break;
            case '3':
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
}
