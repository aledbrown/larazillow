<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
    ];

    protected $appends = ['src'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($listingImage) {
            if ($listingImage->isForceDeleting()) {
                \Storage::disk('public')->delete($listingImage->filename);
            }
        });
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    } // usage -> $listingImage->src
}
