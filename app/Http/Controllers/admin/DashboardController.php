<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Implementation\ChartService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use ChartService;

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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->email_verified_at == null) {
                Toastr::error('Tài khoản này chưa được xác minh. Vui lòng kiểm tra thư xác minh trong hộp thư của bạn.');
                return redirect()->back();
            } elseif (Auth::user()->isAdmin == 0) {
                Toastr::error('Tài khoản không hợp lệ!');
                return redirect()->back();
            } else {
                Toastr::success('Đăng nhập thành công!');
                return redirect()->route('dashboard');
            }
        } else {
            Toastr::error('Email hoặc Mật khẩu không đúng!');
            return redirect()->back();
        }
    }

    public function signoutAdmin()
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công!');
        return redirect()->route('admin.signinAdmin');
    }

    public function GetBookingPieChartDataDb()
    {
        $data = $this->GetBookingPieChartData();
        return response()->json($data, 201);
    }

    public function GetMemberAndBookingLineChartDataDb()
    {
        $data = $this->GetMemberAndBookingLineChartData();
        return response()->json($data, 201);
    }

    public function GetRevenueChartDataDb()
    {
        $data = $this->GetRevenueChartData();
        return response()->json($data, 201);
    }

    public function GetRegisteredUserChartDataDb()
    {
        $data = $this->GetRegisteredUserChartData();
        return response()->json($data, 201);
    }

    public function GetTotalBookingRadialChartDataDb()
    {
        $data = $this->GetTotalBookingRadialChartData();
        return response()->json($data, 201);
    }
}
