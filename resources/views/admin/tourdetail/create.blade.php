@extends('admin.layoutadmin.layoutadmin')

@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('tourdetails.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="image" class="col-sm-2 col-form-label">image</label>
                          <div class="col-sm-10">
                              <input type="file" name="imageUrl[]" id="fileInput" class="form-control" multiple>

                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">site</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="tour_id" >
                                  @foreach($tours as $tour)
                                      <option value="{{ $tour->id }}">{{ $tour->tourName }}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">checkInDate</label>
                          <div class="col-sm-10">
                              <input type="date" class="form-control" name="checkInDate" value="{{ old('checkInDate') }}">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">checkOutDate</label>
                          <div class="col-sm-10">
                              <input type="date" class="form-control" name="checkOutDate" value="{{ old('checkOutDate') }}">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">vehicle</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="vehicle" value="{{ old('vehicle') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">maxParticipant</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="maxParticipant" value="{{ old('maxParticipant') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">childrenPrice</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="childrenPrice" value="{{ old('childrenPrice') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">adultPrice</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="adultPrice" value="{{ old('adultPrice') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">discount(%)</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="discount" value="{{ old('discount') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">depatureLocation</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="depatureLocation" value="{{ old('depatureLocation') }}" id="title"
                                     placeholder="example: Lake Side Hotel">
                          </div>
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">tripDescription</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="tripDescription" value="{{ old('tripDescription') }}" id=""/>
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
            .create( document.querySelector( '#tripDescription' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
