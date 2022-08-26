<?php

namespace App\Models;

use App\Traits\Articles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentVente extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];

    const FILTER_TYPE = [
        "jour" => "Date",
        "hebdomadaire" => "Semaine De L'Année",
        "mois" => "mois",
        "annuel" => "Année"
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, "invoice_number", "number");
    }

    public function scopeCommercialState()
    {
        return DB::table('document_ventes')
            ->selectRaw("paid,rest, DATE_FORMAT(received_at, '%Y-%m-%d') as date, SUM(paid) as paid, SUM(rest) as rest, SUM(checkout) as sum_checkout")
            ->orderByDesc("date")
            ->groupBy("date");
    }

    public function scopeState($query, $filterType)
    {
        $docSales = $query->select([
            "paid",
            "rest",
            DB::raw("SUM(paid) as paid"),
            DB::raw("SUM(rest) as rest"),
            DB::raw("SUM(checkout) as sum_checkout")
        ]);

        switch ($filterType) {
            case 'jour':
                $docSales = $docSales->addSelect([
                    DB::raw("DATE_FORMAT(received_at, '%Y-%m-%d') as date"),
                    DB::raw("DATE_FORMAT(received_at, '%d-%m-%Y') as formated_date"),
                ])
                    ->groupBy("date")
                    ->orderByDesc("date");
                break;

            case 'hebdomadaire':
                $docSales = $docSales->addSelect([
                    DB::raw("EXTRACT( WEEK FROM received_at) as week_of_year"),
                    DB::raw("EXTRACT(YEAR FROM received_at) as year"),
                ])
                    ->groupBy("week_of_year")
                    ->groupBy("year")
                    ->orderByDesc("week_of_year");
                break;

            case 'mois':
                $docSales = $docSales->addSelect(
                    [
                        DB::raw("DATE_FORMAT(received_at, '%Y-%m') as month_of_year"),
                        DB::raw("DATE_FORMAT(received_at, '%m/%Y') formated_month_of_year")
                    ]
                )
                    ->groupBy("month_of_year")
                    ->orderByDesc("month_of_year");
                break;

            case 'annuel':
                $docSales = $docSales->addSelect(
                    [
                        DB::raw("DATE_FORMAT(received_at, '%Y') as year")
                    ]
                )
                    ->groupBy("year")
                    ->orderByDesc("year");
                break;
            default:
                $docSales = $docSales->addSelect([
                    DB::raw("DATE_FORMAT(received_at, '%Y-%m-%d') as date"),
                    DB::raw("DATE_FORMAT(received_at, '%d-%m-%Y') as formated_date"),
                ])
                    ->groupBy("date")
                    ->orderByDesc("date");
                break;
        }

        return $docSales;
    }
}
