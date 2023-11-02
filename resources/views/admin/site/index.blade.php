@extends('admin.layoutadmin.layoutadmin')

@section('content')

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-11 justify-content-end d-flex">
              <a href="{{ route('sites.create') }}" class="btn btn-light btn-sm">
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">siteName</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">description</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">location</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">image</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($sites as $site)
                      <tr>
                        <td class="align-middle text-center">
                          <p class="text-xs font-weight-bold mb-0">{{$site->id}}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                        <p class="text-xs font-weight-bold mb-0">{{$site->siteName}}</p>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$site->description}}</span>
                        </td>
                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold">{{$site->location->locationName}}</span>
                        </td>
                        <td class="align-middle text-center">
                            <a href="{{ Storage::url($site->image) }}" target="_blank">
                                <img width="100" src="{{ Storage::url($site->image) }}" alt="{{ $site->siteName }}">
                            </a>
                        </td>
                          <td class="align-middle">
                              <a href="{{ route('sites.edit', [$site]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                  Edit
                              </a>
                              <form onclick="return confirm('Are you sure?');" class="d-inline-block" action="{{ route('sites.destroy', [$site]) }}" method="post">
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
                @if ($sites->onFirstPage())
                  <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                  </li>
                @else
                  <li class="page-item">
                    <a class="page-link" href="{{ $sites->previousPageUrl() }}" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
                @endif

                @foreach ($sites->getUrlRange(1, $sites->lastPage()) as $page => $url)
                  <li class="page-item {{ $page == $sites->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                  </li>
                @endforeach

                @if ($sites->hasMorePages())
                  <li class="page-item">
                    <a class="page-link" href="{{ $sites->nextPageUrl() }}" aria-label="Next">
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
