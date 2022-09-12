<?php

namespace App\Http\Controllers\admin\filter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function filterArticle(Request $request){
        dd($request->all());
    }
}
