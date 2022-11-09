<?php

namespace App\Models;

use App\helper\Filter;
use App\Traits\Articles;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\Articles as ModelsArticles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory, Articles;

    protected $guarded = [];
    const ACTION_TYPES = ["avec-consignation" => 1, "deconsignation" => 2];

    public function saleable()
    {
        return $this->morphTo();
    }

    public function invoice()
    {
        return $this->belongsTo(DocumentVente::class, "number", "invoie_number");
    }

    public function getArticleTypeAttribute()
    {
        switch ($this->saleable_type) {
            case 'App\Models\Product':
                $type = "En Detail";
                break;
            case 'App\Models\Package':
                $type = "En Gros";
                break;
            case 'App\Models\Emballage':
                if ($this->isWithEmballage) {
                    $type = "Deconsignation";
                } else {
                    $type = "Consignation";
                }
                break;
            default:
                $type = "Inconnu";
                break;
        }

        return $type;
    }

    public function getDesignationAttribute()
    {
        $designation = $this->saleable->designation;
        if ($this->saleable_type == "App\Models\Product") {
            $divider = $this->saleable->contenance ?? $this->saleable->condition ?? null;
            if ($this->quantity >= $divider) {
                $designation = ModelsArticles::PACKAGE_TYPES[$this->saleable->package_type] . " " . $designation;
            }
        }

        return strtoupper($designation);
    }

    public function getQtyAttribute()
    {
        $quantity = $this->quantity;

        if ($this->saleable_type == "App\Models\Product") {
            $divider = $this->saleable->contenance ?? $this->saleable->condition ?? null;
            if ($this->quantity >= $divider) {
                $quantity = $this->quantity / $divider;
            }
        }

        return $quantity;
    }

    public function getSubAmountAttribute()
    {
        return getNumberDecimal($this->amount);
    }

    public function getPricingAttribute()
    {
        return getNumberDecimal($this->price);
    }

    public function getQuantityAttribute($value)
    {
        return getNumberDecimal($value);
    }

    public function scopePreArticlesSum($q)
    {
        $sales = $q->where("user_id", auth()->user()->id)->whereNull("invoice_number")->get();

        $articleAndConsignation = $sales->filter(function ($sale) {
            return $sale->isWithEmballage == 0;
        })->sum(function ($sale) {
            return $sale->saleable->price * $sale->quantity;
        });

        $deconsignation = $sales->filter(function ($sale) {
            return $sale->isWithEmballage == 1;
        })->sum(function ($sale) {
            return $sale->saleable->price * $sale->quantity;
        });

        return $articleAndConsignation - $deconsignation;
    }

    public  function scopeBetween($query, $between = [])
    {
        if (empty($between)) {
            $between = Stock::getDefaultBetween();
        }

        return DB::table("sales")
            ->whereNotNull("invoice_number")
            ->whereNotNull("received_at")
            ->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type')
            ->groupBy("article_reference")

            ->get();
    }

    public  function scopewithSumQuantity($query, $between)
    {
        return  $query->whereHasMorph('saleable', [Product::class])
            ->where("status", true)
            ->whereBetween("received_at", $between)
            ->selectRaw('SUM(quantity) as sum_sale,article_reference,saleable_id,saleable_type, received_at')
            ->groupBy("article_reference")
            ->get();
    }

    public  function scopeGetSolds($query, $between, $articleType = "all")
    {
        $sales = $query->whereHasMorph(
            'saleable',
            [Product::class, Emballage::class],
            function ($query) {
                $search = strtolower(request()->get("chercher"));
                $query->where('designation', 'like', "%$search%")
                    ->orWhere('reference', 'like', "%$search%");
            }
        )
            ->where(fn ($query) => Filter::queryBetween($query, $between))
            ->orderBy("received_at", "desc")
            ->get();

        $sales = Filter::querySales($sales, $articleType);

        return $sales;
    }

    public static function getDetailOrWholesale($sales, $type)
    {
        return $sales->where("saleable_type", "App\Models\Product")
            ->filter(function ($sale) use ($type) {
                $article = $sale->saleable;
                $divider = $article?->contenance ?? $article?->condition;

                if ($type == "detail") {
                    return $article && $sale->quantity < $divider;
                } else if ($type == "wholesale") {
                    return $article && $sale->quantity >= $divider;
                }

                return $sale;
            });
    }
}
