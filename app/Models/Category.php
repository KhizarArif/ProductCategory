<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; 

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = [
        'id',
        'name',
        'status'
    ];

    public function subcategory():HasMany{
        return $this->hasMany(Subcategory::class, 'cat_id', 'id');
    }

    public function products():HasMany{
        return $this->hasMany(Products::class, 'cat_id', 'id');
    }
}
