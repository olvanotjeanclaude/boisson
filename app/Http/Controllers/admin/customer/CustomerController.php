<?php

namespace App\Http\Controllers\admin\customer;

use App\helper\Columns;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    private function getColumns()
    {
        return ["status", "identification", "code", "phone", "address", "created_at"];
    }

    public function index()
    {
        // dd(Route::currentRouteName());
        abort_if(currentUser()->cannot("view_customer"),403);
        $columns = Columns::format_columns($this->getColumns());
        $columns[] = ["data" => "action", "name" => "action"];

        // $customers = Customers::orderBy("id", "desc")->get();
        return view("admin.customer.index", [
            // "customers" => $customers,
            "columns" => json_encode($columns),
        ]);
    }

    public function ajaxPostData(Request $request)
    {
        if ($request->ajax()) {
            $columns = ["id", ...$this->getColumns()];
            $customers = Customers::select($columns)->orderBy("id", "desc");

            return DataTables::of($customers)
                ->setRowId(fn ($customer) => "row_$customer->id")
                ->addColumn("status", fn ($customer) => $customer->badge)
                ->addColumn("code", fn ($customer) => $customer->cl_code)
                ->addColumn("created_at", fn ($customer) => format_date_time($customer->created_at))
                ->addColumn('action', function ($customer) {
                    $editUrl =  route('admin.clients.edit', $customer->id);
                    $deleteUrl =  route('admin.clients.destroy', $customer->id);

                    return Columns::actionColumns($customer, $editUrl, $deleteUrl);
                })
                ->rawColumns(["status", "action"])
                ->make(true);
        }
    }

    public function create()
    {
        return view("admin.customer.create");
    }

    private function rules()
    {
        return [
            "identification" => "required",
            "phone" => "required",
            "address" => "required",
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
        $data["code"] = generateInteger();
        $saved = Customers::create($data);

        if ($saved) {
            return redirect("/admin/clients")->with("success", CustomMessage::Success("Le client"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function update($userId, Request $request)
    {
        $user = Customers::findOrFail($userId);

        $request->validate($this->rules(true), $this->message());

        //dd($request->all());
        $data = $request->except("_token");


        $saved = $user->update($data);

        if ($saved) {
            return redirect("/admin/clients")->with("success", CustomMessage::Success("Le client"));
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }

    public function edit($id)
    {
        $customer = Customers::findOrFail($id);
        return view("admin.customer.edit", compact("customer"));
    }

    public function destroy($id)
    {
        $user = Customers::findOrFail($id);
        $delete = $user->delete();
        //$delete =true;
        $result = [];

        if ($delete) {
            $result["success"] = CustomMessage::Delete("Le client");
            $result["type"] = "success";
        } else {
            $result["type"] = "error";
            $result["error"] = CustomMessage::DEFAULT_ERROR;
        }

        return response()->json($result);
    }
}
