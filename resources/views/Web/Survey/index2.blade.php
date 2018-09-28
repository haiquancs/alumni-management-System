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
                            <li class="breadcrumb-item"><a href="{{ route('web.opes.opes-staff') }}">OPES</a></li>
                            <li class="breadcrumb-item active">Danh sách OPES</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        {{-- Danh sách opes của toàn bộ nhân viên --}}
        @if(isset($opesStaff))
            @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_BOM || \Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">OPES CỦA NHÂN VIÊN</h3>
                                <div class="card-tools">
                                    <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.opes.export-all-opes-staff') }}">Xuất Excel</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('web.opes.opes-staff') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-1.5">
                                            <div class="form-group">
                                                <input class="form-control" name="code" id="code"
                                                       value="{{@$dataSearch['code']}}"
                                                       placeholder="Mã nhân viên"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input class="form-control" name="full_name" id="full_name"
                                                       value="{{@$dataSearch['full_name']}}"
                                                       placeholder="Tên nhân viên"/>
                                            </div>
                                        </div>
                                        <div class="col-md-1.5">
                                            <div class="form-group">
                                                <select class="form-control" name="name" id="name">
                                                    <option value="" selected>Phòng ban</option>
                                                    @foreach($departments as $key => $department)
                                                        <option value="{{ $department }}"
                                                                @if($department==@$dataSearch['name']) selected="selected"@endif>{{ $department }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="role" id="role" style="width: 95%;">
                                                    <option value="" selected>Chức vụ</option>
                                                    @foreach(\App\Models\Staff::$role as $key => $role)
                                                        <option value="{{ $key }}"
                                                                @if($key==@$dataSearch['role']) selected="selected"@endif>{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1.5">
                                            <div class="form-group">
                                                <select class="form-control" name="year" style="width: 100%;">
                                                    <option value="" selected>Năm</option>
                                                    @foreach($years as $key=>$value)
                                                        <option value="{{ $value }}"
                                                                @if($value==@$dataSearch['year']) selected="selected"@endif>{{ $value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <select class="form-control select2" name="semester"
                                                        style="width: 100%;">
                                                    <option value="" selected>Kỳ</option>
                                                    @foreach(\App\Models\Staff::$semester as $key => $semester)
                                                        <option value="{{ $key }}"
                                                                @if($semester==@$dataSearch['semester']) selected="selected"@endif>{{ $semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control select2" name="status" style="width: 100%;">
                                                    <option value="" selected>Trạng thái</option>
                                                    @foreach(\App\Models\OpesStaff::$status as $key => $status)
                                                        <option value="{{ $key }}"
                                                                @if($key==@$dataSearch['status']) selected="selected"@endif>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1.5">
                                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- table yêu cầu tạo opes-->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover" style="text-align: center">
                                        <thead class="thead-light">
                                        <tr>
                                            <th style="width: 6%">STT</th>
                                            <th style="width: 10%">Phòng ban</th>
                                            <th style="width: 10%">Chức vụ</th>
                                            <th>Mã nhân viên</th>
                                            <th>Tên nhân viên</th>
                                            <th>Năm</th>
                                            <th>Kỳ</th>
                                            <th>Trạng thái</th>
                                            <th style="width: 10%">Thao tác</th>
                                        </tr>
                                        </thead>
                                        <?php
                                        $i = 1;
                                        $countNull = 0;
                                        ?>
                                        <tbody>
                                        @foreach($opesStaff as $value)
                                            @foreach($value['staff'] as $value1)
                                                @if($value1['opes_staff'] != NULL)
                                                    <?php
                                                    $countNull++;
                                                    ?>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @if($countNull == 0)
                                            <tr>
                                                <td colspan="9">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                        @foreach($opesStaff as $value)
                                            @foreach($value['staff'] as $value1)
                                                @foreach($value1['opes_staff'] as $k => $value2)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $value['name'] }}</td>
                                                        <td>{{ \App\Models\Staff::$role[$value1['role']] }}</td>
                                                        <td>{{ $value1['code'] }}</td>
                                                        <td>{{ $value1['full_name'] }}</td>
                                                        <td>{{ $value2['year'] }}</td>
                                                        <td>{{ $value2['semester'] }}</td>
                                                        <td>{{ \App\Models\OpesStaff::$status[$value2['status']] }}</td>
                                                        <td style="text-align: center">
                                                            <a class="btn btn-sm btn-info"
                                                               href="{{ route('web.opes.show', $value2['id']) }}">Xem</a>
                                                            {{--<a class="btn btn-success btn-sm" href="{{ route('web.opes.export-opes', $value2['id']) }}">Xuất Excel</a>                                                               --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.table tạo opes-->
                                </div>
                            </div>
                            <!--/. card-body-->
                        </div>
                        <!-- /.card card-default -->
                    </div>
                    <!-- /.container-fluid -->
                </section>
        @endif
    @endif
    <!-- /.content -->
    </div>
@endsection        