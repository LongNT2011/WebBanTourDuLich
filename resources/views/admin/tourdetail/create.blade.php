@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Chi tiết Tour</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Chi tiết Tour</h6>
    </nav>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{route('tourdetails.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row border-bottom pb-4">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <div id="imagePreviewContainer" class="mt-2"></div>
                                <input type="file" name="imageUrl[]" id="fileInput" class="form-control" multiple
                                       onchange="previewImages(this)">
                            </div>
                            @if ($errors->has('imageUrl'))
                                <span class="text-danger">{{ $errors->first('imageUrl') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">Tour</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="tour_id">
                                    @foreach($tours as $tour)
                                        <option value="{{ $tour->id }}">{{ $tour->tourName }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('tour_id'))
                                    <span class="text-danger">{{ $errors->first('tour_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Ngày bắt đầu</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="checkInDate"
                                       value="{{ old('checkInDate') }}">
                            </div>
                            @if ($errors->has('checkInDate'))
                                <span class="text-danger">{{ $errors->first('checkInDate') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Ngày kết thúc</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="checkOutDate"
                                       value="{{ old('checkOutDate') }}">
                            </div>
                            @if ($errors->has('checkOutDate'))
                                <span class="text-danger">{{ $errors->first('checkOutDate') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Phương tiện di chuyển</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="vehicle" value="{{ old('vehicle') }}"
                                       id="title">
                            </div>
                            @if ($errors->has('vehicle'))
                                <span class="text-danger">{{ $errors->first('vehicle') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Số người tối đa</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="maxParticipant"
                                       value="{{ old('maxParticipant') }}" id="title">
                            </div>
                            @if ($errors->has('maxParticipant'))
                                <span class="text-danger">{{ $errors->first('maxParticipant') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Giá trẻ em</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="childrenPrice"
                                       value="{{ old('childrenPrice') }}" id="title">
                            </div>
                            @if ($errors->has('childrenPrice'))
                                <span class="text-danger">{{ $errors->first('childrenPrice') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Giá người lớn</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="adultPrice"
                                       value="{{ old('adultPrice') }}" id="title">
                            </div>
                            @if ($errors->has('adultPrice'))
                                <span class="text-danger">{{ $errors->first('adultPrice') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Giảm giá(%)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="discount" value="{{ old('discount') }}"
                                       id="title">
                            </div>
                            @if ($errors->has('discount'))
                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Địa điểm xuất phát</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="depatureLocation"
                                       value="{{ old('depatureLocation') }}" id="title">
                            </div>
                            @if ($errors->has('depatureLocation'))
                                <span class="text-danger">{{ $errors->first('depatureLocation') }}</span>
                            @endif
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Chương trình tour</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="tripDescription"
                                          id="description">{{ old('tripDescription') }}</textarea>
                            </div>
                            @if ($errors->has('tripDescription'))
                                <span class="text-danger">{{ $errors->first('tripDescription') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 200px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function previewImages(input) {
            var previewContainer = document.getElementById('imagePreviewContainer');
            previewContainer.innerHTML = ''; // Xóa các xem trước trước đó

            if (input.files && input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100px';
                        img.style.maxHeight = '100px';
                        img.style.marginRight = '10px';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
    </script>
@endsection
