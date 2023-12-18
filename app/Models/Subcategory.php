<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, "cat_id", 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'subcat_id', 'id');
    }
}
