@extends('admin.layoutadmin.layoutadmin')

@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('sites.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">siteName</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="siteName" value="{{ old('siteName') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Location</label>
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
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                          <div class="col-sm-10">
                              <input type="file" name="image" class="form-control" id="imageUrl">
                          </div>
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
