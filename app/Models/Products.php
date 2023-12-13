<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    public function category():BelongsTo{
        return $this->belongsTo(Category::class,"cat_id", 'id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class,"subcat_id", 'id');
    }
}
