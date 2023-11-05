<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name','slug','category'];


    public function getImageAttribute()
    {
        if (!empty($this->attributes['image']))
        {
            return url("") . $this->attributes['image'];
        }
        
        return url("") . "/image/default.png";
    }
}
