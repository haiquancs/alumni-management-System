@extends('Web.Layout.home')

@section('content')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
                            <li class="breadcrumb-item active">Thêm yêu cầu</li>
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
                        <h3 class="card-title">TẠO MỚI YÊU CẦU</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form action="{{ route('web.request.store') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <table class="order-lischỉnh st" id="abc">
                                            <tr>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="width: 300px">
                                                                <!-- chia role mem -->
                                                                <label for="selectt">Loại yêu cầu<span class="required">*</span> </label>
                                                                <select class="form-control select2" id="selectt"
                                                                        name="request_type">
                                                                    @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_STAFF)
                                                                        <option value="1">{{ $type['1'] }}</option>
                                                                    @endif

                                                                </select>
                                                                <!-- end chia role mem -->
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group" style="width: 300px">

                                                                <label for="selecttt">Người nhận<span class="required">*</span>
                                                                </label>
                                                                @if($errors->first('request_name'))
                                                                    <select style="width: 500px"
                                                                            class="js-example-basic-multiple"
                                                                            multiple="multiple" name="request_name[]"
                                                                            id="selecttt">
                                                                        @foreach($referenceStaff as $master)
                                                                            <option value="{{ $master['id'] }}">
                                                                                {{ $master['code'] }}
                                                                                .{{ $master['full_name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    {{-- thong bao loi --}}
                                                                    <span class="text-danger">{{ $errors->first('request_name') }}</span>
                                                                    {{--   --}}
                                                                @else
                                                                    <select style="width: 500px;"
                                                                            class="js-example-basic-multiple"
                                                                            multiple="multiple" name="request_name[]"
                                                                            id="selecttt">

                                                                        @foreach($referenceStaff as $master)
                                                                            <option value="{{ $master['id'] }}">
                                                                                {{ $master['code'] }}
                                                                                .{{ $master['full_name']}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Ghi chú:</label>
                                    <textarea maxlength="1000" class="form-control" id="exampleFormControlTextarea1"
                                              rows="3" name="request_note"></textarea>
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer" style="margin-left: 0px">
                                    <a class="btn btn-default" href="{{ route('web.request.index') }}">Trở Lại</a>
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </div>
                                <!-- /.box-footer -->
                            </form>
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

    <script type="text/javascript">
        $('.js-example-basic-multiple').select2({
            placeholder: 'Nhập tên hoặc mã nhân viên'
        });
    </script>
    <style type="text/css">
        .required {
            color: red;
        }
    </style>
    <!-- /.content-wrapper -->
@endsection