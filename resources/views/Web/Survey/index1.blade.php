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
                            <li class="breadcrumb-item"><a href="{{ route('web.opes.manage-opes') }}">OPES</a></li>
                            <li class="breadcrumb-item active">Danh sách OPES</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        {{-- Danh sách opes của mem với gm || gm với bom --}}
        @if(isset($mySuborOpesStaffs))
            @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_GM || \Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_BOM)
                <section class="content">
                    <div class="container-fluid">
                        <div class="card card-default">
                            <div class="card-header">
                                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_GM)
                                    <h3 class="card-title">DANH SÁCH OPES CỦA MEM</h3>
                                    <div class="card-tools">
                                        <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.opes.export-manage-opes-staff') }}">Xuất Excel</a>
                                    </div>
                                @endif
                                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_BOM)
                                    <h3 class="card-title">DANH SÁCH OPES CỦA GM</h3>
                                        <div class="card-tools">
                                            <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.opes.export-manage-opes-staff') }}">Xuất Excel</a>
                                        </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('web.opes.manage-opes') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" id="year" name="year"
                                                        style="width: 100%;">
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
                                                <select class="form-control" id="semester" name="semester"
                                                        style="width: 100%;">
                                                    <option value="" selected>Kỳ</option>
                                                    @foreach(\App\Models\Staff::$semester as $key => $semester)
                                                        <option value="{{ $key }}"
                                                                @if($semester==@$dataSearch['semester']) selected="selected"@endif>{{ $semester }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select class="form-control" id="status" name="status"
                                                        style="width: 100%;">
                                                    <option value="" selected>Trạng thái</option>
                                                    @foreach(\App\Models\OpesStaff::$status as $key => $status)
                                                        <option value="{{ $key }}"
                                                                @if($key==@$dataSearch['status']) selected="selected"@endif>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                                            <th style="width: 8%">Mã NV</th>
                                            <th>Tên nhân viên</th>
                                            <th style="width: 8%">STT OPES</th>
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
                                        @foreach($mySuborOpesStaffs as $value)
                                            @if($value['opes_staff'] != NULL)
                                                <?php
                                                $countNull++;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if($countNull == 0)
                                            <tr>
                                                <td colspan="8">Không có dữ liệu</td>
                                            </tr>
                                        @endif
                                        @foreach($mySuborOpesStaffs as $myStaffs)
                                            @foreach($myStaffs['opes_staff'] as $k => $value)
                                                <tr>
                                                    @if($k == 0)
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{count($myStaffs['opes_staff'])}}">{{$i++}}</td>
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{count($myStaffs['opes_staff'])}}">{{$myStaffs['code']}}</td>
                                                        <td style="vertical-align: middle;"
                                                            rowspan="{{count($myStaffs['opes_staff'])}}">{{$myStaffs['full_name']}}</td>
                                                    @endif
                                                    <td>{{ $k+1 }}</td>
                                                    <td>{{ $value['year'] }}</td>
                                                    <td>{{ $value['semester'] }}</td>
                                                    <td>{{ \App\Models\OpesStaff::$status[$value['status']] }}</td>
                                                    <td style="text-align: center">
                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ route('web.opes.show', $value['id']) }}">Xem</a>
                                                        {{--<a class="btn btn-success btn-sm"--}}
                                                           {{--href="{{ route('web.opes.export-opes', $value['id']) }}">Xuất Excel</a>   --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.table tạo opes-->
                                    {{--<div style="margin-top: 10px; float: right">--}}
                                    {{--{{ $mySuborOpesStaffs->links('Web.Share.paginate') }}--}}
                                    {{--</div>--}}
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