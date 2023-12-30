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
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function show_home()
    {
        $total_users = User::count();
        $total_ads = Ad::count();

        $today = Carbon::now();
        $startOfMonth = $today->copy()->startOfMonth();

        $today = Carbon::now();
        $startOfMonth = $today->copy()->startOfMonth();

        $months = [];
        $usersData = [];
        $adsData = [];

        for ($i = 0; $i < 12; $i++) {
            $startDate = $startOfMonth->copy()->subMonths($i);
            $endDate = $startDate->copy()->endOfMonth();

            $months[] = $startDate->format('F');
            
            $usersData[] = User::whereBetween('created_at', [$startDate, $endDate])->count();
            $adsData[] = Ad::whereBetween('created_at', [$startDate, $endDate])->count();
        }

        $months = $months;
        $users_counts = $usersData;
        $ads_counts = $adsData;

        return view('dashboard/home', compact('total_users','total_ads','months','users_counts','ads_counts'));
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

    public function deleteAd(string $id) {
        if (!$id){
            return null;
        }

        // Get Ad
        Ad::where('id',$id)->delete();

        return response()->json([
            'status' => '1',
            'result' => 'Success',
        ]);
    }
}
