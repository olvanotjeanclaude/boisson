<?php

namespace App\Http\Controllers\admin\settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Message\CustomMessage;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function update(Request $request){
        $request->validate([
            "min_stock_day" =>"numeric:min:1"
        ]);
        
        $data = [
            "user_id" =>auth()->user()->id,
            "min_stock_day" =>$request->min_stock_day
        ];

        $setting = Settings::first();

        if($setting){
           $saved= $setting->update($data);
        }
        else{
           $saved= Settings::create($data);
        }

        if ($saved) {
            return back()->with("success", "Le jour a été configuré avec succès");
        }

        return back()->with("error", CustomMessage::DEFAULT_ERROR);
    }
}
