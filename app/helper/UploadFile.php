<?php

namespace App\helper;



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
}
