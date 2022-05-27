<?php

namespace App\Message;

class CustomMessage
{
    const DEFAULT_ERROR = "Une erreur imprévue s'est produite. Veuillez réessayer bientôt.";

    public static function Success($modelInstance)
    {
        return "$modelInstance a été enregistré avec succès.";
    }

    public static function Delete($modelInstance)
    {
        return "$modelInstance a été supprimé avec succès.";
    }
    public static function ErrorDelete($modelInstance)
    {
        return "Veuillez selectionner $modelInstance que vous voulez supprimer!";
    }
}
