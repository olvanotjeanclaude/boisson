<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/category-articles",[App\Http\Controllers\admin\article\CategoryArticleController::class,"allCategories"]);
Route::get("/get-articles/{type}",[App\Http\Controllers\api\article\ArticleController::class,"index"]);
Route::get("/get-article/{article_id}",[App\Http\Controllers\api\article\ArticleController::class,"show"]);
Route::get("supplier/{supplier_id}/articles/{type}",[App\Http\Controllers\api\article\ArticleController::class,"getArticleBySupplier"])->name("api.getArticleBySupplier");

