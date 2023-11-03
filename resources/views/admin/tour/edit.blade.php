@extends('admin.layoutadmin.layoutadmin')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-3">
                    <form method="post" action="{{route('tours.update',[$tour])}}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group row border-bottom pb-4">
                            <label for="title" class="col-sm-2 col-form-label">tourName</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tourName" value="{{ old('tourName',$tour->tourName) }}" id="title"
                                       placeholder="example: Lake Side Hotel">
                            </div>
                        </div>
                        <div class="form-group row border-bottom pb-4">
                            <label for="category_id" class="col-sm-2 col-form-label">site</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sites[]" multiple>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->siteName }}</option>
                                    @endforeach
                                </select>
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

