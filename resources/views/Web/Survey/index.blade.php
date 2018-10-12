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
                        <h3 class="card-title">BẢN KHẢO SÁT CỦA BẠN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- form start -->
                        <div class="box-body">
                            @if($user['job_id']==NULL||$user['job_id']==0)
                            <div class="box-footer" style="text-align: center;">
                                <a class="btn btn-info" href="{{ route('web.surveys.create') }}" style="width: 500px; height: 70px; font-size: 40px ">BẮT ĐẦU KHẢO SÁT</a>
                            </div>
                            @else
                            <table class="table table-user-information" style="width: 40%">
                                <tbody>
                                <tr>
                                    <td><h2>Thông tin cá nhân</h2></td>
                                    <td></td>
                                </tr>    
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
                                @if(!empty($jobInfoUsers))
                                <tr>
                                    <td><h2>Thông tin công việc</h2></td>
                                    <td></td>
                                </tr>
                                @if($jobInfoUsers['job']==\App\Models\JobUser::UN_JOB)
                                    <td><h3 style="color: red">Hiện tại bạn chưa có công việc</h3></td>
                                    <td></td>
                                @else
                                <tr>
                                    <td>Tên công việc:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Thời gian có việc sau khi tốt nghiệp:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Giới tính:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Được giới thiệu từ:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Loại hình cơ quan đang làm việc:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Vị trí công việc:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Mức lương:</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Khóa đào tạo tham gia:</td>
                                    <td></td>
                                </tr>
                                @endif
                                @endif
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