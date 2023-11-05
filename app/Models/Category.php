<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Category extends Model
{
    use HasFactory;


    protected $fillable = ['name','slug'];


    public function getImageAttribute()
    {
        if (!empty($this->attributes['image']))
        {
            return url("") . $this->attributes['image'];
        }
        
        return url("") . "/image/default.png";
    }


    public function SubCategories() {
        return $this->hasMany(SubCategory::class, 'category', 'id');
    }
}
