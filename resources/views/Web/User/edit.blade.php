@extends('Web.Layout.home')

@section('content')
    <!-- Content Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.users.index') }}">Quản lý tài khoản</a>
                            </li>
                            <li class="breadcrumb-item active">Sửa thông tin tài khoản</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">SỬA THÔNG TIN TÀI KHOẢN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(!empty($errors->toArray()))
                            <div id="form-messages" class="alert alert-danger col-sm-8" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <!-- form start -->
                        <form action="{{ route('web.users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Họ :</label>
                                    <input class="form-control col-6" type="text" name="first_name" value="{{ $user->first_name }}">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Tên :</label>
                                    <input class="form-control col-6" type="text" name="last_name" value="{{ $user->last_name }}">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Giới tính :</label>
                                    <select class="form-control col-6" name="sex">
                                        @if($user->sex != NULL)
                                            <option value="{{ $user->sex }}" selected>{{\App\Models\User::$sex[$user->sex]}}(Đã chọn)</option>
                                        @else
                                            <option value="" selected>(Chưa cập nhật)</option>
                                        @endif
                                        @foreach(\App\Models\User::$sex as $key => $sex)
                                            <option value="{{ $key }}">{{ \App\Models\User::$sex[$key] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Phone</label>
                                    <input class="form-control col-6" type="text" name="phone" value="{{ $user->phone }}">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Email</label>
                                    <input class="form-control col-6" type="text" placeholder="example@gmail.com" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Thời gian tốt nghiệp</label>
                                    <select class="form-control col-6" name="graduation_year">
                                        @if($user->graduation_year != NULL)
                                        <option value="{{ $user->graduation_year }}" selected>{{$user->graduation_year}}(Đã chọn)</option>
                                        @else
                                        <option value="" selected>(Chưa cập nhật)</option>
                                        @endif
                                        @for($year = 2018; $year >= 2000; $year--)
                                            <option value="{{ $year }}">{{$year}}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Chuyên ngành tốt nghiệp</label>
                                    <select class="form-control col-6" name="graduation_business">
                                        @if($user->graduation_business != NULL)
                                        <option value="{{ $user->graduation_business }}" selected>{{$user->business['business']}}(Đã chọn)</option>
                                        @else
                                        <option value="" selected>(Chưa cập nhật)</option>
                                        @endif
                                        @foreach($business as $key => $value)
                                            <option value="{{ $key+1 }}">{{$value['business']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-2 col-form-label">Ảnh</label>
                                    <input type="file" name="filesTest">
                                </div>
                                <div class="box-footer">
                                    <a class="btn btn-default" href="{{ route('web.surveys.index') }}">Trở lại</a>
                                    <button type="submit" class="btn btn-info">Sửa</button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                    <!--/. card-body-->
                </div>
                <!-- /.card card-default -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!--/. section-content-->
    </div>
    <!-- /.content -->

    <style type="text/css">
        .required {
            color: red;
        }
    </style>
@endsection