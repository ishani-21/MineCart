<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plan()
    {
        return $this->hasOne(MembershipPlan::class,'id','membership_plan_id');
    }
}
