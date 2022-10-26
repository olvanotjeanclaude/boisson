<?php

namespace App\helper;

class Columns
{
    public static function format_columns(array $columns): array
    {
        return array_map(fn ($col) => ["data" => $col, "name" => $col], $columns);
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

    public static function sampleAction()
    {
        return  ["data" => "action", "name" => "action"];
    }

    public static function push(String $colName, array $columns = [])
    {
        $newCol =  ["data" => $colName, "name" => $colName];
        $columns[] = $newCol;
        return $columns;
    }

    public static function setButton($label, $url, $icon, $data = null): string
    {
        $html = "";
        $attributes = $icon == "print" ? "target='_blank'" : "";

        if ($label == "defaultDelete" && $data) {
            $html = '
            <button class="dropdown-item" data-id="' . $data["id"] . '" data-url="' . $url . '"
                     class="btn ml-1 btn-sm  delete-btn">
                     <i class="la la-' . $icon . '"></i>
                     Supprimer
                 </button>
            ';
        } else {
            $html = "<a $attributes href='$url' class='dropdown-item'>
                        <i class='la la-$icon'></i>
                        $label
                    </a>";
        }

        return $html;
    }

    public static function getActionButtons(array $buttons)
    {
        $actionBtn = "";
        if (count($buttons)) {
            $actionBtn = '<span class="dropdown">
            <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true"
                class="btn btn-primary dropdown-toggle dropdown-menu-right">
                <i class="ft-settings"></i>
            </button>
            <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">
    ';

            foreach ($buttons as $button) {
                $actionBtn .= $button;
            }

            $actionBtn .= "</span>
        </span>";
        }

        return $actionBtn;
    }
}
