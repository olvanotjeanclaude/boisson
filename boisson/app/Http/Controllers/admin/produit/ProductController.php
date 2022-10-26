<?php

namespace App\Http\Controllers\admin\produit;

use App\Models\Stock;
use App\helper\Columns;
use App\Models\Product;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use App\Traits\ArticlesAuthorizable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Route;

class ProductController extends Controller
{
    use ArticlesAuthorizable;

    public function index()
    {
        // $this->pricing($products);
        $columns = json_encode($this->getFormatedCols());

        return view("admin.approvisionnement.product.index", compact("columns"));
    }

    public function ajaxPostData(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::has("category")->orderBy("id", "desc");

            return DataTables::of($products)
                ->setRowId(fn ($product) => "row_$product->id")
                ->addColumn("price", fn ($product) => formatPrice($product->price))
                ->addColumn("wholesale_price", fn ($product) => formatPrice($product->wholesale_price))
                ->addColumn("cont_or_condition", fn ($product) => $product->contenance ?? $product->condition ?? null)
                ->addColumn("category", fn ($product) =>  $product->category->name)
                ->addColumn('action', function ($product) {
                    $editUrl = route('admin.approvisionnement.articles.edit', $product->id);
                    $deleteUrl = route('admin.approvisionnement.articles.destroy', $product->id);
                    $actionBtn = Columns::actionColumns($product, $editUrl, $deleteUrl);
                    return $actionBtn;
                })
                ->rawColumns(["action"])
                ->make(true);
        }
    }

    private function getFormatedCols(): array
    {
        $columns = Columns::format_columns($this->getColumns());
        $actionBtn = Columns::sampleAction();

        if (!currentUser()->can("update article")) {
            $actionBtn["visible"] = false;
        }

        $columns[] = $actionBtn;

        return $columns;
    }

    public function create()
    {
        $catArticles = Category::orderBy("name", "asc")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.product.create", compact("catArticles", "emballages"));
    }

    public function edit(Product $product)
    {
        $catArticles = Category::orderBy("name")->get();
        $emballages = Emballage::orderBy("designation")->get();
        return view("admin.approvisionnement.product.edit", compact("catArticles", "product", "emballages"));
    }

    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $data = $request->all();

        $data["reference"] = (string) random_int(111111, 999999);
        $data["user_id"] = auth()->user()->id;

        $article = Product::create($data);

        Stock::create([
            "article_reference" => $article->reference,
            "stockable_id" => $article->id,
            "stockable_type" => get_class($article),
            "date" => now()->toDateString(),
            "entry" => 0,
            "user_id" => auth()->user()->id
        ]);

        if ($article) {
            return redirect("/admin/produits/articles")->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update(Product $product, StoreProductRequest $request)
    {
        $data = $request->except("_token");

        $data["update_user_id"] = auth()->user()->id;

        $saved = $product->update($data);

        if ($saved) {
            return back()->with("success", CustomMessage::Success("L'article"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function destroy(Product $product)
    {
        $result = [];

        if ($product->delete()) {
            $result["success"] = CustomMessage::Delete("L'article");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }

    private function pricing($products)
    {
        foreach ($products as $key => $value) {
            $price = $value->price;

            $value->update(["wholesale_price" => $price - 500]);
        }
    }

    private function getColumns()
    {
        return ["reference", "designation", "price", "wholesale_price", "buying_price", "cont_or_condition", "category"];
    }
}
