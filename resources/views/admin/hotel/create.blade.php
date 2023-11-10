@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Khách sạn</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Khách sạn</h6>
    </nav>
@endsection




@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('hotels.store')}}" enctype="multipart/form-data" id="my-form">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Tên khách sạn</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="hotelName" value="{{ old('hotelName') }}" id="title"
                                     placeholder="Ví dụ: Lake Side Hotel">
                          </div>
                          @if ($errors->has('hotelName'))
                              <span class="text-danger">{{ $errors->first('hotelName') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Địa danh</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="site_id" id="site_id">
                                  @foreach($sites as $site)
                                      <option {{ (old('site_id') == $site->id) ? 'selected' : '' }} value="{{ $site->id }}">{{ $site->siteName }}</option>
                                  @endforeach
                              </select>
                          </div>
                          @if ($errors->has('site_id'))
                              <span class="text-danger">{{ $errors->first('site_id') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Địa chỉ</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="address" value="{{ old('address') }}" id="address"
                          placeholder="Ví dụ: 32 Vương Thừa Vũ ">
                      </div>
                          @if ($errors->has('address'))
                              <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="excerpt" class="col-sm-2 col-form-label">Đánh giá</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="rating" value="{{ old('rating') }}" id="title"
                                     placeholder="Ví dụ: 4">
                          </div>
                          @if ($errors->has('rating'))
                              <span class="text-danger">{{ $errors->first('rating') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                          <div class="col-sm-10">
                              <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="description" class="col-sm-2 col-form-label">Giá/Người</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="pricePerPerson" value="{{ old('pricePerPerson') }}" id="title"
                                     placeholder="Ví dụ: 200000">
                          </div>
                          @if ($errors->has('pricePerPerson'))
                              <span class="text-danger">{{ $errors->first('pricePerPerson') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                          <div class="col-sm-10">
                              <img id="imagePreview" src="" alt="Ảnh được chọn" style="max-width: 100px; max-height: 100px; display: none;">
                              <input type="file" name="imageUrl" class="form-control" id="imageUrl" onchange="previewImage(this)">
                          </div>
                          @if ($errors->has('imageUrl'))
                              <span class="text-danger">{{ $errors->first('imageUrl') }}</span>
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
