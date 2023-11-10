@extends('admin.layoutadmin.layoutadmin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{route('hotels.update',[$hotel])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Tên khách sạn</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="hotelName" value="{{ old('hotelName',$hotel->hotelName) }}" id="title">
                            </div>
                            @if ($errors->has('hotelName'))
                                <span class="text-danger">{{ $errors->first('hotelName') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">Vị trí</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="site_id" id="location_id">
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}" {{ ($hotel->site_id == $site->id) ? 'selected' : '' }}>
                                            {{ $site->siteName }}
                                        </option>
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
                                <input type="text" class="form-control" name="address" value="{{ old('address',$hotel->address) }}" id="address">
                            </div>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="excerpt" class="col-sm-2 col-form-label">Đánh giá</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="rating" value="{{ old('rating',$hotel->rating) }}" id="title">
                            </div>
                            @if ($errors->has('rating'))
                                <span class="text-danger">{{ $errors->first('rating') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{ old('description',$hotel->description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="description" class="col-sm-2 col-form-label">Giá/Người</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="pricePerPerson"  value="{{ old('pricePerPerson',$hotel->pricePerPerson) }}"></input>
                            </div>
                            @if ($errors->has('pricePerPerson'))
                                <span class="text-danger">{{ $errors->first('pricePerPerson') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <img id="imagePreview" src="{{ Storage::url($hotel->imageUrl) }}" alt="Ảnh hiện tại" style="max-width: 100px; max-height: 100px;">
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
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

