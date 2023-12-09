<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    public function ShowCategoriesPage()
    {
        // get Categories With SubCategories
        $categories = Category::with([
            'childrens' => function ($q) {
                $q->select([
                    'id',
                    'slug',
                    'name',
                    'category',
                    \DB::raw("(SELECT COUNT(*) FROM ads WHERE ads.sub_category = sub_categories.id) as total_ads")
                ]);
            }
        ])->get([
            'id',
            'slug',
            'name',
            \DB::raw("(SELECT COUNT(*) FROM ads WHERE ads.category = categories.id) as total_ads")
        ]);
        

        return view('categories', compact('categories'));
    }
}
