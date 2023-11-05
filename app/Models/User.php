<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Country;
use App\Models\City;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'email',
        'password',
        'avatar',
        'country',
        'city',
        'birthdate',
        'gender',
        'phone_number',
        'twitter_url',
        'instagram_url',
        'facebook_url',
        'website_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    

    public function getAvatarAttribute()
    {
        $imgPath = $this->attributes['avatar'];
        $appUrl = \Config::get('values.APP_URL');
        $defaultAvatar = \Config::get('values.DEFAULT_AVATAR');
        
        if (!empty($imgPath))
        {
            return $appUrl ."image/avatar/". $imgPath;
        }

        return $defaultAvatar;
    }


    public function getCountryAttribute()
    {
        $countryID = $this->attributes['country'];
        
        $country = Country::select('id', 'name', 'slug')->where('id', $countryID)->first();

        return $country;
    }


    public function getCityAttribute()
    {
        $cityID = $this->attributes['city'];
        
        $city = City::select('id', 'name', 'slug')->where('id', $cityID)->first();

        return $city;
    }
}
