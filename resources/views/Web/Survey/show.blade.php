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
                            @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_STAFF ||
                                \Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_GM ||
                                \Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_BOM)
                                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_BOM)
                                    <li class="breadcrumb-item"><a href="{{ route('web.opes.manage-opes') }}">OPES</a></li>
                                @else
                                    <li class="breadcrumb-item"><a href="{{ route('web.opes.index') }}">OPES</a></li>
                                @endif
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
                                <li class="breadcrumb-item"><a href="{{ route('web.opes.opes-staff') }}">OPES</a></li>
                            @endif
                            <li class="breadcrumb-item active">Xem</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- NỘI DUNG CHỈNH SỬA TRÊN GM003-->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Chi tiết OPES</h3>
                            <div class="card-tools">
                                <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.opes.export-opes', $id) }}">Xuất Excel</a>
                            </div>                          
                        </div>
                        <!-- /.card-header -->

                        <!-- NỘI DUNG CHỈNH SỬA CHI TIẾT GM003-->
                        {{--{{ dd(json_encode( $opesStaff)) }}--}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Tên nhân viên:</td>
                                            <td>{{ $opesStaffs['staff']['full_name'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mã OPES:</td>
                                            <td>{{ $opesStaffs['id'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Năm:</td>
                                            <td>{{ $opesStaffs['year'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>Kỳ:</td>
                                            <td>{{ $opesStaffs['semester'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff']['id'])
                                @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_APPROVAL)
                                    <div class="form-group" style="float: right">
                                        <a href="#" class="btn btn-primary">Yêu cầu update OPES</a>
                                    </div>
                                @endif
                            @endif
                            <form action="{{ route('web.opes.update', [$opesStaffs->id]) }}" method="POST"
                                  class="form-horizontal">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="table-responsive" style="margin-bottom: 30px; ">
                                    <table class="table table-bordered" style="width: 2500px">
                                        <thead class="thead-light" style="text-align: center;">
                                        <th style="vertical-align: middle; width: 200px">Tiêu chí</th>
                                        <th>
                                            <table style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th colspan="3">Mục tiêu cá nhân</th>
                                                    <th colspan="6">Kết quả</th>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
                                                        @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                            <th colspan="2">Ghi chú</th>
                                                        @endif
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
                                                        @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW || $opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                            <th colspan="2">Ghi chú</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th style="width: 300px">Nội dung cụ thể</th>
                                                    <th style="width: 300px">Mục tiêu</th>
                                                    <th style="width: 100px">Trọng số</th>
                                                    <th style="width: 200px">S</th>
                                                    <th style="width: 200px">A</th>
                                                    <th style="width: 200px">B</th>
                                                    <th style="width: 200px">C</th>
                                                    <th style="width: 200px">D</th>
                                                    <th style="width: 100px">Điểm</th>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
                                                        @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                            <th style="width: 250px">Phản hồi từ người gửi</th>
                                                            <th style="width: 250px">Phản hồi từ người nhận</th>
                                                        @endif
                                                    @endif
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
                                                        @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW || $opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                            <th style="width: 250px">Phản hồi từ người gửi</th>
                                                            <th style="width: 250px">Phản hồi từ người nhận</th>
                                                        @endif
                                                    @endif
                                                </tr>
                                                </thead>
                                            </table>
                                        </th>
                                        </thead>
                                        <tbody>
                                        @foreach($opesDetails as $key => $evalua)
                                            <tr>
                                                <td style="vertical-align: middle; width: 200px">{{ $evalua['eval'] }}</td>
                                                <td>
                                                    <table style="width: 100%">
                                                        @foreach($evalua['items'] as $k => $opesDetail)
                                                            <tr>
                                                                <td style="white-space: pre-wrap; width: 300px">{{ $opesDetail['title'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 300px">{{ $opesDetail['content'] }}</td>
                                                                <td style="width: 100px">{{ $opesDetail['percents'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 200px">{{ $opesDetail['s'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 200px">{{ $opesDetail['a'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 200px">{{ $opesDetail['b'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 200px">{{ $opesDetail['c'] }}</td>
                                                                <td style="white-space: pre-wrap; width: 200px">{{ $opesDetail['d'] }}</td>
                                                                <td style="width: 100px">{{ \App\Models\OpesDetail::$mark[$opesDetail['mark']] }}</td>
                                                                @if(\Illuminate\Support\Facades\Auth::user()->id == $opesStaffs['staff_id'])
                                                                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                                        <td style="white-space: pre-wrap; width: 250px">{{ $opesDetail['note_for_reviewer'] }}</td>
                                                                        <td style="white-space: pre-wrap; width: 250px">{{ $opesDetail['note_for_creater'] }}</td>
                                                                    @endif
                                                                @endif
                                                                @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
                                                                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW)
                                                                        <td style="white-space: pre-wrap; width: 250px">{{ $opesDetail['note_for_reviewer'] }}</td>
                                                                        <td style="white-space: pre-wrap; width: 250px"><textarea
                                                                                    name="opes[{{ $key }}][{{$k}}][note_for_creater]"
                                                                                    cols="10" rows="3"
                                                                                    class="form-control">{{ $opesDetail['note_for_creater'] }}</textarea></td>
                                                                    @endif
                                                                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_UPDATE_REVIEW_COMMENT)
                                                                        <td style="white-space: pre-wrap; width: 250px">{{ $opesDetail['note_for_reviewer'] }}</td>
                                                                        <td style="white-space: pre-wrap; width: 250px">{{ $opesDetail['note_for_creater'] }}</td>
                                                                    @endif
                                                                @endif
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if(\Illuminate\Support\Facades\Auth::user()->id != $opesStaffs['staff_id'])
                                    @if($opesStaffs['status'] == \App\Models\OpesStaff::STATUS_SEND_TO_REVIEW)
                                        @if(\Illuminate\Support\Facades\Auth::user()->role - 1 == $opesStaffs['staff']['role'])
                                            <div class="row" style="padding-top: 30px; ">
                                                <div class="col-md-1" style="padding-left: 2%">
                                                    <button type="submit" name="action" value="save"
                                                            class="btn btn-warning">Lưu
                                                    </button>
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="submit" name="action" value="ask"
                                                            class="btn btn-warning">Gửi yêu cầu Update
                                                    </button>
                                                </div>
                                                <div class="col-md-1.5">
                                                    <a href="{{ route('web.opes.approval', [$opesStaffs->id,$opesStaffs->staff_id]) }}"
                                                       class="btn btn-success">Chấp nhận</a>
                                                </div>
                                                <div class="col-md-1" style="padding-left: 3%">
                                                    <a href="{{ route('web.opes.rejected', [$opesStaffs->id,$opesStaffs->staff_id]) }}"
                                                       class="btn btn-danger">Từ Chối</a>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </form>
                            <!--  .row -->
                        </div>
                        <!-- .card-body -->
                        <!-- KẾT THÚC NỘI DUNG CHỈNH SỬA GM003-->
                    </div>
                    <!-- /.col -->
                </div>
                <!--- KẾT THÚC NỘI DUNG CHỈNH SỬA CHUNG--->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection