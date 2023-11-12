@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Quản trị viên</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Đơn đặt</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Đơn đặt</h6>
    </nav>
@endsection


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{route('orders.update',[$order])}}">
                        @csrf
                        @method('put')
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">Tour</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="tour_id" id="location_id">
                                    @foreach($tours as $tour)
                                        <option value="{{ $tour->id }}" {{ ($order->tour_id == $tour->id) ? 'selected' : '' }}>
                                            {{ $tour->tourName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">Người dùng</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="user_id" id="location_id">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($order->user_id == $user->id) ? 'selected' : '' }}>
                                            {{ $user->id }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Ngày đặt tour</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="orderDate" value="{{ $order->orderDate ? date('Y-m-d', strtotime($order->orderDate)) : '' }}">
                            </div>
                            @if ($errors->has('orderDate'))
                                <span class="text-danger">{{ $errors->first('orderDate') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Số lượng người</label>
                            <div class="col-sm-10">

                                <input type="number" class="form-control" name="participantNumber" value="{{ old('participantNumber',$order->participantNumber) }}" id="title">
                            </div>
                            @if ($errors->has('participantNumber'))
                                <span class="text-danger">{{ $errors->first('participantNumber') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Tổng tiền</label>
                            <div class="col-sm-10">

                                <input type="number" class="form-control" name="totalAmount" value="{{ old('totalAmount',$order->totalAmount) }}" id="title">
                            </div>
                            @if ($errors->has('totalAmount'))
                                <span class="text-danger">{{ $errors->first('totalAmount') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Trạng thái thanh toán</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="paymentStatus">
                                    <option value="Approved" {{ $order->paymentStatus == 'Approved' ? 'selected' : '' }}>Thành công</option>
                                    <option value="Pending" {{ $order->paymentStatus == 'Pending' ? 'selected' : '' }}>Đang xử lý</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Tên</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" value="{{ old('name',$order->name) }}" id="title">
                            </div>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Số điện thoại</label>
                            <div class="col-sm-10">

                                <input type="tel" class="form-control" name="phone" value="{{ old('phone',$order->phone) }}" id="title">
                            </div>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">

                                <input type="text" class="form-control" name="email" value="{{ old('email',$order->email) }}" id="title">
                            </div>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

