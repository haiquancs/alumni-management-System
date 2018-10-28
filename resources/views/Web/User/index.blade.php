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
                            <li class="breadcrumb-item active">Danh sách tài khoản</li>
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
                        <h3 class="card-title">DANH SÁCH TÀI KHOẢN</h3>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.users.export-user') }}">Xuất Excel</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('web.users.index') }}" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="code" id="code"
                                               value="{{@$dataSearch['code']}}"
                                               placeholder="Mã sinh viên"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input class="form-control" name="full_name" id="full_name"
                                               value="{{@$dataSearch['full_name']}}"
                                               placeholder="Tên sinh viên"/>
                                    </div>
                                </div>
                                <div class="col-md-1.5">
                                    <div class="form-group">
                                        <select class="form-control" name="graduation_year" id="graduation_year">
                                            <option value="" selected>Thời gian tốt nghiệp</option>
                                            @for($year = 2018; $year >= 2000 ; $year --)
                                                <option value="{{ $year }}" >{{ $year }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="form-control" name="graduation_business" id="graduation_business" style="width: 95%;">
                                            <option value="" selected>Chuyên ngành</option>
                                            @foreach($business as $business)
                                                <option value="{{ $business->id }}" >{{ $business->business }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                            <!-- /.col -->
                        </form>
                        <!-- table yêu cầu tạo opes-->
                        <table class="table table-bordered table-hover" style="text-align: center">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 5%">STT</th>
                                <th style="width: 8%">Mã sinh viên</th>
                                <th style="width: 10%">Tên sinh viên</th>
                                <th style="width: 8%">Giới Tính</th>
                                <th>Phone</th>
                                <th style="width: 17%">Email</th>
                                <th style="width: 12%">Thời gian tốt nghiệp</th>
                                <th>Tốt nghiệp chuyên ngành</th>
                                <th>Trạng thái khảo sát</th>
                                <th style="width: 10%">Thao tác</th>
                            </tr>
                            </thead>
                            <?php $i = ($users->currentpage() - 1) * $users->perpage() + 1;?>
                            <tbody>
                            @if($users->total() == 0)
                                <tr>
                                    <td colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endif
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $user['code'] }}</td>
                                    <td>{{ $user['full_name'] }}</td>
                                    <td>
                                        @if($user['sex'] != NULL)
                                        {{\App\Models\User::$sex[$user['sex']]}}
                                        @endif
                                    </td>
                                    <td>{{ $user['phone'] }}</td>
                                    <td>{{ $user['email'] }}</td>
                                    <td>{{ $user['graduation_year'] }}</td>
                                    <td>
                                        @if($user['graduation_business'] != NULL)
                                        {{ $user['business']['business'] }}
                                        @endif
                                    </td>
                                    @if(@$user['job_id'])<td style="background-color: green"> Đã làm khảo sát </td>@else<td style="background-color: red"> Chưa làm khảo sát </td>@endif
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ route('web.users.show', $user['id']) }}">Xem</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table tạo opes-->
                        <div style="margin-top: 10px; float: right">
                            {{ $users->links('Web.Share.paginate') }}
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