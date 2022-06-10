<?php

namespace App\Http\Controllers\admin\article;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $stocks = Stock::orderBy("id","desc")->get();

        return view("admin.stock.index",compact("stocks"));
    }
}
