<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ad;
use App\Models\Country;
use App\Models\City;

class ProfileController extends Controller
{
    public function ShowUserPage(string $username) {

        $user = User::where('username', $username)->first();
        if (!$user) return redirect('/');
        
        $ads = Ad::where('publisher', $user->id)
        ->latest()
        ->get();

        return view('user', compact('user','ads'));
    }
}
