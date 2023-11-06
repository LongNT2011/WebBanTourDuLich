<?php
namespace App\Services\Implementation;
use App\Models\Dtos\PieChart;
use App\Models\Dtos\ChartData;
use App\Models\Dtos\LineChart;
use App\Models\Dtos\RadialBarChart;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Collection;
use DateTime; 
use Carbon\Carbon;  
trait ChartService {
    public $previousMonth;
    public $previousMonthStartDate;
    public $currentMonthStartDate;

    public function __construct()
    {
        $this->previousMonth = date('m') == '01' ? '12' : (date('m') - 1);
        $this->previousMonthStartDate = new DateTime(date('Y') . '-' . $this->previousMonth . '-01');
        $this->currentMonthStartDate = new DateTime(date('Y-m') . '-01');
    }

    public function GetBookingPieChartData() : PieChart{
        $startDate = Carbon::now()->subDays(30);
        $order = Order::where('orderDate', '>=', $startDate)
             ->where(function ($query) {
                 $query->where('paymentStatus', '!=', 'Pending')
                       ->orWhere('paymentStatus', 'Cancelled');
             })->get();

             $customerWithOneBooking = $order->groupBy('user_id')
             ->filter(function ($group) {
                 return $group->count() == 1;
             })->keys()->all();

             $bookingsByNewCustomer = count($customerWithOneBooking);
            $bookingsByReturningCustomer = count($order) - $bookingsByNewCustomer;

            $pieChart = new PieChart;
            $pieChart->setLabels(["Khách Hàng Mới", "Khách Hàng Cũ"]);
            $pieChart->setSeries([$bookingsByNewCustomer, $bookingsByReturningCustomer]);
            return $pieChart;
    }

    public function GetMemberAndBookingLineChartData() : LineChart{
            $startDate = Carbon::now()->subDays(30);
            $endDate = Carbon::now();


            $orderList = DB::table('orders')
            ->select('orderDate')
            ->where('orderDate', '>=', $startDate)
            ->where('orderDate', '<=', $endDate)
            ->get();
        
        $userList = DB::table('users')
            ->select('created_at')
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->get();
        
        $orderData = collect($orderList)
            ->groupBy(function ($order) {
                return Carbon::parse($order->orderDate);
            })
            ->map(function ($group) {
                return [
                    'created_at' => Carbon::parse($group->first()->orderDate),
                    'NewBookingCount' => $group->count()
                ];
            });
        
        $customerData = collect($userList)
            ->groupBy(function ($user) {
                return Carbon::parse($user->created_at);
            })
            ->map(function ($group) {
                return [
                    'created_at' => Carbon::parse($group->first()->created_at),
                    'NewCustomerCount' => $group->count()
                ];
            });
        
        $leftJoin = $orderData->groupBy('created_at')
            ->map(function ($bookingGroup) use ($customerData) {
                $customer = $customerData->firstWhere('created_at', $bookingGroup->first()['created_at']);
                return [
                    'created_at' => $bookingGroup->first()['created_at'],
                    'NewBookingCount' => $bookingGroup->first()['NewBookingCount'],
                    'NewCustomerCount' => $customer ? $customer['NewCustomerCount'] : null
                ];
            });
        
        $rightJoin = $customerData->groupBy('created_at')
            ->map(function ($customerGroup) use ($orderData) {
                $booking = $orderData->firstWhere('created_at', $customerGroup->first()['created_at']);
                return [
                    'created_at' => $customerGroup->first()['created_at'],
                    'NewBookingCount' => $booking ? $booking['NewBookingCount'] : null,
                    'NewCustomerCount' => $customerGroup->first()['NewCustomerCount']
                ];
            });
        
        

         //   $mergedData = $leftJoin->union($rightJoin)->sortBy('created_at')->values()->toArray();
         $mergedData = $orderData->map(function ($order) use ($customerData) {
            $customer = $customerData->firstWhere('created_at', $order['created_at']);
            return [
                'created_at' => $order['created_at'],
                'NewBookingCount' => $order['NewBookingCount'],
                'NewCustomerCount' => optional($customer)['NewCustomerCount'] ?? 0
            ];
        })->merge($customerData->map(function ($customer) use ($orderData) {
            $order = $orderData->firstWhere('created_at', $customer['created_at']);
            if (!$order) {
                return [
                    'created_at' => $customer['created_at'],
                    'NewBookingCount' => 0,
                    'NewCustomerCount' => $customer['NewCustomerCount']
                ];
            }
        }))->sortBy('created_at')->values()->toArray();

            $newBookingData = collect($mergedData)->pluck('NewBookingCount')->toArray();
            $newCustomerData = collect($mergedData)->pluck('NewCustomerCount')->toArray();
            $categories = collect($mergedData)->pluck('created_at')->map(function ($datetime) {
                return date_format($datetime,'m/d/Y');
            })->toArray();

            $chartDataList = [
                (new ChartData())
                    ->setName('Đơn Đặt Mới')
                    ->setData($newBookingData),
                (new ChartData())
                    ->setName('Khách Hàng Mới')
                    ->setData($newCustomerData)
            ];
            
            $lineChart = (new LineChart())
                ->setCategories($categories)
                ->setSeries($chartDataList);
            return $lineChart;
    }

