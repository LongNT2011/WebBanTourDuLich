@extends('admin.layoutadmin.layoutadmin')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11 justify-content-end d-flex">
              <a href="{{ route('locations.create') }}" class="btn btn-light btn-sm">
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Location name</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($locations as $location)
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
                          <p class="text-xs font-weight-bold mb-0">{{$location->id}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{$location->locationName}}</p>
                        </td>
                          <td class="align-middle">
                              <a href="{{ route('locations.edit', [$location]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                              </a>
                              <form onclick="return confirm('Are you sure?');" class="d-inline-block" action="{{ route('locations.destroy', [$location]) }}" method="post">
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
                @if ($locations->onFirstPage())
                  <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                  </li>
                @else
                  <li class="page-item">
                    <a class="page-link" href="{{ $locations->previousPageUrl() }}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                @endif

                @foreach ($locations->getUrlRange(1, $locations->lastPage()) as $page => $url)
                  <li class="page-item {{ $page == $locations->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                  </li>
                @endforeach

                @if ($locations->hasMorePages())
                  <li class="page-item">
                    <a class="page-link" href="{{ $locations->nextPageUrl() }}" aria-label="Next">
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
