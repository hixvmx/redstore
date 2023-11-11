<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\User;


class DashboardController extends Controller
{
    public function show_home()
    {
        return view('dashboard/home');
    }

    public function show_accounts()
    {
        $users = User::latest()->paginate(25);
        // return $users;
        return view('dashboard/accounts', compact('users'));
    }

    public function show_ads()
    {
        return view('dashboard/ads');
    }

    public function show_categories()
    {
        $categories = Category::latest()->get();

        $results = [];

        foreach($categories as $cat) {
            $subCategories = SubCategory::where('category', $cat->id)->latest()->get();

            $returnData = [
                'id' => $cat->id,
                'name' => $cat->name,
                'image' => $cat->image,
                'created_at' => $cat->created_at,
                'sub_categories' => $subCategories,
            ];
            
            $results[] = $returnData;
        }

        $categories = $results;

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
