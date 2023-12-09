<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function ShowHomePage() {
        
        $categories = DB::table('categories')
            ->join('ads', 'categories.id', '=', 'ads.category')
            ->select('categories.id', 'categories.name', 'categories.slug', DB::raw('COUNT(ads.id) as ad_count'))
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->having('ad_count', '>', 1)
            ->orderBy('ad_count', 'desc')
            ->get();

        foreach ($categories as $category) {
            $category->ads = Ad::where('category', $category->id)->orderBy('id', 'desc')->get();
        }

        return view('home',compact('categories'));
    }
}
