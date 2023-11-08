<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\TourDetail;
use App\Models\TourImage;
use Illuminate\Http\Request;

class OrderController extends Controller
{
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
}
