<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Hash;
use Session;


class UserController extends Controller
{
    public function ShowRegisterPage() {
        return view('auth/register');
    }



    public function SaveNewUser(Request $request) {
        $validation = $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|min:5',
        ]);


        // generate unique username
        $username = $request->firstname .'-'.$request->lastname;
        $username = str_replace(' ', '', $username);
        $countUsernames = User::where("username", $username)->orWhere('username', 'LIKE', $username . '%')->count();
        $username = $countUsernames ? "{$username}-{$countUsernames}" : $username;
        

        // save user data
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        return response()->json([
            'status'   =>    '1',
            'result'   =>    'تم إنشاء الحساب بنجاح.'
        ]);
    }



    public function ShowLoginPage() {
        return view('auth/login');
    }



    public function login(Request $request) {
        $validation = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);  

        $data = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($data)) {
            return response()->json([
                'status'   =>    '1',
                'result'   =>    'تم تسجيل الدخول بنجاح.'
            ]);
        }

        return response()->json([
            'status'   =>    '0',
            'result'   =>    'بيانات الدخول خاطئة.'
        ]);
    }

    

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }
}
