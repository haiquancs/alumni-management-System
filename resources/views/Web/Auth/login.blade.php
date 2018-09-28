@extends('Web.Layout.login')

@section('content')
    <div class="login-box" style="width: 500px">
        <div class="login-logo">
            <img src="{{asset('favicon.ico')}}" alt="User Avatar">
        </div>
        <div class="login-logo" style="width: 100%; margin-bottom: 0">
            <a style="color: blue"><b>ĐẠI HỌC CÔNG NGHỆ - ĐHQGHN</b></a>
        </div>
        <div class="login-logo" style="width: 100%; font-size: 30px">
            <a><b>Hệ Thống Quản Lý Cựu Sinh Viên</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card" style="width: 360px; margin: auto;">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Thông tin đăng nhập</p>
                <form action="{{route('web.auth.login')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input type="text" name="code" required autocomplete="off" autofocus class="form-control"
                               placeholder="Mã sinh viên" value="{{ old('code') }}">
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" required autocomplete="off" class="form-control"
                               placeholder="Mật khẩu" value="">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox" name="remember" value="1"> Nhớ mật khẩu
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                @if ($errors->any())
                    <hr/>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{--<p class="mb-1">--}}
                    {{--<a href="#">I forgot my password</a>--}}
                {{--</p>--}}
                {{--<p class="mb-0">--}}
                    {{--<a href="register.html" class="text-center">Register a new membership</a>--}}
                {{--</p>--}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection