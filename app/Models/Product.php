<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'files' => "array"
    ];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "cat_id", 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, "subcat_id", 'id');
    }

    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'products_id', 'id');
    }
}
