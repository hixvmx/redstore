<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;


class HomeController extends Controller
{
    public function ShowHomePage() {

        $categoriesxx = Category::select('id','slug','name','image')
        ->with(['SubCategories' => function ($q) {
            $q->select('id','slug','name','image','category');
        }])->get();
        

        $categories = Category::get();

        
        $categoriesx = $categories->map(function($c) {
            return [
                "id" => $c->id,
                "name" => $c->name,
                "slug" => $c->slug,
                "image" => $c->image,
                "items" => Ad::where('category', $c->id)->get(),
            ];
        });

        return view('home',compact('categoriesxx','categoriesx'));
    }
}
