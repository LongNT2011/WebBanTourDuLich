<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Implementation\ChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use ChartService;
    public function index(){
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

    public function GetBookingPieChartDataDb(){
        $data = $this->GetBookingPieChartData();
        return response()->json($data, 201);
    }

    public function GetMemberAndBookingLineChartDataDb(){
        $data = $this->GetMemberAndBookingLineChartData();
        return response()->json($data, 201);
    }

    public function GetRevenueChartDataDb(){
        $data = $this->GetRevenueChartData();
        return response()->json($data, 201);
    }

    public function GetRegisteredUserChartDataDb(){
        $data = $this->GetRegisteredUserChartData();
        return response()->json($data, 201);
    }

    public function GetTotalBookingRadialChartDataDb(){
        $data = $this->GetTotalBookingRadialChartData();
        return response()->json($data, 201);
    }
}
