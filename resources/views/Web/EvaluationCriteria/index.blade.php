@extends('Web.Layout.home')

@section('content')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.evaluation-criterias.index') }}">Quản lý Tiêu Chí</a></li>
                            <li class="breadcrumb-item active">Danh sách tiêu chí</li>
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
                        <h3 class="card-title">DANH SÁCH TIÊU CHÍ</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            @if(count($ranks)>0)
                                <div class="col-md-2">
                                    <a href="{{ route('web.evaluation-criterias.create') }}">
                                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <!-- /.col -->

                        <div class="card-header">
                        </div>
                        <div class="row box-footer" style="margin-left: 0px">
                        </div>
                        <!-- table danh sách rank-->
                        <table  class="table table-bordered table-hover" style="margin-top: 20px; width: 100%">
                            <thead style="text-align: center" class="thead-light">
                            <tr >
                                <th style="width: 7%">Hạng</th>
                                <th style="width: 7%">STT</th>
                                <th style="width: 30%">Tiêu chí</th>
                                <th style="width: 30%">Chi tiết</th>
                                <th style="width: 4%">Trọng số</th>
                                <th style="width: 4%">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listEvalFollowRank as $key => $value)
                                @foreach($value->evaluationCriteria as $k => $eval)
                                    <tr>
                                        @if($k == 0)<td style="vertical-align: middle;" rowspan="{{count($value->evaluationCriteria)}}">{{$value->rank}}</td>@endif

                                        <td style="vertical-align: middle;">{{ $k+1 }}</td>
                                        <td style="vertical-align: middle;">{{ $eval->name }}</td>
                                        <td style="vertical-align: middle;"><p style="width: 450px; white-space: pre-wrap;">{{ $eval->comment }}</p></td>
                                        <td style="vertical-align: middle;">{{ $eval->total_percents }}%</td>

                                        @if($k == 0)<td style="vertical-align: middle;" rowspan="{{count($value->evaluationCriteria)}}">
                                            <div style="float: right;">
                                                <form method="POST" action="{{ route('web.evaluation-criterias.destroy',[$value->id]) }}" onsubmit="return confirmDelete()" >
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input class="btn btn-danger btn-sm" type="submit" value="Xóa" name="">
                                                </form>
                                            </div>
                                        </td>@endif
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table opes đang chờ review-->
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
            var result = confirm('Bạn có chắc muốn xóa tiêu chí này?');
            if (result) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection
