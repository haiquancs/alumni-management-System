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
                            <li class="breadcrumb-item"><a href="{{ route('web.surveys.manage-surveys') }}">Quản lý Surveys</a>
                            </li>
                            <li class="breadcrumb-item active">Danh sách bản khảo sát</li>
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
                        <h3 class="card-title">DANH SÁCH BẢN KHẢO SÁT ({{ $listSurveys->toArray()['total'] }})</h3>
                        <div class="card-tools">
                            <a class="btn btn-success btn-sm" style="color: white;" href="{{ route('web.users.export-user') }}">Xuất Excel</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('web.surveys.manage-surveys') }}" method="GET">
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
                                <th style="width: 10%">Thời gian cập nhật</th>
                                <th style="width: 10%">Thông tin bản khảo sát</th>
                                <th style="width: 10%">Thao tác</th>
                            </tr>
                            </thead>
                            <?php $i = ($listSurveys->currentpage() - 1) * $listSurveys->perpage() + 1;?>
                            <tbody>
                            @if($listSurveys->total() == 0)
                                <tr>
                                    <td colspan="9">Không có dữ liệu</td>
                                </tr>
                            @endif
                            @foreach($listSurveys as $survey)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $survey['code'] }}</td>
                                    <td>{{ $survey['full_name'] }}</td>
                                    <td>{{ $survey['jobusers']['updated_at'] }}</td>
                                    <td>Công việc : {{ $survey['jobusers']['name_job'] }}...</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ route('web.surveys.show', $survey['id']) }}">Xem Chi Tiết</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table tạo opes-->
                        <div style="margin-top: 10px; float: right">
                            {{ $listSurveys->links('Web.Share.paginate') }}
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