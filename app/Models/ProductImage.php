<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/seller/product/images' . '/' . $value) : NULL;
    }
}