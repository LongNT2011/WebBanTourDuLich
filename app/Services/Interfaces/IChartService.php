<?php
interface IChartService {
    public function GetTotalBookingRadialChartData() : RadialBarChart;
    public function GetRegisteredUserChartData() : RadialBarChart;
    public function GetRevenueChartData() : RadialBarChart;
    public function GetBookingPieChartData() : PieChart;
    public function GetMemberAndBookingLineChartData() : LineChart;
    public function GetRadialCartDataModel(int $totalCount, float $currentMonthCount, float $prevMonthCount) : RadialBarChart;
}
?>