@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tour</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Tour</h6>
    </nav>
@endsection
@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('tours.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Tên tour</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="tourName" value="{{ old('tourName') }}" id="title">
                          </div>
                          @if ($errors->has('tourName'))
                              <span class="text-danger">{{ $errors->first('tourName') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Địa danh</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="sites[]" multiple>
                                  @foreach($sites as $site)
                                      <option value="{{ $site->id }}">{{ $site->siteName }}</option>
                                  @endforeach
                              </select>
                              @if ($errors->has('sites'))
                                  <span class="text-danger">{{ $errors->first('sites') }}</span>
                              @endif
                          </div>
                      </div>

                      <div class="form-group row border-bottom pb-4">
                          <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                          <div class="col-sm-10">
                              <img id="imagePreview" src="" alt="Ảnh được chọn" style="max-width: 100px; max-height: 100px; display: none;">
                              <input type="file" name="image" class="form-control" id="imageUrl" onchange="previewImage(this)">
                          </div>
                          @if ($errors->has('image'))
                              <span class="text-danger">{{ $errors->first('image') }}</span>
                          @endif
                      </div>
                      <button type="submit" class="btn btn-success">Lưu</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <script>
      function previewImage(input) {
          var imagePreview = document.getElementById('imagePreview');
          if (input.files && input.files[0]) {
              var reader = new FileReader();

              reader.onload = function(e) {
                  imagePreview.src = e.target.result;
                  imagePreview.style.display = 'block';
              };

              reader.readAsDataURL(input.files[0]);
          } else {
              imagePreview.style.display = 'none';
          }
      }
  </script>
@endsection
