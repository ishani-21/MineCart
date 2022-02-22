<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'en_productname',
        'ar_productname',
        'stor_id',
        'categories_id',
        'brand_id',
        'ar_discription',
        'en_discription',
        'cost_price',
        'regular_price',
        'sale_price',
        'cover_image',
        'total_qty',
        'status',
        'is_approve',
    ];
    public function getCoverimageAttribute($value)
    {
        return $value ? asset('storage/seller/product' . '/' . $value) : NULL;
    }
    public function stores()
    {
        return $this->belongsTo(Store::class, 'stor_id', 'id');
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id','id');
    }
    public function Category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    public function ProductImages()
    {
        return $this->belongsTo(ProductImage::class, 'product_id');
    }
}
