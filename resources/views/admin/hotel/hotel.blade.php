@extends('admin.layoutadmin.layoutadmin')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11 justify-content-end d-flex">
            <a href="#" class="btn btn-light btn-sm"> <i class="fa fa-plus"></i>Add</a>
          </div>
        </div>
      </div>
    </div>

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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mã khách sạn</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên khách sạn</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Địa chỉ</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Xếp hạng</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mô tả</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Giá/Người</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hình ảnh</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($hotels as $hotel)
                      <tr>
                        <td class="align-middle text-center">
                        {{--                          <div class="d-flex px-2 py-1">--}}
{{--                            <div>--}}
{{--                              <img src="../admin/assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1">--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-column justify-content-center">--}}
{{--                              <h6 class="mb-0 text-sm">John Michael</h6>--}}
{{--                              <p class="text-xs text-secondary mb-0">john@creative-tim.com</p>--}}
{{--                            </div>--}}
{{--                          </div>--}}
                          <p class="text-xs font-weight-bold mb-0">{{$hotel->id}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{$hotel->hotelName}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{$hotel->address}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                          <span class="badge badge-sm bg-gradient-success">{{$hotel->rating}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$hotel->description}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$hotel->pricePerPerson}}</span>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ Storage::url($hotel->imageUrl) }}" target="_blank">
                                <img width="100" src="{{ Storage::url($hotel->imageUrl) }}" alt="{{ $hotel->hotelName }}">
                            </a>
                        </td>
                          <td class="align-middle">
                              <a href="{{ route('hotels.edit', [$hotel]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                              </a>
                              <form onclick="return confirm('Are you sure?');" class="d-inline-block" action="{{ route('hotels.destroy', [$hotel]) }}" method="post">
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
