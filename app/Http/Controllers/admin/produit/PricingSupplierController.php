<?php

namespace App\Http\Controllers\admin\produit;

use App\helper\Columns;
use App\Models\Package;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Emballage;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Models\PricingSuplier;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PricingSupplierController extends Controller
{
    public function index()
    {
        $tarifs = PricingSuplier::has("product")->orderBy("id", "desc")->get();

        $columns = json_encode(Columns::format_columns($this->getColumns()));

        return view("admin.tarif_supplier.index", compact("tarifs", "columns"));
    }

    public function ajaxPostData(Request $request)
    {
        // dd($request->all());
        $keyword = $request->search["value"];

        $tarifs = PricingSuplier::has("user")
            ->whereHas("supplier", function ($query) use ($keyword) {
                return $query->where("identification", "LIKE", "%$keyword%");
            })
            ->orWhere(function ($query) use ($keyword) {
                return \App\Traits\Articles::search($query,"product", $keyword);
            })
            ->orderBy("id", "desc");

        // if ($request->ajax()) {
        return DataTables::of($tarifs)
            ->setRowId(fn ($tarif) => "row_$tarif->id")
            ->addColumn("fournisseur", function (PricingSuplier $tarif) {
                return $tarif->supplier ?  $tarif->supplier->identification  : '';
            })
            ->addColumn("article", fn ($tarif) =>$tarif->product? $tarif->product->designation:"")
            ->addColumn("date", fn ($tarif) => format_date($tarif->created_at))
            ->addColumn("buying_price", fn ($tarif) => formatPrice($tarif->buying_price))
            ->addColumn('action', function ($tarif) {
                $actionBtns = Columns::actionColumns(
                    $tarif,
                    route('admin.tarif-fournisseurs.edit', $tarif['id']),
                    route('admin.tarif-fournisseurs.destroy', $tarif['id']),
                );

                return $actionBtns;
            })
            ->filterColumn('suppliers.identification', function ($query, $keyword) {
                $query->whereRaw("suppliers.identification like ?", ["%{$keyword}%"]);
            })
            ->rawColumns(["action"])
            ->make(true);
        // }
    }

    public function create()
    {
        $suppliers = Supplier::orderBy("identification")->get();
        $products = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.tarif_supplier.create", compact(
            "products",
            "suppliers",
            "emballages"
        ));
    }

    public function edit(PricingSuplier $pricingSuplier)
    {
        $suppliers = Supplier::orderBy("identification")->get();
        $products = Product::orderBy("designation")->get();
        $emballages = Emballage::orderBy("designation")->get();

        return view("admin.tarif_supplier.edit", compact("products", "suppliers", "emballages", "pricingSuplier"));
    }

    private function rules()
    {
        return [
            "supplier_id" => "required",
            "article_reference" => "required",
            "buying_price" => "required",
        ];
    }

    public function store(Request $request)
    {
        $request->validate($this->rules());
        $article = PricingSuplier::getArticleByReference($request->article_reference);

        abort_if(is_null($article), 404);

        if ($article) {
            $saved = $this->syncPrice($article);

            if ($saved) {
                return redirect("/admin/tarif-fournisseurs")->with("success", CustomMessage::Success("Tarif fournisseur"));
            }
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }


    public function update(PricingSuplier $product, Request $request)
    {
        return $this->store($request);
    }

    public function destroy(PricingSuplier $pricingSuplier)
    {
        $result = [];

        if ($pricingSuplier->delete()) {
            $result["success"] = CustomMessage::Delete("Tarif fournisseur");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }

    private function syncPrice($article)
    {
        $request = request();

        return PricingSuplier::updateOrcreate(
            [
                "supplier_id" => $request->supplier_id,
                "article_reference" => $request->article_reference,
                "article_id" => $article->id,
                "article_type" => get_class($article),
            ],
            [
                "buying_price" => $request->buying_price,
                "note" => $request->note,
                "user_id" => auth()->user()->id,
            ]
        );
    }

    private function getColumns()
    {
        return ["fournisseur", "article", "buying_price", "date", "action"];
    }
}
