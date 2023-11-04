@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Địa danh</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Địa danh</h6>
    </nav>
@endsection

@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('sites.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Tên địa danh</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="siteName" value="{{ old('siteName') }}" id="title">
                          </div>
                          @if ($errors->has('siteName'))
                              <span class="text-danger">{{ $errors->first('siteName') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Vị trí</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="location_id" id="location_id">
                                  @foreach($locations as $location)
                                      <option {{ (old('location_id') == $location->id) ? 'selected' : '' }} value="{{ $location->id }}">{{ $location->locationName }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" name="description" id="description" cols="30" rows="7">{{ old('description') }}</textarea>
                          </div>
                          @if ($errors->has('description'))
                              <span class="text-danger">{{ $errors->first('description') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                          <div class="col-sm-10">
                              <input type="file" name="image" class="form-control" id="imageUrl">
                          </div>
                          @if ($errors->has('image'))
                              <span class="text-danger">{{ $errors->first('image') }}</span>
                          @endif
                      </div>
                      <button type="submit" class="btn btn-success">Save</button>
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
