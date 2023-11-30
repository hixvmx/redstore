<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\Country;

class Country extends Model
{
    use HasFactory;


    protected $fillable = ['name','slug'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = str_replace(' ','-',$value);

        // check to see if any other slugs exist that are the same & count them
        $count = Country::whereRaw("slug = '{$slug}'")->orWhere('slug', 'LIKE', $slug . '%')->count();

        // if other slugs exist that are the same, append the count to the slug
        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }
}
