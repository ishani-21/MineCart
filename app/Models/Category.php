<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
{
    use HasFactory;

    // public function sluggable(){
    //     return [
    //         'slug' => [
    //             'source' => 'en_name',
    //         ]
    //     ];
    // }
    public function setSlugAttribute()
    {
        $this->attributes['slug'] = Str::slug($this->en_name, "-");
    }
    public function getImageAttribute($value)
    {
        return $value ? asset('storage/admin/category' . '/' . $value) : NULL;
    }
}
