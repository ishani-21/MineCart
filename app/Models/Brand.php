<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $table = 'brands';

    protected $guarded =[];

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/admin/brand' . '/' . $value) : NULL;
    }
}

