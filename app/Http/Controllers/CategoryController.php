<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;



class CategoryController extends Controller
{
    public function ShowCategoriesPage()
    {
        // get categories
        $categories = Category::select('id', 'slug', 'name')->get();

        function getSubCategoriesx($categoryID)
        {
            if (!empty($categoryID)) {
                $SubCategoriesData = SubCategory::select('id', 'slug', 'name')
                    ->where('category', $categoryID)
                    ->get();

                return $SubCategoriesData;
            }
            return [];
        }

        return view('categories');
    }
}
