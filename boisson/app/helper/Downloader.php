<?php

namespace App\helper;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class Downloader implements FromView
{
    private $datas;
    private $template;

    public function __construct($template, array $datas)
    {
        $this->template= $template;
        $this->datas = $datas;
    }

    public function view(): View
    {
        return view($this->template, $this->datas);
    }
}
