<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showSigninForm()
    {
        return view('auth.sign-in');
    }

    public function showSignupForm()
    {
        return view('auth.sign-up');
    }




    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 0])) {
            return redirect()->route('index');
        } else {
            return redirect()->back()->with('error', 'Email or Passwood is incorrect');
        }
    }

    public function signup(Request $request)
    {
        $request->merge(['password' => Hash::make($request->password)]);

        try {
            User::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        return redirect()->route('auth.signin');
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->back();
    }
}
