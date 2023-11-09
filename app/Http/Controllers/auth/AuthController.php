<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->email_verified_at == null) {
                Toastr::error('Tài khoản này chưa được xác minh. Vui lòng kiểm tra thư xác minh trong hộp thư của bạn.');
                return redirect()->back();
            } elseif (Auth::user()->isAdmin == 1) {
                Toastr::error('Tài khoản không hợp lệ!');
                return redirect()->back();
            } else {
                Toastr::success('Đăng nhập thành công!');
                return redirect()->route('index');
            }
        } else {
            Toastr::error('Email hoặc Mật khẩu không đúng!');
            return redirect()->back();
        }
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

//        $request->merge(['password' => Hash::make($request->password)]);
//        try {
//            User::create($request->all());
//        } catch (\Throwable $th) {
//            dd($th);
//        }
        $user = new User();
        $user->fullName = $request->fullName;
        $user->email = trim($request->email);
        $user->password = trim(Hash::make($request->password));
        $user->remember_token = Str::random(40);
        $user->save();
        Mail::to($user->email)->send(new RegisterMail($user));
        Toastr::success('Đăng ký thành công! Kiểm tra hòm thư để xác minh tài khoản.');
        return redirect()->route('auth.signin');
    }

    public function signout()
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->back();
    }

    public function verifyNotification()
    {
        return view('auth.verify-email');
    }

    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            Toastr::success('Xác minh tài khoản thành công!');
            return redirect()->route('auth.signin');
        } else {
            abort(404);
        }
    }

    public function resendVerifyEmail()
    {
//        $user = Auth::user();
//        if ($user && empty($user->email_verified_at)) {
//            Mail::to($user->email)->send(new RegisterMail($user));
//            Toastr::
//            return redirect()->back()->with('msg', 'Một email xác minh đã được gửi đến địa chỉ email của bạn. Vui lòng kiểm tra email của bạn.');
//        }
//        return redirect()->back()->with('msg', 'Rất tiếc, hiện tại chúng tôi không thể gửi lại email xác minh.');
    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (!empty($user)) {
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            Toastr::info('Vui lòng kiểm tra hòm thư của bạn và cài lại mật khẩu!');
            return redirect()->back();

        } else {
            Toastr::error('Email bạn nhập không có trên hệ thống');
            return redirect()->back();
        }
    }

    public function reset($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            $data['user'] = $user;
            return view('auth.reset', $data);
        } else {
            abort(404);
        }
    }

    public function resetPassword($token, Request $request)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if (!empty($user)) {
            if ($request->password == $request->cpassword) {
                $user->password = Hash::make($request->password);
                if (empty($user->email_verified_at)) {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();
                Toastr::success('Cài lại mật khẩu thành công');
                return redirect()->route('auth.signin');
            } else {
                Toastr::error('Xác nhận mật khẩu không chính xác');
                return redirect()->back();
            }
        } else {
            abort(404);
        }
    }
}
