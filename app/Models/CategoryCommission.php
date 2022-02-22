<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryCommission extends Model
{
    use HasFactory;
    protected $table="saller_category_commision";
    protected $fillable = [
        'category_id',
        'store_id',
        'commission'
    ];
}
