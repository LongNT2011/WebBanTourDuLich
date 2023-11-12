<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order Detail</title>
</head>

<body>
    <div class="container pt-4 mt-0 mt-lg-4">
        <div class="row" style="border: 1px solid #aaa;">

            <div class="col-12 col-lg-7 p-4 2 mt-4 mt-md-0">
                <div class="row p-1 my-1 " style="border-radius:20px; ">
                    <div class="col-6">
                        <h3 class="text-success">Thông Tin Đơn Hàng</h3>
                    </div>
                    <div class="text-end col-6 ">
                        <a asp-controller="Home" asp-action="Index" href="{{ route('index') }}" class="btn btn-sm btn-outline-danger"
                            style="width:200px;">
                            <i class="bi bi-arrow-left-square"></i> &nbsp; Trở Lại
                        </a>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-12 col-md-5">
                            <img src="{{ Storage::url($tourImage->imageUrl) }}" style="border-radius:10px;"
                                width="100%" />
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="row p-2">
                                <div class="col-12">
                                    <p class="card-title text-danger" style="font-size:xx-large">Tên tour:
                                        {{ $tour->tourName }}</p>
                                </div>
                            </div>
                            <div class="row col-12">
                                <span class="text-end p-0 pt-3 m-0">
                                    <span class="float-right">Số Người:
                                        {{ $orderPreview->participantNumber }}</span><br />
                                    <span class="float-right pt-1">Khuyến Mãi: {{ $tourDetail->discount?? 0 }} %</span><br/>
                                    <span class="float-right pt-1">Khách sạn: {{ $hotel->hotelName}}</span><br />
                                    <p class="text-danger font-weight-bold pt-1">
                                        <span style=" #ff6a00">
                                            Giá / Người lớn: {{ number_format($tourDetail->adultPrice, 0, ',', '.')}} VNĐ
                                        </span>
                                    </p>
                                    <p class="text-danger font-weight-bold pt-1">
                                        <span style=" #ff6a00">
                                            Giá / Trẻ em: {{ number_format($tourDetail->childrenPrice, 0, ',', '.') }} VNĐ
                                        </span>
                                    </p>
                                    <p class="text-danger font-weight-bold pt-1">
                                        <span style=" #ff6a00">
                                            Giá khách sạn: {{ number_format($hotel->pricePerPerson, 0, ',', '.') }} VNĐ
                                        </span>
                                    </p>
                                </span>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="text-end">
                        <h4 class="text-danger font-weight-bold ">
                            Tổng Tiền :
                            <span style="border-bottom:1px solid #ff6a00">
                                @php

                                    $adultPrice = ($orderPreview->participantNumber - $orderPreview ->participantChildrenNumber) * $tourDetail->adultPrice;
                                    $hotelPrice = ($hotel->pricePerPerson * $orderPreview->participantNumber);
                                    $childrenPrice = $orderPreview ->participantChildrenNumber * $tourDetail->childrenPrice;
                                    $discount = ($adultPrice + $childrenPrice + $hotelPrice) * ($tourDetail->discount/100);
                                    $total = ($adultPrice + $childrenPrice + $hotelPrice) - $discount;
                                    $formattedTotal = number_format($total, 0, ',', '.');
                                    $participantNumber = $orderPreview->participantNumber;
                                @endphp
                                {{ $formattedTotal }}
                                 VNĐ
                            </span>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5 p-4 2 mt-4 mt-md-0" style="border-left:1px solid #aaa">
                <form action="{{ route('CheckoutOrder') }}" method="post">
                    @csrf
                    <input name="total" type="hidden" value="{{ $total }}"/>
                    <input name="participantNumber" type="hidden" value="{{ $participantNumber }}"/>
                    <input name="tourid" type="hidden" value="{{ $tourDetail->tour_id }}"/>
                    <input name="tourName" type="hidden" value="{{ $tour->tourName }} "/>
                    <input name="hotelName" type="hidden" value="{{ $hotel->hotelName}}"/>
                    <input name="Name" type="hidden" value="{{ $orderPreview->fullName }}"/>
                    <input name="Phone" type="hidden" value="{{ $orderPreview->phone }}"/>
                    <input name="Email" type="hidden" value="{{ $orderPreview->email }}"/>

                    <div class="row pt-1 mb-3 " style="border-radius:20px; ">
                        <div class="col-12">
                            <h3 class="text-success">Xác nhận thông tin</h3>
                        </div>
                    </div>

                    <div class="form-group pt-0">
                        <label asp-for="Name" class="text-danger">Tên</label>
                        <input name="Name" disabled class="form-control" value="{{ $orderPreview->fullName }}" />
                        <span asp-validation-for="Name" class="text-danger"></span>
                    </div>
                    <div class="form-group pt-2">
                        <label asp-for="Phone" class="text-danger">Số điện thoại</label>
                        <input name="Phone" disabled class="form-control" value="{{ $orderPreview->phone }}" />
                        <span asp-validation-for="Phone" class="text-danger"></span>
                    </div>
                    <div class="form-group pt-2">
                        <label asp-for="Email" class="text-danger">Email</label>
                        <input name="Email" disabled class="form-control" value="{{ $orderPreview->email }}" />
                        <span asp-validation-for="Email" class="text-danger"></span>
                    </div>
                    <div class="form-group pt-2">
                        <label asp-for="CheckInDate" class="text-danger">Ngày checkin</label>
                        <input asp-for="CheckInDate" disabled class="form-control"
                            value="{{ $tourDetail->checkInDate }}" />
                    </div>
                    <div class="form-group pt-2">
                        <label asp-for="CheckOutDate" class="text-danger">Ngày checkout</label>
                        <input asp-for="CheckOutDate" disabled class="form-control"
                            value="{{ $tourDetail->checkOutDate }}" />
                    </div>
                    <div class="form-group pt-2 pt-md-4">
                        <button type="submit" class="btn btn-success form-control">Thanh Toán</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
