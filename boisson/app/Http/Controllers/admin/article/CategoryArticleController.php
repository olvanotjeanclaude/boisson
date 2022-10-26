<?php

namespace App\Http\Controllers\admin\article;

use App\helper\Columns;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Traits\ArticlesAuthorizable;
use Yajra\DataTables\Facades\DataTables;

class CategoryArticleController extends Controller
{
    use ArticlesAuthorizable;

    public function index()
    {
        $columns = Columns::format_columns($this->getColumns());
        $actionBtn =  ["data" => "action", "name" => "action"];

        if (!currentUser()->can("update article")) {
            $actionBtn["visible"] = false;
        }
        $columns[] = $actionBtn;

        // dd($columns);

        return view("admin.article.category.index", [

            "columns" => json_encode($columns)
        ]);
    }

    public function ajaxPostData(Request $request)
    {
        if ($request->ajax()) {
        $columns = ["id", ...$this->getColumns()];

        $catArticles = Category::select($columns)->orderBy("id", "desc");

        return DataTables::of($catArticles)
            ->setRowId(fn ($catArticle) => "row_$catArticle->id")
            ->addColumn("created_at", fn ($catArticle) => format_date_time($catArticle->created_at))
            ->addColumn('action', function ($catArticle) {
                $editUrl = route('admin.category-articles.edit', $catArticle->id);
                $deleteUrl = route('admin.category-articles.destroy', $catArticle->id);

                $actionBtn= '<button data-url="'.$editUrl.'" class="btn btn-info edit-category" data-id="{{ $category->id }}">
                                Editer
                            </button>
                           <button class="btn btn-danger delete-btn"
                              data-url="'.$deleteUrl.'"
                              data-id="'.$catArticle->id.'">
                              Supprimer
                            </button>';

                return $actionBtn;
            })
            // ->orderColumn('status', 'status $1')
            ->rawColumns(["action"])
            ->make(true);
        }
    }

    private function getColumns()
    {
        return ["name", "created_at"];
    }

    public function allCategories()
    {
        $catArticles = Category::select(["id", "name"])->orderBy("id", "desc")->get();
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
