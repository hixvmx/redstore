<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Currency;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'currency',
        'category',
        'sub_category',
        'country',
        'city',
        'image',
        'images',
        'publisher',
        'active',
    ];


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        $slug = str_replace(' ','-',$value);

        // check to see if any other slugs exist that are the same & count them
        $count = Ad::whereRaw("slug = '{$slug}'")->orWhere('slug', 'LIKE', $slug . '%')->count();

        // if other slugs exist that are the same, append the count to the slug
        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }


    public function getImageAttribute()
    {
        if (!empty($this->attributes['image']))
        {
            return url("image/ad") .'/'. $this->attributes['image'];
        }
        else
        {
            return url("image/ad/placeholder.png");
        }
    }


    public function getImagesAttribute()
    {
        if (!empty($this->attributes['images']))
        {
            $images = [];
            $imgs = explode(",", $this->attributes['images']);

            foreach ($imgs as $img) {
                array_push($images, url("image/ad/more") .'/'. $img);
            }
            return $images;
        }
        else
        {
            return [url("image/ad/placeholder.png")];
        }
    }


    public function getCountryAttribute()
    {
        $countryID = $this->attributes['country'];

        $countryData = Country::select('id','name','slug')->where('id', $countryID)->first();

        return $countryData ?? [];
    }


    public function getCityAttribute()
    {
        $cityID = $this->attributes['city'];

        $cityData = City::select('id','name','slug')->where('id', $cityID)->first();

        return $cityData ?? [];
    }


    public function getCategoryAttribute()
    {
        $categoryID = $this->attributes['category'];

        $categoryData = Category::select('id','name','slug')->where('id', $categoryID)->first();

        return $categoryData ?? [];
    }


    public function getSubCategoryAttribute()
    {
        $subCategoryID = $this->attributes['sub_category'];

        $subCategoryData = SubCategory::select('id','name','slug')->where('id', $subCategoryID)->first();

        return $subCategoryData ?? [];
    }


    public function getPublisherAttribute()
    {
        $publisherID = $this->attributes['publisher'];

        $publisherData = User::where('id', $publisherID)
        ->select('id', 'firstname', 'lastname', 'username', 'avatar', 'email', 'country', 'city', 'phone_number', 'twitter_url', 'instagram_url', 'facebook_url', 'website_url')
        ->first();

        return $publisherData;
    }


    public function getCurrencyAttribute()
    {
        $currencyID = $this->attributes['currency'];

        $currencyData = Currency::where('id', $currencyID)
        ->select('id', 'name')
        ->first();

        return $currencyData;
    }

    public function getCreatedAtAttribute()
    {
        $createdAt = $this->attributes['created_at'];

        if (!empty($createdAt))
        {
            return [
                "date" => explode(' ', $createdAt)[0],
                "time" => explode(' ', $createdAt)[1]
            ];
        }
        
        return [];
    }
}
