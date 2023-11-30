<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;


class City extends Model
{
    use HasFactory;


    protected $fillable = ['name','slug','country'];


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = str_replace(' ','-',$value);

        // check to see if any other slugs exist that are the same & count them
        $count = City::whereRaw("slug = '{$slug}'")->orWhere('slug', 'LIKE', $slug . '%')->count();

        // if other slugs exist that are the same, append the count to the slug
        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }
}
