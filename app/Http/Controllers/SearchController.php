<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\Currency;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use Str;

class SearchController extends Controller
{
    public function ShowSearchPage(Request $request)
    {
        // get params
        $categories = Category::select('id','name','slug')
        ->latest()
        ->get();

        $sub_categories = SubCategory::select('id','name','slug','category')
        ->latest()
        ->get();

        $countries = Country::select('id','name','slug')
        ->latest()
        ->get();

        $cities = City::select('id','name','slug','country')
        ->latest()
        ->get();


        // Get results

        $pram = [];
        $pram['keywords'] = $request->get('keywords');
        $pram['category'] = $request->get('category');
        $pram['subCategory'] = $request->get('subCategory');
        $pram['country'] = $request->get('country');
        $pram['city'] = $request->get('city');
        $pram['orderBy'] = $request->get('orderBy');


        $resultsConditions = "title like '%" . $pram['keywords'] . "%' ";
        
        if (!empty($pram['category']) AND $pram['category'] != "all") {
            if (!empty($resultsConditions)) {
                $resultsConditions .= " and ";
            }
            $resultsConditions .= "category = '" . $pram['category'] . "' ";
        }

        if (!empty($pram['subCategory']) AND $pram['subCategory'] != "all") {
            if (!empty($resultsConditions)) {
                $resultsConditions .= " and ";
            }
            $resultsConditions .= "sub_category = '" . $pram['subCategory'] . "' ";
        }

        if (!empty($pram['country']) AND $pram['country'] != "all") {
            if (!empty($resultsConditions)) {
                $resultsConditions .= " and ";
            }
            $resultsConditions .= "country = '" . $pram['country'] . "' ";
        }

        if (!empty($pram['city']) AND $pram['city'] != "all") {
            if (!empty($resultsConditions)) {
                $resultsConditions .= " and ";
            }
            $resultsConditions .= "city = '" . $pram['city'] . "' ";
        }

        $orderBy = "DESC";
        if (!empty($pram['orderBy']) AND $pram['orderBy'] == "old") {
            $orderBy = "ASC";
        }

        $ads = Ad::whereRaw($resultsConditions)
        ->orderBy("id", $orderBy)
        ->limit(50)
        ->get();
        

        return view('search', compact('categories','sub_categories','countries','cities','ads'));
    }
}
