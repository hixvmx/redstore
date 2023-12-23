<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ad;
use App\Models\User;
use App\Models\Country;
use App\Models\City;
use App\Models\FavoriteAd;
use Hash;
use Str;

class AccountController extends Controller
{
    public function ShowAdsPage() {
        $authUserId = Auth::user()->id;

        $ads = Ad::where('publisher', $authUserId)->latest()->paginate(20);

        return view('account/ads', compact('ads'));
    }

    public function ShowFavoritesPage() {
        
        $authUserId = Auth::user()->id;

        $FavoriteAds = FavoriteAd::where('user', $authUserId)->get(['ad']);
        
        $FavoriteAds = collect($FavoriteAds)->pluck('ad')->toArray();

        $ads = Ad::whereIn('id', $FavoriteAds)->latest()->paginate(25);

        return view('account/favorites', compact('ads'));
    }

    public function ShowSettingsPage() {
        $user = Auth::user();

        $countries = Country::select('id','name','slug')
        ->latest()
        ->get();

        $cities = City::select('id','name','slug','country')
        ->latest()
        ->get();

        return view('account/settings', compact('user','countries','cities'));
    }

    public function updateSettings(Request $request) {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'country' => 'required|integer',
            'city' => 'required|integer',
            'gender' => 'required|in:male,female',
            'birthdate' => 'required|date',
        ]);

        $authUser = Auth::user();
        $authUserId = Auth::user()->id;
        $authUserAvatar = Auth::user()->avatar;
        $appUrl = \Config::get('values.APP_URL');
        $defaultAvatar = \Config::get('values.DEFAULT_AVATAR');

        if ($avatar = $request->file('avatar')) {
            // generate new path name
            $avatarNewName = $authUserId .'-'. Str::random(25) . '.' . $avatar->getClientOriginalExtension();
            $avatar->move('image/avatar/',$avatarNewName);
            $imagePath = $avatarNewName;

            // remove old image
            if (!empty($authUserAvatar))
            {
                if ($authUserAvatar !== $defaultAvatar)
                {
                    $avatarOldPath = str_replace($appUrl, '', $authUserAvatar);
                    unlink($avatarOldPath);
                }
            }
        }
        else {
            $imagePath = null;
        }


        $user = User::where('id', $authUserId)->first();
        if (!$user) return response()->json(['status' => '0', 'result' => 'Not Found!']);

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->gender = $request->gender;
        $user->birthdate = $request->birthdate;
        if (!empty($imagePath)) {
            $user->avatar = $imagePath;
        }
        $user->save();


        return response()->json([
            'status' => '1',
            'result' => 'تم حفظ التعديلات بنجاح'
        ]);
    }

    public function ShowContactInformationsPage() {
        
        $user = Auth::user();

        return view('account/contactInformations', compact('user'));
    }

    public function updateContactInformations(Request $request) {
        $request->validate([
            'email' => 'required|max:255|email',
            'phone' => 'required|max:255',
        ]);

        User::whereId(Auth::user()->id)->update([
            'email' => $request->email,
            'phone_number' => $request->phone,
            'twitter_url' => $request->twitter,
            'facebook_url' => $request->facebook,
            'instagram_url' => $request->instagram,
            'website_url' => $request->website,
        ]);

        return response()->json([
            'status' => '1',
            'result' => 'تم حفظ التعديلات بنجاح'
        ]);
    }

    public function ShowChangePasswordPage() {
        return view('account/changePassword');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5',
            'repeat_new_password' => 'required',
        ]);

        if($request->new_password !== $request->repeat_new_password) {
            return response()->json(['status'  =>  0, 'result'  =>  'كلمتا المرور الجديدتين غير متطابقتين.']);
        }

        # Match The Old Password
        if(!Hash::check($request->current_password, Auth::user()->password)) {
            return response()->json(['status' => 0, 'result' => 'كلمة المرور الحالية غير صحيحة.']);
        }

        # Update the new Password
        User::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json(['status' => 1, 'result' => 'تم تحديث كلمة المرور بنجاح.']);
    }
}
