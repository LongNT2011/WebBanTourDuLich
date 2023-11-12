@extends('admin.layoutadmin.layoutadmin')


@section('header')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Quản trị viên</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Người dùng</li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Người dùng</h6>
    </nav>
@endsection




@section('content')

  <div class="container-fluid">
      <div class="row">
          <div class="col-lg-12">
              <div class="card p-3">
                  <form method="post" action="{{route('users.store')}}"  id="my-form">
                      @csrf
                      <div class="form-group row border-bottom pb-4">
                          <label for="category_id" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="email">
                      </div>
                          @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="excerpt" class="col-sm-2 col-form-label">Mật khẩu</label>
                          <div class="col-sm-10">
                              <input type="password" class="form-control" name="password" value="{{ old('password') }}" id="title">
                          </div>
                          @if ($errors->has('password'))
                              <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Tên</label>
                          <div class="col-sm-10">
                              <input type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" id="title">
                          </div>
                          @if ($errors->has('fullName'))
                              <span class="text-danger">{{ $errors->first('fullName') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="title" class="col-sm-2 col-form-label">Số điện thoại</label>
                          <div class="col-sm-10">
                              <input type="number" class="form-control" name="phoneNumber" value="{{ old('phoneNumber') }}" id="title">
                          </div>
                          @if ($errors->has('phoneNumber'))
                              <span class="text-danger">{{ $errors->first('phoneNumber') }}</span>
                          @endif
                      </div>
                      <div class="form-group row border-bottom pb-4">
                          <label for="role" class="col-sm-2 col-form-label">Vai trò</label>
                          <div class="col-sm-10">
                              <select class="form-control" name="isAdmin">
                                  <option value="0">Người dùng</option>
                                  <option value="1">Quản trị viên</option>
                              </select>
                          </div>
                      </div>
                      <button type="submit" class="btn btn-success">Lưu</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
