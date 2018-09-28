@extends('Web.Layout.home')

@section('content')
    <!-- Content Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        {{-- Danh sách opes của người đăng nhập --}}
        <!--/. content-->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">BẢN KHẢO SÁT</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <div class="box-body">
                            @if(empty($users['job_id']))
                            <div class="box-footer" style="text-align: center;">
                                <a class="btn btn-info" href="{{ route('web.surveys.create') }}" style="width: 500px; height: 70px; font-size: 40px ">BẮT ĐẦU KHẢO SÁT</a>
                            </div>
                            @else
                            <table class="table table-user-information" style="width: 40%">
                                <tbody>
                                <tr>
                                    <td>Tên sinh viên:</td>
                                    <td>{{Auth::user()->full_name}}</td>
                                </tr>
                                <tr>
                                    <td>Mã sinh viên:</td>
                                    <td>{{Auth::user()->code}}</td>
                                </tr>
                                <tr>
                                    <td>Giới tính:</td>
                                    <td>{{Auth::user()->sex}}</td>
                                </tr>
                                <tr>
                                    <td>Phone:</td>
                                    <td>{{Auth::user()->phone}}</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{Auth::user()->email}}</td>
                                </tr>
                                <tr>
                                    <td>Năm tốt nghiệp:</td>
                                    <td>{{Auth::user()->graduation_year}}</td>
                                </tr>
                                <tr>
                                    <td>Chuyên ngành tốt nghiệp:</td>
                                    <td>{{Auth::user()->graduation_business}}</td>
                                </tr>
                                <tr>
                                    <td>Ngày tạo:</td>
                                    <td>{{Auth::user()->last_access_at}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="box-footer">
                                <a class="btn btn-info" href="#">Cập nhật</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--/. card-body-->
                </div>
                <!-- /.card card-default -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection