<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\SupplierOrders;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index(){
        $stocks = Stock::orderBy("id","desc")->get();
        
        $magasins = DB::table('supplier_orders')
        ->whereDate("date","<",date("Y-m-d"))
        ->selectRaw('SUM(quantity) as sum_article,article_reference,article_id,article_type, received_at')
        ->groupBy('article_type')
        ->get();
        $magasins = [];
        foreach ($magasins as $magasin) {
            $modelArticle = $magasin->article_type;
            $article= $modelArticle::find($magasin->article_id);
            // dd($magasin);
            if($article){
                // Stock::create(
                //     [
                //     "article_reference" =>$article->reference,
                //     "stockable_id" =>$article->id,
                //     "stockable_type" =>get_class($article),
                //     "initial" =>$magasin->sum_article
                // ]);
            }
        }
        
        // dd($magasins);
        return view("admin.stock.index",compact("stocks"));
    }
}
