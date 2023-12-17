<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Ad;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function ShowHomePage() {
        $ads = Ad::latest()->limit(20)->get();
        return view('home',compact('ads'));
    }
}
