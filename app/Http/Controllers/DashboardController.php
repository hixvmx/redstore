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
}
