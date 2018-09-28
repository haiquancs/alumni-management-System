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
                            <li class="breadcrumb-item"><a href="{{ route('web.document.index') }}">Quản lý tài liệu</a>
                            </li>
                            <li class="breadcrumb-item active">Danh sách tài liệu</li>
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
                        <h3 class="card-title">DANH SÁCH TÀI LIỆU</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                        	@if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
                                <div class="col-sm-6" style="">
                                    <a href="{{ route('web.document.create') }}">
                                        <button type="submit" class="btn btn-primary">Upload Tài liệu</button>
                                    </a>
                                </div>
                                @endif
                        </div>
                        <!-- /.col -->
                        <!-- table danh sách rank-->

                        <table class="table table-bordered table-hover" style="margin-top: 20px">
                            <thead style="text-align: center" class="thead-light">
                            <tr>
                                <th style="width: 10%">STT</th>
                                <th>Tên tài liệu</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
                                <th style="width: 10%">Thao tác</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody style="text-align: center">
                                <?php $i = 1; ?>
                                    @foreach($listFile as $listFiles)
                                    <tr class="">
                                        <td>{{$i++}}</td>
                                        <td style="vertical-align: middle;"><a href="{{ asset('upload/'.$listFiles) }}">{{ $listFiles }}</a></td>
                                        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
                                        <td style="vertical-align: middle;">
                                            <form method="POST" action="{{ route('web.document.destroy',$listFiles) }}" onsubmit="return confirmDelete()" >
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input class="btn btn-danger btn-sm" type="submit" value="Xóa" name="">
                                            </form>
                                        </td>
                                        @endif
                                    @endforeach
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        function confirmDelete() {
            var result = confirm('Bạn có chắc muốn xóa tài liệu này?');
            if (result) {
                return true;
            } else {
                return false;
            }
        }
    </script>
@endsection