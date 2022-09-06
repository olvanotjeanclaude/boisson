<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

function get_file($path, $size = 150)
{
    if (str_contains($path, "http://") || str_contains($path, "https://")) {
        return $path;
    }

    return $path && file_exists($path) ? asset($path) : "https://via.placeholder.com/$size";
}

function getUserProfile()
{
    $user = auth()->user();
    $default = asset("app-assets/images/portrait/small/avatar-s-19.png");

    if ($user) {
        $path = auth()->user()->image;
        return file_exists($path) ? asset($path) : $default;
    }

    return $default;
}

function getUserPermission()
{
    return auth()->user()->permission_access;
}

function format_date($date, $separator = "/")
{
    return date("d" . $separator . "m" . $separator . "Y", strtotime($date));
}

function format_date_time($date, $separator = "/", $reverse = false)
{
    $datetime = date("d" . $separator . "m" . $separator . "Y" . " H:i:s", strtotime($date));

    if ($reverse) {
        $datetime = str_replace(" ", "T", date("Y-m-d H:i:s", strtotime($date)));
    }

    return $datetime;
}

function deleteFile($file)
{
    $file = str_replace([request()->getSchemeAndHttpHost(), "storage", "//"], [""], $file);

    $fileExist = Storage::disk('public')->exists($file);

    if ($fileExist) {
        return Storage::disk("public")->delete($file);
    }

    return false;
}

function get_user_id()
{
    if (Auth::check()) {
        return Auth::user()->id;
    }
    return null;
}

function get_user_name()
{
    if (Auth::check()) {
        return Auth::user()->name;
    }
    return null;
}

function  formatPrice($price, $devise = "Ar")
{
    return $price . " $devise";
}

function generateInteger($n = 6):string
{
    $start = 1;
    $end = 9;
    for ($i = 1; $i < $n; $i++) {
        $start .= 1;
        $end .= 9;
    }

    return (string)random_int($start, $end);
}

function getStartAndEndDate($week, $year)
{
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    $response['week_start'] = $dto->format('Y-m-d');
    $dto->modify('+6 days');
    $response['week_end'] = $dto->format('Y-m-d');
    
    return $response;
}

function getAppName(){
    return "Magasin SOA";
}