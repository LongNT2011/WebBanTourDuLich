@extends('admin.layoutadmin.layoutadmin')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Quản trị viên</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Chi tiết Tour</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Chi tiết Tour</h6>
    </nav>
@endsection




{{--@section('search')--}}
{{--    <div class="ms-md-auto pe-md-3 d-flex align-items-center">--}}
{{--        <form action="{{route('tourdetails.search',[$tour])}}" method="post">--}}
{{--            @csrf--}}
{{--            <div class="input-group">--}}
{{--                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>--}}
{{--                <input type="text" class="form-control" name="query" placeholder="Tìm theo thời gian bắt đầu hoặc địa điểm xuất phát"">--}}
{{--            </div>--}}

{{--        </form>--}}
{{--    </div>--}}
{{--@endsection--}}

@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Danh sách chi tiết Tour</h6>
                        <a href="{{ route('tourdetails.create') }}" class="btn btn-primary btn-sm">
                            Thêm chi tiết Tour
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày bắt đầu</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày kết thúc</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phương tiện di chuển</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Số người tối đa</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá trẻ em</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá người lớn</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giảm giá</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Địa điểm xuất phát</th>
{{--                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chương trình tour</th>--}}
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ảnh</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tourdetails as $tourdetail)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$tourdetail->id}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$tourdetail->checkInDate}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$tourdetail->checkOutDate}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->vehicle}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->maxParticipant}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->childrenPrice}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->adultPrice}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->discount}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->depatureLocation}}</span>
                                        </td>
{{--                                        <td class="align-middle text-center">--}}

{{--                                        <span class="text-secondary text-xs font-weight-bold">--}}
{{--                                            {!! substr($tourdetail->tripDescription, 0, 20) !!}--}}
{{--                                        </span>--}}

{{--                                        </td>--}}
                                        <td class="align-middle text-center">
                                            @if(count($tourdetail->tourimage) > 0)
                                                <a href="{{ Storage::url($tourdetail->tourimage[0]->imageUrl) }}" target="_blank">
                                                    <img width="100" src="{{ Storage::url($tourdetail->tourimage[0]->imageUrl) }}" alt="image">
                                                </a>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('tourdetails.edit', [$tourdetail]) }}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit hotel">
                                                Sửa
                                            </a>
                                            <form onclick="return confirm('Bạn có chắc chắn muốn xóa chi tiết tour này không?');" class="d-inline-block" action="{{ route('tourdetails.destroy', [$tourdetail]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#" class="text-danger font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete hotel" onclick="event.preventDefault(); this.closest('form').submit();">
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
                            @if ($tourdetails->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tourdetails->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @foreach ($tourdetails->getUrlRange(1, $tourdetails->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $tourdetails->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($tourdetails->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $tourdetails->nextPageUrl() }}" aria-label="Next">
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
