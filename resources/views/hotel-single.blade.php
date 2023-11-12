@extends('layouts.master')

@section('content')

    <div class="hero-wrap js-fullheight" style="background-image: url({{ asset('images/bg_5.jpg') }});">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
                data-scrollax-parent="true">
                <div class="col-md-9 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
                    <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span
                            class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a
                                href="hotel.html">Tour</a></span> <span>Chi Tiết Tour</span></p>
                    <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Chi Tiết Tour
                    </h1>
                </div>
            </div>
        </div>
    </div>


    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <!-- <div class="col-lg-3 sidebar">
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Find City</h3>
                        <form action="#">
                            <div class="fields">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Destination, City">
                                </div>
                                <div class="form-group">
                                    <div class="select-wrap one-third">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="" class="form-control"
                                            placeholder="Keyword search">
                                            <option value="">Select Location</option>
                                            <option value="">San Francisco USA</option>
                                            <option value="">Berlin Germany</option>
                                            <option value="">Lodon United Kingdom</option>
                                            <option value="">Paris Italy</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" id="checkin_date" class="form-control" placeholder="Date from">
                                </div>
                                <div class="form-group">
                                    <input type="text" id="checkin_date" class="form-control" placeholder="Date to">
                                </div>
                                <div class="form-group">
                                    <div class="range-slider">
                                        <span>
                                            <input type="number" value="25000" min="0" max="120000" /> -
                                            <input type="number" value="50000" min="0" max="120000" />
                                        </span>
                                        <input value="1000" min="0" max="120000" step="500" type="range" />
                                        <input value="50000" min="0" max="120000" step="500" type="range" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Search" class="btn btn-primary py-3 px-5">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-wrap bg-light ftco-animate">
                        <h3 class="heading mb-4">Star Rating</h3>
                        <form method="post" class="star-rating">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i
                                                class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">
                                    <p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i><i class="icon-star-o"></i><i
                                                class="icon-star-o"></i></span></p>
                                </label>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-md-12 ftco-animate">
                            <div class="single-slider owl-carousel">
                                @foreach ($detail->tourimage as $image)
                                    <div class="item">
                                        <div class="hotel-img"
                                            style="background-image: url({{ Storage::url($image->imageUrl) }});"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-12 hotel-single mt-4 mb-5 ftco-animate">
                            <span>Our Best hotels &amp; Rooms</span>
                            <h2>{{ $detail->tour->tourName }}</h2>
                            <p class="rate mb-5">
                                <span class="loc"><a href="#"><i class="icon-map"></i>
                                        {{ $detail->depatureLocation }}</a></span>
                                <!-- <span class="star">
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star"></i>
                                    <i class="icon-star-o"></i>
                                    8 Rating</span> -->
                            </p>
                            {!! $detail->tripDescription !!}
                        </div>
                        <form method="POST" action="{{ route('order.bookingtour', ['tourDetail' => $detail]) }}"
                            class="col-md-12 hotel-single ftco-animate mb-5 mt-4" enctype="multipart/form-data">
                            @csrf
                            @method('get')
                            <h4 class="mb-5">Đặt tour</h4>
                            <div class="fields">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Họ và tên"
                                                name="fullName">
                                            @error('fullName')
                                                <span class="text-danger">{{ $errors->first('fullName') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Số điện thoại"
                                                name="phone">
                                            @error('phone')
                                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Email"
                                                name="email">
                                            @error('email')
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Địa chỉ"
                                                name="address">
                                            @error('address')
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" placeholder="Số người tham gia"
                                                name="participantNumber">
                                            @error('participantNumber')
                                                <span class="text-danger">{{ $errors->first('participantNumber') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="participantChildrenNumber"
                                                placeholder="Trẻ em(nếu không có thì điền là 0)">
                                            @error('participantChildrenNumber')
                                                <span
                                                    class="text-danger">{{ $errors->first('participantChildrenNumber') }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="select-wrap one-third">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="hotelId" id="" class="form-control"
                                                placeholder="Chọn khách sạn">
                                                @foreach ($hotels as $hotel)
                                                    <option value="{{ $hotel->id }}">{{ $hotel->hotelName }}</option>
                                                @endforeach
                                            </select>
                                            @error('hotelId')
                                                <span class="text-danger">{{ $errors->first('hotelId') }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                            <input type="submit" value="Đặt Tour" class="btn btn-primary py-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> {{-- .col-md-8 --}}
            </div>
        </div>
    </section> {{-- .section --}}

@stop
