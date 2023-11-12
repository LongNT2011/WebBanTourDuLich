@extends('admin.layoutadmin.layoutadmin')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Quản trị viên</a>
            </li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Đơn đặt</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Đơn đặt</h6>
    </nav>
@endsection




@section('search')
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <form action="{{route('orders.search')}}" method="post">
            @csrf
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="query" placeholder="Tìm kiếm theo tên người đặt, ngày đặt">
            </div>

        </form>
    </div>
@endsection






@section('content')

    {{--    <div class="content-header">--}}
    {{--      <div class="container-fluid">--}}
    {{--        <div class="row mb-2">--}}
    {{--          <div class="col-sm-11 justify-content-end d-flex">--}}
    {{--              <a href="{{ route('orders.create') }}" class="btn btn-light btn-sm">--}}
    {{--                  <i class="fa fa-plus"></i>Thêm--}}
    {{--              </a>--}}

    {{--          </div>--}}
    {{--        </div>--}}
    {{--      </div>--}}
    {{--    </div>--}}
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Danh sách đơn đặt</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tour
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Ngày đặt tour
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số lượng người
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tổng tiền
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tình trạng thanh toán
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Số điện thoại
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$order->id}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$order->tour->tourName}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->orderDate}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->participantNumber}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->totalAmount}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="badge badge-sm {{($order->paymentStatus == 'Pending') ? 'bg-gradient-danger' : 'bg-gradient-success'}} ">{{($order->paymentStatus == 'Pending') ? 'Đang xử lý' : 'Thành công'}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->name}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->phone}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$order->email}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('orders.edit', [$order]) }}"
                                               class="text-primary font-weight-bold text-xs" data-toggle="tooltip"
                                               data-original-title="Edit hotel">
                                                Sửa
                                            </a>
                                            <form onclick="return confirm('Bạn có chắc chắn muốn xóa đơn đặt này không?');"
                                                  class="d-inline-block" action="{{ route('orders.destroy', [$order]) }}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#" class="text-danger font-weight-bold text-xs"
                                                   data-toggle="tooltip" data-original-title="Delete hotel"
                                                   onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Xóa
                                                </a>
                                            </form>
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination justify-content-center">
                            @if ($orders->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $orders->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($orders->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $orders->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
@endsection
