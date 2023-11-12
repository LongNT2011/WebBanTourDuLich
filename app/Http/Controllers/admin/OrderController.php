<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Site;
use App\Models\Tour;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(5);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $tours = Tour::get(['id','tourName']);
        $users = User::get(['id','fullName']);
        return view('admin.order.edit',compact('order','tours','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $message = ['required' => 'Không được để trống!',];
        $request->validate([
            'orderDate' => 'required',
            'totalAmount' => 'required',
            'participantNumber' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
        ], $message);

        $order->update($request->all());

        Toastr::success('Sửa đơn đặt thành công!');

        return redirect()->route('orders.index');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        Toastr::success('Xóa đơn đặt thành công!' );
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $orders = Order::where('name', 'like', "%$query%")
            ->orWhere('orderDate', 'like', "%$query%")
            ->paginate(5);

        return view('admin.order.index', compact('orders'));

    }
}
