@extends('Web.Layout.home')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.request.index') }}">Quản lý Yêu cầu</a>
                            </li>
                            <li class="breadcrumb-item active">Danh sách yêu cầu</li>
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
                        <h3 class="card-title">DANH SÁCH YÊU CẦU</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_STAFF && \Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_ADMIN)
                                <div class="col-sm-6" style="">
                                    <a href="{{ route('web.request.create') }}">
                                        <button type="submit" class="btn btn-primary">Tạo yêu cầu</button>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- /.col -->
                        <!-- table danh sách rank-->

                        <table class="table table-bordered table-hover" style="margin-top: 20px">
                            <thead style="text-align: center" class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Người gửi</th>
                                <th>Người nhận</th>
                                <th>Trạng thái</th>
                                {{--<th>Trạng thái</th>--}}
                                <th>Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_ADMIN)
                                <?php $i = ($requestStaff->currentpage() - 1) * $requestStaff->perpage() + 1; ?>
                                @if($requestStaff->total() == 0)
                                    <tr>
                                        <td colspan="5">Không có yêu cầu</td>
                                    </tr>
                                @endif
                                @foreach($requestStaff as $value)
                                    <tr class="">
                                        @if($value->status == \App\Models\RequestStaffs::STATUS_NOT_COMPLETED)
                                            <td style="vertical-align: middle;">{{$i++}}</td>
                                        @endif
                                        @if($value->status != \App\Models\RequestStaffs::STATUS_NOT_COMPLETED)
                                            <td style="vertical-align: middle;">{{$i++}}</td>
                                        @endif
                                    <!-- hien thi ten nguoi dung -->
                                        <td style="vertical-align: middle;">{{@$value->sendStaff->code}} - {{@$value->sendStaff->sStaff}}</td>
                                        <td style="vertical-align: middle;">{{@$value->receiveStaff->code}} - {{@$value->receiveStaff->rStaff}}</td>

                                        <!-- het doan hien thi ten -->
                                        <td style="vertical-align: middle;">{{\App\Models\RequestStaffs::$type[$value->type]}}</td>
                                        {{--<td style="vertical-align: middle;">{{\App\Models\RequestStaffs::$status[$value->status]}}</td>--}}
                                        <td style="vertical-align: middle;">
                                            @if($value->status == \App\Models\RequestStaffs::STATUS_NOT_COMPLETED)
                                                @if(empty($value['opes_staff_id']))
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $value['request_staff_id2'])
                                                        <a href="{{ route('web.opes.create') }}"><p
                                                                    style="width: 300px; white-space: pre-wrap;text-align: left;">{{$value->note}}</p>
                                                        </a>
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id != $value['request_staff_id2'])
                                                        <p style="width: 300px; white-space: pre-wrap;text-align: left;">{{$value->note}}</p>
                                                    @endif
                                                @endif
                                                @if(!empty($value['opes_staff_id']))
                                                    <a href="{{ route('web.opes.show', $value['opes_staff_id']) }}"><p
                                                                style="width: 300px; white-space: pre-wrap;text-align: left;">{{$value->note}}</p>
                                                    </a>
                                                @endif
                                            @endif
                                            @if($value->status == \App\Models\RequestStaffs::STATUS_COMPLETED)
                                                <p style="width: 300px; white-space: pre-wrap;text-align: left;">{{$value->note}}</p>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <?php $i = ($allRequest->currentpage() - 1) * $allRequest->perpage() + 1; ?>
                                @if($allRequest->total() == 0)
                                    <tr>
                                        <td colspan="5">Không có yêu cầu</td>
                                    </tr>
                                @endif
                                @foreach($allRequest as $value)
                                    <tr class="">
                                        <td style="vertical-align: middle;">{{$i++}}</td>
                                        <!-- hien thi ten nguoi dung -->

                                        <td>{{@$value->sendStaff->code}} - {{@$value->sendStaff->sendStaff}}</td>
                                        <td>{{@$value->receiveStaff->code}} - {{@$value->receiveStaff->receiveStaff}}</td>

                                        <!-- het doan hien thi ten -->
                                        <td>{{\App\Models\RequestStaffs::$type[$value->type]}}</td>
                                        {{--<td>{{\App\Models\RequestStaffs::$status[$value->status]}}</td>--}}
                                        <td><p style="width: 300px;white-space: pre-wrap;text-align: left">{{$value->note}}</p></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                        <!-- /.table opes đang chờ review-->
                        @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_ADMIN)
                            <div style="margin-top: 10px; float: right">
                                {{ $requestStaff->links('Web.Share.paginate') }}
                            </div>
                        @else
                            <div style="margin-top: 10px; float: right">
                                {{ $allRequest->links('Web.Share.paginate') }}
                            </div>
                        @endif
                    </div>
                    <!--/. card-body-->
                </div>
                <!-- /.card card-default -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!--/. content-->
    </div>
    <!-- /.content-wrapper -->
    <script>
        function confirmDelete() {
            var result = confirm('Bạn có chắc muốn xóa yêu cầu này?');
            if (result) {
                return true;
            } else {
                return false;
            }
        }
    </script>
    <style>
        tbody > tr > td > p {
            margin-bottom: 0;
        }
        tbody > tr > td > a > p {
            margin-bottom: 0;
        }
    </style>

@endsection