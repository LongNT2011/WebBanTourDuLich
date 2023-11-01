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
                                <input type="text" class="form-control" name="hotelName" value="{{ old('hotelName',$hotel->hotelName) }}" id="title"
                                       placeholder="example: Lake Side Hotel">
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">Địa chỉ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address" value="{{ old('address',$hotel->address) }}" id="address"
                                       placeholder="example: Lake Side Hotel">
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="excerpt" class="col-sm-2 col-form-label">Đánh giá</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="rating" id="excerpt" cols="30" rows="5">{{ old('rating',$hotel->rating) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="description" id="description" cols="30" rows="7">{{ old('description',$hotel->description) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="description" class="col-sm-2 col-form-label">Giá/Người</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pricePerPerson" id="description" value="{{ old('pricePerPerson',$hotel->pricePerPerson) }}"></input>
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="image" class="col-sm-2 col-form-label">Ảnh</label>
                            <div class="col-sm-10">
                                <input type="file" name="imageUrl" class="form-control" id="imageUrl">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
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
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
