<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds', 'baths', 'area', 'city', 'code', 'street', 'street_nr', 'price'
    ];

    // RELATIONSHIPS
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'by_user_id');
    }

    // SCOPES
    public function scopeMostRecent(Builder $query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function scopeFilter(Builder $builder, array $filters): Builder
    {
        $builder->when($filters['search'] ?? null, function (Builder $builder, string $search) {
            $builder->where(function (Builder $builder) use ($search) {
                $builder->where('beds', 'like', '%' . $search . '%')
                    ->orWhere('baths', 'like', '%' . $search . '%')
                    ->orWhere('area', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    ->orWhere('code', 'like', '%' . $search . '%')
                    ->orWhere('street', 'like', '%' . $search . '%')
                    ->orWhere('street_nr', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            });
        })->when($filters['beds'] ?? null, function (Builder $builder, string $beds) {
            $builder->where('beds', (int)$beds < 6 ? '=' : '>=', $beds);
        })->when($filters['baths'] ?? null, function (Builder $builder, string $baths) {
            $builder->where('baths', (int)$baths < 6 ? '=' : '>=', $baths);
        })->when($filters['areaFrom'] ?? null, function (Builder $builder, string $areaFrom) {
            $builder->where('area', '>=', $areaFrom);
        })->when($filters['areaTo'] ?? null, function (Builder $builder, string $areaTo) {
            $builder->where('area', '<=', $areaTo);
        })->when($filters['priceFrom'] ?? null, function (Builder $builder, string $priceFrom) {
            $builder->where('price', '>=', $priceFrom);
        })->when($filters['priceTo'] ?? null, function (Builder $builder, string $priceTo) {
            $builder->where('price', '<=', $priceTo);
        });
        return $builder;
    }


}
