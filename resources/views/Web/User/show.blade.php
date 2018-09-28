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
                            <li class="breadcrumb-item"><a href="{{ route('web.staffs.index') }}">Quản lý tài khoản</a>
                            </li>
                            <li class="breadcrumb-item active">Thông tin tài khoản</li>
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
                        <h3 class="card-title">THÔNG TIN TÀI KHOẢN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-user-information" style="width: 40%">
                            <tbody>
                            <tr>
                                <td>Tên tài khoản:</td>
                                <td>{{$staff['full_name']}}</td>
                            </tr>
                            <tr>
                                <td>Mã nhân viên:</td>
                                <td>{{ $staff['code'] }}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{ $staff['email'] }}</td>
                            </tr>
                            <tr>
                                <td>Chức vụ:</td>
                                <td>{{ \App\Models\Staff::$role[$staff['role']] }}</td>
                            </tr>
                            @if($staff['role'] == \App\Models\Staff::ROLE_STAFF || $staff['role'] == \App\Models\Staff::ROLE_GM)
                                <tr>
                                    <td>Phòng ban:</td>
                                    <td>{{ $staff['department']['name'] }}</td>
                                </tr>
                                <tr>
                                    <td>Rank:</td>
                                    <td>{{ $staff['rank']['rank'] }}</td>
                                </tr>
                                <tr>
                                    <td>Grade:</td>
                                    <td>{{ $staff['grade']['grade'] }}</td>
                                </tr>
                                <tr>
                                    <td>Người quản lý:</td>
                                    <td>{{ $getName[0]['full_name'] }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Ngày tạo:</td>
                                <td>{{ $staff['last_access_at'] }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="col-sm-3" style="margin-top: 30px">
                            <a href="{{route('web.staffs.index')}}" class="btn btn-default">Trở lại</a>
                            <a href="{{ route('web.staffs.edit', $staff->id) }}" class="btn btn-primary">Sửa</a>
                        </div>

                    </div>
                    <!--/. card-body-->
                </div>
                <!-- /.card card-default -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!--/. content-->
    </div>
    <!-- /.content -->

@endsection