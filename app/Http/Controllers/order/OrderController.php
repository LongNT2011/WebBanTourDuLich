<?php

namespace App\Http\Controllers\order;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\TourDetail;
use App\Models\TourImage;
use Illuminate\Http\Request;
use App\Services\Implementation\PaymentService;
use App\Models\Dtos\PaymentRequest;
use App\Models\Dtos\PaymentResponse;
use App\Models\Order;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use PaymentService;
    public function showOrderView(Request $request, TourDetail $tourDetail)
    {
        $message = ['required' => 'Không được để trống'];
        $request->validate([
            'fullName' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'participantNumber' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($tourDetail) {
                    if ($value > $tourDetail->maxParticipant) {
                        $fail('không được lớn hơn ' . $tourDetail->maxParticipant);
                    }
                },
            ],
            'participantChildrenNumber' => ['required', 'numeric', function ($attribute, $value, $fail) use ($request) {
                $participantNumber = $request->participantNumber;
                if ($value >= $participantNumber) {
                    $fail('Số trẻ em phải nhỏ hơn số người tham gia (' . $participantNumber . ').');
                }
            }],
            'hotelId' => 'required',
        ], $message);
        $orderPreview = $request;
        $tourImage = TourImage::where('tour_detail_id', $tourDetail->id)->first();
        $tour = Tour::find($tourDetail->tour_id);
        $hotel = Hotel::find($request->hotelId);
        return view('order.orderDetail', compact('orderPreview', 'tourDetail', 'tourImage', 'tour', 'hotel'));
    }
    public function CheckoutOrder(Request $request){
        if (!Auth::check()) {
            return redirect()->route('auth.signin');
        } 
        else {
        $order = new Order();
        $order->orderDate =  Carbon::now();
        $order->participantNumber = $request->input('participantNumber');
        $order->totalAmount = $request->input('total');
        $order->paymentStatus = 'Pending';
        $order->name = $request->input('Name');
        $order->phone = $request->input('Phone');
        $order->email = $request->input('Email');
        $order->user_id = $userID = Auth::id();
        $order->tour_id =  $request->input('tourid');
      //  dd($order);
      //  $order->created_at = Carbon::now();
       // $order->updated_at = Carbon::now();
        $order->save();
        $orderID = $order->id;
        $hostRequest = app()->make('request');
        $domain = $request->getHost();
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https://' : 'http://';
        $paymentRequest = new PaymentRequest;
        $paymentRequest->setApproveUrl($protocol . $domain . ':8000/orderConfirm');
        $paymentRequest->setCancelUrl($protocol . $domain);

        $nameOrder = $request->input('tourName') . ' & ' . $request->input('hotelName');
        $orderPrice = $request->input('total');

        $paymentRequest->setName($nameOrder);
        $paymentRequest->setPrice($orderPrice);
        $response = $this->CheckOut($paymentRequest);
        // http_response_code(303);
        // header("Location: " . $response->getStripeSessionId());
        // call back
        $callback =  function ($orderID, $response) {
            // $orderOldInDb = DB::table('orders')
            // ->where('id', $orderID)
            // ->first();
            $orderOldInDb = Order::find($orderID);
            $orderOldInDb->sessionId = $response->getStripeSessionId();
            $orderOldInDb->save();
            // $orderNewInDb = DB::table('orders')
            // ->where('id', $orderID)
            // ->first();
            $orderNewInDb = Order::find($orderID);
            $check = $this->ValidatePayment($orderNewInDb->sessionId);
            $orderNewInDb->paymentStatus = 'Approved';
            $orderNewInDb->paymentIntentId = $check->getPaymentIntentId();
            $orderNewInDb->save();
        };

        $callback($orderID, $response);

        return redirect($response->getUrl());
        }
    }
    // public function orderConfirm(Request $request){
    //     $paymentResponse = $this->ValidatePayment($request->input('session_id'));
    //     $order = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->first();
    //     $order->paymentStatus = 'Paid';
    //     $order->paymentIntentId = $paymentResponse->getPaymentIntentId();
    //     $order->save();
    //     return redirect()->route('account.detail');
    // }
}
