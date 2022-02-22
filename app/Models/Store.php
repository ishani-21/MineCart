<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    public $table = 'stores';

    protected $fillable = [
        'en_name',
        'ar_name',
        'status',
        'is_approve',
        'password',
    ];

    public function saller()
    {
        return $this->hasOne(Seller::class,'id','saller_id');
    }
}
