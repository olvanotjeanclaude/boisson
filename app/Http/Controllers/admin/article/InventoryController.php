<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $between = Stock::getDefaultBetween();
        
        if(isset($request->start_date)){
            $between[0] = $request->start_date;
        }
        if(isset($request->end_date)){
            $between[1] = $request->end_date;
        }

        $stocks = Stock::between($between)->filter(function ($stock) {
            return $stock->article_type != "App\Models\Emballage";
        });

        // dd($stocks);
        $stocks =[];

        return view("admin.inventaire.index", compact("stocks"));
    }

    public function checkStock (Request $request){
        return response()->json($request->all());
    }
}
