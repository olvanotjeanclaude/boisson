<?php

namespace App\Http\Controllers\admin\supplier;

use App\helper\Columns;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        $columns = Columns::format_columns($this->getColumns());
        $columns = json_encode($columns);
        return view("admin.supplier.index", compact("columns"));
    }

    public function ajaxPostData(Request $request)
    {
        $suppliers = Supplier::orderBy("id", "desc");

        // if ($request->ajax()) {
        return DataTables::of($suppliers)
            ->setRowId(fn ($supplier) => "row_$supplier->id")
            ->addColumn("code", fn ($supplier) => $supplier->fr_code)
            ->addColumn("telephone", fn ($supplier) => $supplier->phone)
            ->addColumn("date", fn ($supplier) => format_date($supplier->created_at))
            ->addColumn('action', function ($supplier) {
                $actionBtns = Columns::actionColumns(
                    $supplier,
                    route('admin.fournisseurs.edit', $supplier->id),
                    route('admin.fournisseurs.destroy', $supplier->id),
                    route('admin.fournisseurs.show', $supplier->id)
                );
                
                return $actionBtns;
            })
            // ->orderColumn('status', 'status $1')
            ->rawColumns(["action"])
            ->make(true);
        // }
    }

    public function create()
    {
        return view("admin.supplier.create");
    }

    public function edit($supplier)
    {
        return view("admin.supplier.edit", compact("supplier"));
    }

    public function show($supplier)
    {
        return view("admin.supplier.show", compact("supplier"));
    }

    public function store(Request $request)
    {
        $data = $request->except("_token");
        $data["user_id"] = auth()->user()->id;
        $data["code"] = Supplier::generateUniqueId();

        $saved = Supplier::create($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($supplier, Request $request)
    {
        $data = $request->except("_token");

        $saved = $supplier->update($data);

        if ($saved) {
            return redirect("admin/fournisseurs")->with("success", CustomMessage::Success("Le fournisseur"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }


    public function destroy($id)
    {
        $user = Supplier::findOrFail($id);

        $delete = $user->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("Le fournisseur");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }

    private function getColumns()
    {
        return ["identification", "code", "telephone", "date", "action"];
    }
}
