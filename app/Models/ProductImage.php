<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
    public function getFullPathAttribute(): string
    {
        return asset('storage/' . $this->path);
    }

    public function updateImage($file)
    {
        $destinationPath = storage_path("app/public/upload");
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $originalName . '-' . uniqid() . "." . $extension;
        $file->move($destinationPath, $fileName);

        $this->update([
            'name' => $fileName,
            'path' => "upload" . "/" . $fileName,
        ]);
    }
    
}
