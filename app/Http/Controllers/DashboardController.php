<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\User;
use App\Models\Ad;
use DB;


class DashboardController extends Controller
{
    public function show_home()
    {
        return view('dashboard/home');
    }

    public function show_accounts()
    {
        $users = User::latest()->paginate(25);
        
        return view('dashboard/accounts', compact('users'));
    }

    public function show_ads()
    {
        $ads = Ad::latest()->paginate(25);
        
        return view('dashboard/ads', compact('ads'));
    }

    public function show_categories()
    {

        $subCategories = SubCategory::select('id','image','name','slug', 'created_at', \DB::raw("false as isParent"));

        $categories = Category::select('id','image','name','slug', 'created_at', \DB::raw("true as isParent"))
        ->union($subCategories)
        ->latest()
        ->get();
        
        return view('dashboard/categories', compact('categories'));
    }

    public function show_countries()
    {
        $countries = Country::latest()->get();

        $results = [];

        foreach($countries as $cntr) {
            $cities = City::where('country', $cntr->id)->latest()->get();

            $returnData = [
                'id' => $cntr->id,
                'name' => $cntr->name,
                'created_at' => $cntr->created_at,
                'cities' => $cities,
            ];
            
            $results[] = $returnData;
        }

        $countries = $results;

        return view('dashboard/countries', compact('countries'));
    }
}
