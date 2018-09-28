@extends('Web.Layout.home')

@section('content')
    <!-- Content Contains page content -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.departments.index') }}">Phòng ban</a>
                            </li>
                            <li class="breadcrumb-item active">Danh sách phòng ban</li>
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
                        <h3 class="card-title">DANH SÁCH PHÒNG BAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            {{--<div class="col-md-3"></div>--}}
                            {{--<div class="col-md-3">--}}
                            {{--<div class="form-group">--}}
                            {{--<input class="form-control" placeholder="Tên phòng ban"/>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-md-2">--}}
                            {{--<button type="submit" class="btn btn-primary">Tìm kiếm</button>--}}
                            {{--</div>--}}

                            @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_GM)
                                <div class="col-sm-6" style="margin-bottom: 20px">
                                    <a href="{{route('web.departments.create')}}" class="btn btn-primary">Thêm phòng
                                        ban</a>
                                </div>
                            @endif
                        </div>
                        <!-- /.col -->

                        <!--  Thông báo phòng ban đang tồn tại nhân viên -->
                        @include('flash::message')

                        <!-- table index phòng ban-->
                        <table class="table table-bordered table-hover" style="text-align: center; width: 100%">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 10%">STT</th>
                                <th>Tên phòng ban</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_GM)
                                    <th style="width: 10%">Thao tác</th>
                                @endif
                            </tr>
                            </thead>
                            <?php $i = ($departments->currentpage()-1)* $departments->perpage() + 1;?>
                            <tbody>
                            @foreach($departments as $department)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="allow-edit" data-param="name">
                                        {{ $department->name }}
                                    </td>
                                    @if(\Illuminate\Support\Facades\Auth::user()->role != \App\Models\Staff::ROLE_GM)
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary btn-sm"
                                                            onclick="editDepartment(this)"
                                                            data-href="{{ route('web.departments.update', $department->id) }}">
                                                        Sửa
                                                    </button>
                                                </div>
                                                <div class="col-md-6">
                                                    {{ Form::open(['method' => 'DELETE', 'route' => ['web.departments.destroy',
                                                        $department->id], 'onsubmit' => 'return confirm("Bạn chắc chắn xóa không?")']) }}
                                                    {{ Form::submit('Xóa', ['class' => 'btn btn-danger btn-sm']) }}
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- /.table tạo opes-->
                        <div style="margin-top: 10px; float: right">
                            {{ $departments->links('Web.Share.paginate') }}
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

    <script>
        function editDepartment(elem) {
            let trCurrent = $(elem).closest('tr');
            let isEdit = trCurrent.hasClass('edit');

            if (!isEdit) {
                trCurrent.addClass('edit');
                $(elem).html('Lưu');
                // var firstFocus;
                //TH1: bật sửa
                trCurrent.find('.allow-edit').each(function () {
                    // if(typeof firstFocus == 'undefined') firstFocus = $(this);
                    let name = $(this).attr('data-param');
                    let value = $(this).text().trim();
                    $(this).empty().append('<input class="form-control" name="' + name + '" value="' + value + '"/>');
                    // console.log(firstFocus);
                });

                // firstFocus.focus();
            } else {
                //TH2: Save
                let url = $(elem).attr('data-href');
                let dataUpdate = [];
                trCurrent.find('.allow-edit input').each(function () {
                    let nameInput = $(this).attr('name');
                    let value = $(this).val();
                    dataUpdate.push({name: nameInput, value: value});
                });
                console.log(dataUpdate);
                //Send ajax
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    method: 'PUT',
                    dataType: 'JSON',
                    data: dataUpdate
                }).done(function (res) {
                    if (res.status) {
                        trCurrent.find('.allow-edit input').each(function () {
                            let value = $(this).val();
                            $(this).closest('td').empty().html(value);
                        });
                        trCurrent.removeClass('edit');
                        $(elem).html('Sửa');
                    } else {
                        alert(res.data);
                    }
                });
            }
        }

        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
    </script>
@endsection