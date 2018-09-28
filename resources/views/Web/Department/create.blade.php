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
                            <li class="breadcrumb-item"><a href="{{ route('web.departments.index') }}">Phòng ban</a></li>
                            <li class="breadcrumb-item active">Thêm phòng ban</li>
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
                        <h3 class="card-title">Tạo mới phòng ban</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="box box-info">
                            <!-- form start -->
                            <form method="POST" action="{{ route('web.departments.store') }}" class="form-horizontal">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="control-label">Tên phòng ban<span class="required">*</span></label>
                                        <input type="text" name="name" class="form-control col-sm-8" placeholder="Tên phòng ban" required />
                                    </div>
                                    @if(isset($error))
                                        <div id="form-messages col-sm-8" class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endif
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <a class="btn btn-default" href="{{ route('web.departments.index') }}">Trở Lại</a>
                                        <button type="submit" class="btn btn-info">Thêm mới</button>
                                    </div>
                                    <!-- /.box-footer -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <!--/. card-body-->
                </div>
                <!-- /.card card-default -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!--/. section-content-->
    </div>
    <!-- /.content -->

    <style type="text/css">
        .required{
            color:red;
        }
    </style>

@endsection
