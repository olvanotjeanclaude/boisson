<?php

namespace App\Http\Controllers\admin\article;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Traits\ArticlesAuthorizable;

class CategoryArticleController extends Controller
{
    use ArticlesAuthorizable;
    
    public function index()
    {
        $catArticles = Category::orderBy("id","desc")->get();

        if(request()->ajax()){
            return response()->json($catArticles);
        }
        
        return view("admin.article.category.index", compact("catArticles"));
    }

    public function allCategories()
    {
        $catArticles = Category::select(["id","name"])->orderBy("id","desc")->get();
        return response()->json($catArticles);
    }

    public function create()
    {
        return view("admin.customer.create");
    }

    private function rules()
    {
        return [
            "name" => "required",
        ];
    }

    private function message()
    {
        return [
            "required" => "Le champ :attribute est obligatoire!"
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules(), $this->message());

        // dd($request->all());
        $data = $request->except("_token");
        $data["user_id"] = auth()->user()->id;
        $saved = Category::create($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Catégorie d'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($catArticle, Request $request)
    {
        $request->validate($this->rules(true), $this->message());

        //dd($request->all());
        $data = $request->except("_token");


        $saved = $catArticle->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("Catégorie d'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit($catArticle)
    {
        return view("admin.article.category.modal.edit-category-article", compact("catArticle"));
    }

    public function destroy($catArticle)
    {
        $delete = $catArticle->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("La catégorie d'article");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}
