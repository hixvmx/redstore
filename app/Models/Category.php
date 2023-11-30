<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Category;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name','slug'];

    
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;

        $slug = str_replace(' ','-',$value);

        // check to see if any other slugs exist that are the same & count them
        $count = Category::whereRaw("slug = '{$slug}'")->orWhere('slug', 'LIKE', $slug . '%')->count();

        // if other slugs exist that are the same, append the count to the slug
        $this->attributes['slug'] = $count ? "{$slug}-{$count}" : $slug;
    }


    public function getImageAttribute()
    {
        if (!empty($this->attributes['image']))
        {
            return url("") . $this->attributes['image'];
        }
        
        return url("") . "/image/default.png";
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


    public function SubCategories() {
        return $this->hasMany(SubCategory::class, 'category', 'id');
    }
}
