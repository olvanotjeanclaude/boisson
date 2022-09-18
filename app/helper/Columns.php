<?php

namespace App\helper;

class Columns
{
    public static function format_columns(array $columns): array
    {
        return array_map(fn ($col) => ["data" => $col, "name" => $col], $columns);
    }

    function getActionButtons()
    {
        return  "ok";
    }

    public static  function actionColumns($data, $editUrl = null, $deleteUrl = null, $viewUrl = null)
    {

        $actionBtns = '<div class="d-flex flex-nowrap">';

        if ($viewUrl) {
            $actionBtns .= '<a href="' . $viewUrl . '" class="btn btn-sm ms-1 btn-warning">
                Voir
            </a>';
        }

        if ($editUrl) {
            $actionBtns .= '
            <a href="' . $editUrl . '"class="btn ml-1 btn-sm btn-primary">
              Editer
            </a>';
        }

        if ($deleteUrl) {
            $actionBtns .= '<button data-id="' . $data["id"] . '" data-url="' . $deleteUrl . '"
                     class="btn ml-1 btn-sm btn-danger delete-btn">
                   Supprimer
                 </button>
          ';
        }

        $actionBtns .= "</div>";


        return $actionBtns;
    }
}
