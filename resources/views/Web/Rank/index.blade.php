@extends('Web.Layout.home')

@section('content')
    <script src="https://code.jquery.com/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- Content Wrapper. Contains page content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.ranks.index') }}">Quản lý Rank</a></li>
                            <li class="breadcrumb-item active">Danh sách rank</li>
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
                        <h3 class="card-title">DANH SÁCH RANK</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2" style="margin-bottom: 20px">
                                <a href="{{ route('web.ranks.create') }}">
                                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.col -->

                        <!-- Thông báo đã có nhân viên thuộc rank -->
                        @include('flash::message')

                        <!-- table danh sách rank-->
                        <table  class="table table-bordered table-hover" style="margin-top: 20px">
                            <thead style="text-align: center" class="thead-light">
                            <tr >
                                <th style="width: 10%">STT</th>
                                <th>Tên rank</th>
                                <th style="width: 10%">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                            <?php
                            $i = 1;
                            ?>
                            @foreach ($ranks as $value)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td class="allow-edit" data-param="rank">
                                        {{ $value->rank }}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button class="btn btn-primary btn-sm"
                                                        onclick="editRank(this)"
                                                        data-href="{{ route('web.ranks.update', $value->id) }}">
                                                    Sửa
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <form method="POST" action="{!! route('web.ranks.destroy', [$value->id]) !!}" onsubmit="return confirmDelete()" >
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input class="btn btn-danger btn-sm" type="submit" value="Xóa" name="">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
            var result = confirm('Bạn có chắc muốn xóa rank này?');
            if (result) {
                return true;
            } else {
                return false;
            }
        }

        // Sửa trực tiếp trong màn index
        function editRank(elem) {
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
                    let gradeInput = $(this).attr('name');
                    let value = $(this).val();
                    dataUpdate.push({name: gradeInput, value: value});
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
