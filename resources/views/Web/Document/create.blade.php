@extends('Web.Layout.home')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\Staff::ROLE_ADMIN)
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <!-- Content Wrapper. Contains page content -->
        <div class="content">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="{{ route('web.document.index') }}">Quản lý tài
                                        liệu</a></li>
                                <li class="breadcrumb-item active">Upload tài liệu</li>
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
                            <h3 class="card-title">UPLOAD TÀI LIỆU</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="box box-info">
                                <form action="{{ route('web.document.store') }}" enctype="multipart/form-data"
                                      method="POST">{{ csrf_field() }}
                                    {{-- <input type="file" name="filesTest" required="true">
                                    <br/>
                                    <br> --}}
                                    {{-- <input type="submit" value="Upload"> --}}
                                    {{-- <input class="btn btn-success" type="submit" value="Upload"> --}}

                                    <div class="input-group col-md-6">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                            <input type="file" name="filesTest" required="true"
                                                   class="custom-file-input" id="inputGroupFile04"
                                                   aria-describedby="inputGroupFileAddon04">
                                        </div>
                                        <div class="input-group-append">
                                            <button class="btn btn-info" type="submit" id="inputGroupFileAddon04">
                                                Upload
                                            </button>
                                        </div>
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
            <!--/. content-->
        </div>
        <!-- /.content-wrapper -->
    @else
        <p>Bạn không được thực hiện chức năng này!</p>
    @endif
    <script type="text/javascript">
        $(function() {
            $('input[type=file]').change(function(){
                var t = $(this).val();
                var labelText = t.substr(12, t.length);
                $(this).prev('label').text(labelText);
            })
        });
    </script>
@endsection