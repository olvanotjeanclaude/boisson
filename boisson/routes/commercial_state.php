<?php

use Illuminate\Support\Facades\Route;

 Route::get("etat-commerciale", [\App\Http\Controllers\admin\commercial_state\CommercialStateController::class, "index"])
 ->name("commercialState.index");
 Route::get("etat-commerciale/detail", [\App\Http\Controllers\admin\commercial_state\CommercialStateController::class, "show"])
 ->name("commercialState.show");