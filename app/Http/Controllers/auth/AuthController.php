<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
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
        $request->validate([
            'email'=> 'required|email',
            'password'=>'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 0])) {
            Toastr::success('Đăng nhập thành công!' );
            return redirect()->route('index');
        } else if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 1])) {
            Toastr::error('Tài khoản không hợp lệ!' );
            return redirect()->back();
        } else {
            Toastr::error('Email hoặc Mật khẩu không đúng!' );
            return redirect()->back();
        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email'=> 'required|email|unique:users,email',
            'password'=>'required',
        ]);

        $request->merge(['password' => Hash::make($request->password)]);

        try {
            User::create($request->all());
        } catch (\Throwable $th) {
            dd($th);
        }
        Toastr::success('Đăng ký thành công!' );
        return redirect()->route('auth.signin');
    }

    public function signout()
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!' );
        return redirect()->back();
    }
}