    public function GetRadialCartDataModel(int $totalCount, float $currentMonthCount, float $prevMonthCount) : RadialBarChart{
        $chart = new RadialBarChart();
        $increaseDecreaseRatio = 100;

        if($prevMonthCount != 0)
            {
                $increaseDecreaseRatio = intval(($currentMonthCount - $prevMonthCount) / $prevMonthCount * 100);
            }
            $chart->setTotalCount($totalCount);
            $chart->setCountInCurrentMonth(intval($currentMonthCount));
            $chart->setHasRatioIncreased(($currentMonthCount > $prevMonthCount));
            $chart->setSeries(array($increaseDecreaseRatio));
            return $chart;
    }

    public function GetRegisteredUserChartData() : RadialBarChart{
        $userCount = User::count();
        $now = Carbon::now();
        $userCurrentCount = User::whereBetween('created_at', [$this->currentMonthStartDate, $now])->count();
        $userPreviousCount = User::whereBetween('created_at', [$this->previousMonthStartDate, $this->currentMonthStartDate])->count();
        return $this->GetRadialCartDataModel($userCount, $userCurrentCount, $userPreviousCount);
    }

    public function GetRevenueChartData() :  RadialBarChart{
        $now = Carbon::now();
        $order = Order::where(function ($query) {
            $query->where('paymentStatus', '!=', 'Pending')
                ->orWhere('paymentStatus', 'Cancelled');
        })->get();
        $totalRevenue = intval($order->sum('totalAmount'));
        $countByCurrentMonth = Order::where('orderDate', '>=', $this->currentMonthStartDate)
        ->where('orderDate', '<=', $now)
        ->where(function ($query) {
        $query->where('paymentStatus', '!=', 'Pending')
            ->orWhere('paymentStatus', 'Cancelled');
        })
        ->sum('totalAmount');
         
        $countByPreviousMonth = Order::where('orderDate', '>=', $this->previousMonthStartDate)
        ->where('orderDate', '<=', $this->currentMonthStartDate)
        ->where(function ($query) {
        $query->where('paymentStatus', '!=', 'Pending')
            ->orWhere('paymentStatus', 'Cancelled');
        })
        ->sum('totalAmount');

        return $this->GetRadialCartDataModel($totalRevenue, $countByCurrentMonth, $countByPreviousMonth);
    }

    public function GetTotalBookingRadialChartData() : RadialBarChart {
        $now = Carbon::now();
        $orders = Order::where(function ($query) {
            $query->where('paymentStatus', '!=', 'Pending')
                ->orWhere('paymentStatus', 'Cancelled');
        })->count();

        $countByCurrentMonth = Order::where('orderDate', '>=', $this->currentMonthStartDate)
        ->where('orderDate', '<=', $now)
        ->count();

        $countByPreviousMonth = Order::where('orderDate', '>=', $this->previousMonthStartDate)
        ->where('orderDate', '<=', $this->currentMonthStartDate)
        ->count();
        return $this->GetRadialCartDataModel($orders, $countByCurrentMonth, $countByPreviousMonth);
    }
}
?>