<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Seller extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'seller';
    public $table = 'sellers';

    protected $guarded = [];

    public function country_data()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function state_data()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    public function city_data()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
