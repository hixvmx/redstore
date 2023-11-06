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
}
