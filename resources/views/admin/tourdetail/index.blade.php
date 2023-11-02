@extends('admin.layoutadmin.layoutadmin')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-11 justify-content-end d-flex">
                    <a href="{{ route('tourdetails.create') }}" class="btn btn-light btn-sm">
                        <i class="fa fa-plus"></i>Add
                    </a>

                </div>
            </div>
        </div>
    </div>
    @if(count($errors) > 0 )
        <ul class="p-0 m-0" style="list-style: none;">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    @if(session()->has('message'))
        <div class="content-header mb-0 pb-0">
            <div class="container-fluid">
                <div class="mb-0 alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('message') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div><!-- /.container-fluid -->
        </div>
    @endif
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Authors table</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">id</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tour</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CheckinDate</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">CheckoutDate</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Vehicle</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">MaxParticipantNumber</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ChildrenPrice</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AdultPrice</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Discount</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DepatureLocation</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TripDescription</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ảnh</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tourdetails as $tourdetail)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$tourdetail->id}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$tourdetail->tour->tourName}}</p>
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
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$tourdetail->tripDescription}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <div id="imageCarousel" class="carousel slide" data-ride="carousel">
                                                <ol class="carousel-indicators">
                                                    <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
                                                    <li data-target="#imageCarousel" data-slide-to="1"></li>
                                                    <!-- Thêm các li với data-slide-to cho mỗi ảnh trong carousel -->
                                                </ol>
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        @foreach($tourdetail->tourimage as $tourImage)
                                                            <a href="{{ Storage::url($tourImage->imageUrl) }}" target="_blank">
                                                                <img width="100" src="{{ Storage::url($tourImage->imageUrl) }}" alt="image">
                                                            </a>
                                                        @endforeach
                                                    </div>

                                                </div>
                                                <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('tourdetails.edit', [$tourdetail]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                            <form onclick="return confirm('Are you sure?');" class="d-inline-block" action="{{ route('tourdetails.destroy', [$tourdetail]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete user" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    Delete
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
