<?php

namespace App\helper;

use Illuminate\Support\Facades\File;



class UploadFile
{
    public static function upload($file, $folder, $fileName = null)
    {
        if ($file) {
            $fileName =  date("dmYHms") . "-" . rand(1000, 9999);
            $extension = $file->getClientOriginalExtension();
            $fileName = $fileName . "." . $extension;

            $file->storeAs("/public/$folder", $fileName);

            return "storage/$folder/$fileName";
        }

        return "";
    }

    static function save($name, $directory, $file)
    {
        $dir = "uploads/" . $directory;

        if (!empty($file)) {
            if (!File::exists($dir)) {
                File::makeDirectory($dir, 0755, true);
            }

            $fileName = date("dmYHms") . $name . "." . $file->getClientOriginalExtension();
            $path = ($dir . '/' . $fileName);

            if ($file) {
                $file->move($dir, $fileName);
            }

            return $path;
        }

        return "";
    }
}
