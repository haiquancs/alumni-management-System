@extends('Web.Layout.home')

@section('content')
    <!-- Content Contains page content -->
    <div class="content" style="background-image: url('{{asset('img/uet.jpg')}}');">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.surveys.index') }}">Survey</a>
                            </li>
                            <li class="breadcrumb-item active">Tạo bản khảo sát</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content" style="width: 50%; margin: auto;">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title"><b>PHIẾU LẤY Ý KIẾN CỰU SINH VIÊN</b></h3>
                        <p align="justify" style="font-size: 12px">Thân gửi Anh/Chị cựu sinh viên của Trường Đại học Công nghệ, Đại học Quốc gia Hà Nội,<br>
Với mục tiêu đào tạo người học tốt nghiệp ra trường có đủ kiến thức, kỹ năng chuyên môn nghiệp vụ và phẩm chất đạo đức nghề nghiệp đáp ứng yêu cầu nghề nghiệp của thị trường lao động, chúng tôi tiến hành lấy ý kiến của cựu sinh viên về các năng lực thực hiện công việc sau khi tốt nghiệp của cử nhân  Trường Đại học Công nghệ - Đại học Quốc gia Hà Nội để làm căn cứ điều chỉnh, nâng cao chất lượng đào tạo của ngành. Chúng tôi mong Anh/Chị chia sẻ các ý kiến về vấn đề này để giúp chúng tôi có cơ sở rà soát, cải tiến chương trình đào tạo để đáp ứng tốt hơn với nhu cầu thực tế.<br>
Xin chân thành cảm ơn sự hợp tác của Anh/Chị.<br>
Thông tin thu được từ phiếu này chỉ dùng cho mục đích nghiên cứu</p>
						<p></p>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if(!empty($errors->toArray()))
                            <div id="form-messages" class="alert alert-danger col-sm-8" role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <!-- form start -->
                        <form action="{{ route('web.surveys.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">1. Họ của bạn :</label>
                                    <input class="form-control col-6" type="text" name="first_name" value="" placeholder="Câu trả lời của bạn">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">2. Tên của bạn:</label>
                                    <input class="form-control col-6" type="text" name="last_name" value="" placeholder="Câu trả lời của bạn">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">3. Giới tính của bạn :</label>
                                    <select class="form-control col-6" name="sex">
                                        <option value="">Nam</option>
                                        <option value="">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">4. Phone</label>
                                    <input class="form-control col-6" type="text" name="phone" value="" placeholder="Câu trả lời của bạn">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">5. Email</label>
                                    <input class="form-control col-6" type="text" placeholder="example@gmail.com" name="email" value="">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">6. Thời gian tốt nghiệp cử nhân</label>
                                    <select class="form-control col-6" name="graduation_year">
                                        <option value="">2018</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">7. Chuyên ngành tốt nghiệp cử nhân</label>
                                    <select class="form-control col-6" name="graduation_business">
                                        <option value="">fbfb</option>
                                    </select>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info">Gửi bản khảo sát</button>
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
        <!--/. section-content-->
    </div>
    <!-- /.content -->

    <style type="text/css">
        .required {
            color: red;
        }
    </style>
@endsection