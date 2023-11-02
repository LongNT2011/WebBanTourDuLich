@extends('admin.layoutadmin.layoutadmin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{route('locations.update',[$location])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">Tên khách sạn</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="locationName" value="{{ old('locationName',$location->locationName) }}" id="title"
                                       placeholder="example: Lake Side Hotel">
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
