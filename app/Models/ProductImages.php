<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImages extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productImages(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
