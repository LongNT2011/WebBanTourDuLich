<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\Implementation\ChartService;
class DashboardController extends Controller
{
    use ChartService;
    public function index(){
        return view('admin.dashboard');
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
