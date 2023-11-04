@extends('admin.layoutadmin.layoutadmin')

@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Vị trí</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Ví trí</h6>
    </nav>
@endsection
@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('locations.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Tên vị trí</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="locationName" value="{{ old('locationName') }}" id="title">
                          </div>
                          @if ($errors->has('locationName'))
                              <span class="text-danger">{{ $errors->first('locationName') }}</span>
                          @endif
                      </div>
                      <button type="submit" class="btn btn-success">Lưu</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
{{--@section('styles')--}}
{{--    <style>--}}
{{--        .ck-editor__editable_inline {--}}
{{--            min-height: 200px;--}}
{{--        }--}}
{{--    </style>--}}
{{--@endsection--}}

{{--@section('scripts')--}}
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>--}}
{{--    <script>--}}
{{--        ClassicEditor--}}
{{--            .create( document.querySelector( '#description' ) )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
{{--@endsection--}}
