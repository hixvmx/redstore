<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show_home()
    {
        return view('dashboard/home');
    }

    public function show_accounts()
    {
        return view('dashboard/accounts');
    }

    public function show_ads()
    {
        return view('dashboard/ads');
    }

    public function show_categories()
    {
        return view('dashboard/categories');
    }

    public function show_countries()
    {
        return view('dashboard/countries');
    }
}
