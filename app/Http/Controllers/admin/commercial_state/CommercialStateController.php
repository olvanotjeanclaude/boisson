<?php

namespace App\Http\Controllers\admin\commercial_state;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class CommercialStateController extends Controller
{
    public function index()
    {
        $states = Sale::CommercialState();
        // dd($states);
        $states = $states->map(function ($state) {
            $state->amount = $state->sum_sale * $state->saleable->price;
            $state->amount = $state->isWithEmballage?-$state->amount:$state->amount;
            return $state;
        });

        $total = $states->sum("amount");

        // dd($states);
        return view("admin.commercial_state.index",compact("states","total"));
    }
}
