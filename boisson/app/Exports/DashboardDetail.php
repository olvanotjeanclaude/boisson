<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DashboardDetail implements FromView
{
    private $datas;

    public function __construct(array $datas)
    {
        $this->datas = $datas;
    }

    public function view(): View
    {
        return view('admin.dashboard.detail-excel', $this->datas);
    }
}
