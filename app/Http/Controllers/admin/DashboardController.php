<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showSigninAdminForm()
    {
        return view('admin.sign-in');
    }

    public function signinAdmin(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isAdmin' => 1])) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', 'Email or Passwood is incorrect');
        }
    }

    public function signoutAdmin()
    {
        Auth::logout();
        return redirect()->route('admin.signinAdmin');
    }
}
