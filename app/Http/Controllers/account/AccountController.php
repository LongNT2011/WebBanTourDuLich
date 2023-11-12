<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function showAccountDetail(){
        $user = Auth::user();
        return view('account.account-detail', ['user' => $user]);
    }

    public function updateAccount(Request $request, User $user) {
        $message = ['required' => 'Không được để trống', 'numeric' => 'Chỉ được nhập số'];
        $request->validate([
            'fullName'=> 'required',
            'email'=> 'required',
            'phoneNumber' => 'required|numeric',
            'address' => 'required'
        ], $message);
        $user->update([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request -> address,
        ]);
        Toastr::success('Update profile thành công!' );
        return redirect() -> back();
    }
}
