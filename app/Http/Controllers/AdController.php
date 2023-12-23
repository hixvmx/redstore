<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Country;
use App\Models\City;
use App\Models\Ad;
use App\Models\FavoriteAd;
use Illuminate\Support\Facades\Auth;
use Str;

class AdController extends Controller
{
    public function ShowAdPage(string $slug) {

        $ad = Ad::where('slug', $slug)->first();
        if (!$ad) return redirect('/');
        

        return view('ad', compact('ad'));
    }


    public function ShowNewAdPage() {

        $categories = Category::select('id','name','slug')
        ->latest()
        ->get();

        $sub_categories = SubCategory::select('id','name','slug','category')
        ->latest()
        ->get();

        $countries = Country::select('id','name','slug')
        ->latest()
        ->get();

        $cities = City::select('id','name','slug','country')
        ->latest()
        ->get();

        $currencies = Currency::select('id','name')
        ->latest()
        ->get();
        

        return view('newAd', compact('categories','sub_categories','countries','cities','currencies'));
    }


    public function ShowEditAdPage(string $slug) {
        
        $authUserId = Auth::user()->id;

        $ad = Ad::where('slug', $slug)->where('publisher', $authUserId)->first();

        if (!$ad) return redirect('/');

        $categories = Category::select('id','name','slug')
        ->latest()
        ->get();

        $sub_categories = SubCategory::select('id','name','slug','category')
        ->latest()
        ->get();

        $countries = Country::select('id','name','slug')
        ->latest()
        ->get();

        $cities = City::select('id','name','slug','country')
        ->latest()
        ->get();

        $currencies = Currency::select('id','name')
        ->latest()
        ->get();

        return view('editAd', compact('ad','categories','sub_categories','countries','cities','currencies'));
    }


    public function saveNewAd(Request $request) {
        $request->validate([
            'title' => 'required|max:255',
            'price' => 'required|integer',
            'currency' => 'required|integer',
            'category' => 'required|integer',
            'sub_category' => 'required|integer',
            'country' => 'required|integer',
            'city' => 'required|integer',
            'image' => 'required',
            'images' => 'required',
        ]);

        $authUserId = Auth::user()->id;

        if ($pic = $request->file('image')) {
            $p_extension = $pic->getClientOriginalExtension();
            $p_newname = $authUserId .'-'. Str::random(25) . '.' . $p_extension;
            $pic->move('image/ad/',$p_newname);
            $imagePath = $p_newname;
        }

        if($request->hasfile('images')) {
            $imagesPaths = [];
            foreach($request->file('images') as $key => $file)
            {
                $img_extension = $file->getClientOriginalExtension();
                $new_name = $authUserId .'-'. Str::random(20) . '.' . $img_extension;
                $file->move('image/ad/more/',$new_name);
                $imagesPaths[] = $new_name;
            }
            $imagesPaths = implode(',', $imagesPaths);
        }

        Ad::create([
            "title" => $request->title,
            "price" => $request->price,
            "currency" => $request->currency,
            "category" => $request->category,
            "sub_category" => $request->sub_category,
            "country" => $request->country,
            "city" => $request->city,
            "image" => $imagePath,
            "images" => $imagesPaths,
            "publisher" => $authUserId
        ]);
        
        return response()->json([
            'status' => '1',
            'result' => 'تم نشر الإعلان بنجاح.',
        ]);
    }


    public function updateAd(Request $request) {
        $request->validate([
            'slug' => 'required|max:255',
            'price' => 'required|integer',
            'currency' => 'required|integer',
            'category' => 'required|integer',
            'sub_category' => 'required|integer',
            'country' => 'required|integer',
            'city' => 'required|integer',
        ]);


        $authUserId = Auth::user()->id;


        $appUrl = \Config::get('values.APP_URL');


        // get ad
        $ad = Ad::where('slug', $request->slug)->where('publisher', $authUserId)->first();
        if (!$ad) {
            return response()->json(['status' => '0', 'result' => 'لم يتم العثور على الإعلان']);
        }


        $imagePath = '';
        if ($pic = $request->file('image')) {
            $p_extension = $pic->getClientOriginalExtension();
            $p_newname = $authUserId .'-'. Str::random(25) . '.' . $p_extension;
            $pic->move('image/ad/',$p_newname);
            $imagePath = $p_newname;

            // remove old image
            $imageOldPath = str_replace($appUrl, '', $ad->image);
            unlink($imageOldPath);
        }


        $imagesPaths = [];
        if($request->hasfile('images')) {
            foreach($request->file('images') as $key => $file)
            {
                $img_extension = $file->getClientOriginalExtension();
                $new_name = $authUserId .'-'. Str::random(20) . '.' . $img_extension;
                $file->move('image/ad/more/',$new_name);
                $imagesPaths[] = $new_name;
            }
            $imagesPaths = implode(',', $imagesPaths);

            // remove old images
            foreach ($ad->images as $img) {
                $imagesOldPaths = str_replace($appUrl, '', $img);
                unlink($imagesOldPaths);
            }
        }


        $ad->price = $request->price;
        $ad->currency = $request->currency;
        $ad->category = $request->category;
        $ad->sub_category = $request->sub_category;
        $ad->country = $request->country;
        $ad->city = $request->city;
        if (!empty($imagePath))
        {
            $ad->image = $imagePath;
        }
        if (!empty($imagesPaths))
        {
            $ad->images = $imagesPaths;
        }
        $ad->save();


        return response()->json([
            'status' => '1',
            'result' => 'تم تحديث الإعلان بنجاح.',
        ]);
    }


    public function deleteAd(string $slug) {

        $authUserId = Auth::user()->id;

        $appUrl = \Config::get('values.APP_URL');


        // get ad
        $ad = Ad::where('slug', $slug)->where('publisher', $authUserId)->first();
        if (!$ad) return redirect('/');

        
        // remove image
        $imageOldPath = str_replace($appUrl, '', $ad->image);
        unlink($imageOldPath);


        // remove images
        foreach ($ad->images as $img) {
            $imagesOldPaths = str_replace($appUrl, '', $img);
            unlink($imagesOldPaths);
        }


        $ad->delete();


        return redirect('/');
    }


    public function addToMyFavorites(Request $request) {

        $authUserId = Auth::user()->id;
        $adId = $request->id;


        $isFav = FavoriteAd::select('id')
        ->where('user', $authUserId)
        ->where('ad', $adId)
        ->first();

        
        if(!$isFav) {
            FavoriteAd::create([
                'user' => $authUserId,
                'ad' => $adId,
            ]);
        }


        return response()->json([
            'status' => '1',
            'result' => 'Success',
        ]);
    }


    public function removeFromMyFavorites(Request $request) {

        $authUserId = Auth::user()->id;
        $adId = $request->id;


        FavoriteAd::where('user', $authUserId)->where('ad', $adId)->delete();


        return response()->json([
            'status' => '1',
            'result' => 'Success',
        ]);
    }
}
