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
                            <li class="breadcrumb-item"><a href="{{ route('web.staffs.index') }}">Quản lý tài khoản</a>
                            </li>
                            <li class="breadcrumb-item active">Tạo tài khoản</li>
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
                        <h3 class="card-title">TẠO TÀI KHOẢN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="box box-info">
                            <!-- form start -->

                            <form method="POST" action="{{ route('web.staffs.store') }}" autocomplete="off"
                                  id="form-create">
                                {{ csrf_field() }}

                                <div class="box-body">
                                    <div class="form-group"><span class="required">* Trường bắt buộc</span></div>
                                    <div class="form-group row {{ $errors->has('code') ? 'has-error' : '' }}">
                                        <label for="inputEmail3" class="col-2 col-form-label">Mã nhân viên<span
                                                    class="required">*</span></label>
                                        <input @if($errors->first('code')) style="border-color: red;" @endif
                                        type="text" name="code" class="form-control col-6"
                                               placeholder="Mã nhân viên (Chỉ chứa số)"
                                               value="{{ old('code') }}"/>
                                        <span class="text-danger">{{ $errors->first('code') }}</span>
                                    </div>

                                    <div class="form-group row {{ $errors->has('email') ? 'has-error' : ''}}">
                                        <label for="inputEmail3" class="col-2 col-form-label">Email<span
                                                    class="required">*</span></label>
                                        <input @if($errors->first('email')) style="border-color: red" @endif type="text"
                                               name="email" class="form-control col-6" maxlength="50"
                                               placeholder="Exp: abc@ominext.com" value="{{ old('email') }}"/>
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Họ<span
                                                    class="required">*</span></label>
                                        <input @if($errors->first('first_name')) style="border-color: red;" @endif
                                        type="text" name="first_name" class="form-control col-6" placeholder="Họ"
                                               value="{{ old('first_name') }}"/>
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Tên<span
                                                    class="required">*</span></label>
                                        <input @if($errors->first('last_name')) style="border-color: red;" @endif
                                        type="text" name="last_name" class="form-control col-6" placeholder="Tên"
                                               value="{{ old('last_name') }}"/>
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    </div>

                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Chức vụ<span
                                                    class="required">*</span></label>
                                        <select name="role" class="form-control col-6"
                                                @if($errors->first('role')) style="border-color: red;" @endif
                                                onchange="chooseListManager()">
                                            <option value="" disabled selected>-Select-</option>
                                            @foreach($roles as $key => $role)
                                                <option value="{{ $key }}">{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger">{{ $errors->first('role') }}</span>
                                    </div>

                                    <div class="form-group group-rank row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Hạng<span
                                                    class="required">*</span></label>
                                        <select name="rank_id" class="form-control col-6">
                                            @foreach($ranks as $key => $rank)
                                                <option value="{{ $key }}">{{ $rank }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group group-grade row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Cấp<span
                                                    class="required">*</span></label>
                                        <select name="grade_id" class="form-control col-6">
                                            @foreach($grades as $key => $grade)
                                                <option value="{{ $key }}">{{ $grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group group-department row">
                                        <label for="inputEmail3" class="col-2 col-form-label">Phòng ban<span class="required">*</span></label>
                                        <select name="department_id" class="form-control col-6"
                                                onchange="chooseListManager()">
                                            @foreach($departments as $key => $department)
                                                <option value="{{ $key }}">{{ $department }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group row" id="reference_staff_id">
                                        <label for="inputEmail4xxx" class="col-2 col-form-label">Người quản lý<span
                                                    class="required">*</span></label>
                                        <select name="reference_staff_id" class="form-control col-6">
                                            <option value="" disabled selected>-Select-</option>
                                        </select>
                                    </div>

                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <a class="btn btn-default" href="{{ route('web.staffs.index') }}">Trở lại</a>
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
        .required {
            color: red;
        }
        .text-danger{
            margin-left: 10px;
        }
    </style>

    <script>
        const ROLE_STAFF = 1;
        const ROLE_GM = 2;
        const ROLE_BOM = 3;
        const ROLE_ADMIN = 4;

        let listManager = '{!! addslashes(json_encode($listManager))!!}';
        listManager = JSON.parse(listManager);
        console.log(listManager);

        function chooseListManager() {
            let department = $('select[name="department_id"]').val();
            let role = $('select[name="role"]').val();
            // console.log({department: department, role: role});

            let listManagerFollow = {};
            if (role == ROLE_STAFF) {
                if (typeof listManager.Staff[department] !== 'undefined' && typeof listManager.Staff[department][role] !== 'undefined')
                    listManagerFollow = listManager.Staff[department][role];
            }
            if (role == ROLE_GM) {
                listManagerFollow = listManager.Gm;
            }
            // console.log(listManagerFollow);
            if (role == ROLE_BOM || role == ROLE_ADMIN) {
                $('#reference_staff_id').html('');
                $('.group-department').addClass('d-none');
                $('.group-rank').addClass('d-none');
                $('.group-grade').addClass('d-none');
            } else {
                $('.group-department').removeClass('d-none');
                $('.group-rank').removeClass('d-none');
                $('.group-grade').removeClass('d-none');
                let listOption = '<option value="" disabled selected>-Select-</option>';
                $.each(listManagerFollow, function (k, v) {
                    listOption += '<option value="' + v.id + '">' + v.full_name + '</option>';
                });
                $('#reference_staff_id').html(" <label for='inputEmail4xxx' class='col-2 col-form-label'>Người quản lý<span class='required'>*</span></label>" +
                    "<select name='reference_staff_id' class='form-control col-6'></select>");

                $('select[name="reference_staff_id"]').empty().append(listOption);
            }
        }

        $(document).ready(function () {
            $("#a").html("");
        })

    </script>

@endsection