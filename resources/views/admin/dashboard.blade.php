@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Thống Kê</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Thống Kê</h6>
    </nav>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Thống Kê</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="totalBookingsRadialChart" data-colors='["--bs-success"]'></div>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng Lượt Đặt Tour</p>
                        <h4 class="my-1">
                            <span id="spanTotalBookingCount">XX</span>
                        </h4>
                    </div>
                    <p class="text-muted mt-3 mb-0" id="sectionBookingCount"></p>

                    <div class="justify-content-center text-center chart-spinner" style="display:none">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="totalUserRadialChart" data-colors='["--bs-warning"]'></div>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng Khách Hàng</p>
                        <h4 class="my-1">
                            <span id="spanTotalUserCount">XX</span>
                        </h4>
                    </div>
                    <p class="text-muted mt-3 mb-0" id="sectionUserCount"></p>

                    <div class="justify-content-center text-center chart-spinner" style="display:none">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <div id="totalRevenueRadialChart" data-colors='["#F0006B"]'></div>
                    </div>
                    <div>
                        <p class="text-muted mb-0">Tổng Doanh Thu</p>
                        <h4 class="my-1">
                            <span id="spanTotalRevenueCount">XX</span>
                        </h4>
                    </div>
                    <p class="text-muted mt-3 mb-0" id="sectionRevenueCount"></p>

                    <div class="justify-content-center text-center chart-spinner" style="display:none">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-8 mt-2">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-muted mb-0">Khách Hàng Mới Và Lượt Đặt Tour Trong 30 Ngày Qua</p>
                    </div>
                    <div id="newMembersAndBookingsLineChart" data-colors='["--bs-warning","--bs-primary"]'>
                    </div>
                    <div class="justify-content-center text-center chart-spinner" style="display:none">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-4 mt-2">
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <p class="text-muted mb-0">Thống Kê Dữ Liệu Đặt Hàng</p>
                    </div>
                    <div id="customerBookingsPieChart" data-colors='["--bs-warning","--bs-primary"]'>
                    </div>

                    <div class="justify-content-center text-center chart-spinner" style="display:none">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('admin/assets/dashboard/radailChart.js')}}"></script>
    <script src="{{ asset('admin/assets/dashboard/getTotalBookingsRadial.js')}}"></script>
    <script src="{{ asset('admin/assets/dashboard/getTotalRevenueRadial.js')}}"></script>
    <script src="{{ asset('admin/assets/dashboard/getTotalUserRadial.js')}}"></script>
    <script src="{{ asset('admin/assets/dashboard/getCustomerBookingPieChart.js')}}"></script>
    <script src="{{ asset('admin/assets/dashboard/getCustomerAndBookingLineChart.js')}}"></script>
@endsection
