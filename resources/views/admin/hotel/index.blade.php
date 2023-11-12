@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Quản trị viên</a>
            </li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Khách sạn</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Khách sạn</h6>
    </nav>
@endsection

@section('search')
    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
        <form action="{{route('hotels.search')}}" method="post">
            @csrf
            <div class="input-group">
                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                <input type="text" class="form-control" name="query" placeholder="Tìm theo tên, giá tiền..">
            </div>

        </form>
    </div>
@endsection


@section('content')

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Danh sách khách sạn</h6>
                        <a href="{{ route('hotels.create') }}" class="btn btn-primary btn-sm">
                            Thêm khách sạn
                        </a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Tên khách sạn
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa danh
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Địa chỉ
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Đánh giá
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Mô tả
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Giá/Người
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Hình ảnh
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($hotels as $hotel)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$hotel->id}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$hotel->hotelName}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$hotel->site->siteName}}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">{{$hotel->address}}</p>
                                        </td>

                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{$hotel->rating}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$hotel->description}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary text-xs font-weight-bold">{{$hotel->pricePerPerson}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="{{ Storage::url($hotel->imageUrl) }}" target="_blank">
                                                <img width="100" src="{{ Storage::url($hotel->imageUrl) }}"
                                                     alt="{{ $hotel->hotelName }}">
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('hotels.edit', [$hotel]) }}" class="text-primary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit hotel">
                                                Sửa
                                            </a>
                                            <form onclick="return confirm('Bạn có chắc chắn muốn xóa khách sạn này không?');" class="d-inline-block" action="{{ route('hotels.destroy', [$hotel]) }}" method="post">
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
                            @if ($hotels->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $hotels->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @foreach ($hotels->getUrlRange(1, $hotels->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $hotels->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            @if ($hotels->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $hotels->nextPageUrl() }}" aria-label="Next">
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
