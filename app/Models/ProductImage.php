<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Get the product that owns the photo.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
