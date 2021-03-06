@extends('Web.Layout.home')

@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Content Contains page content -->
    <div class="content" style="background-image: url('{{asset('img/uet.jpg')}}'); background-size: cover; height: 2000px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="{{ route('web.surveys.index') }}"><b>Survey</b></a>
                            </li>
                            <li class="breadcrumb-item active"><b>Tạo bản khảo sát</b></li>
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
                                    <input class="form-control col-6" type="text" name="info[first_name]" value="{{ $user->first_name }}" placeholder="Câu trả lời của bạn">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">2. Tên của bạn:</label>
                                    <input class="form-control col-6" type="text" name="info[last_name]" value="{{ $user->last_name }}" placeholder="Câu trả lời của bạn">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">3. Thời gian tốt nghiệp cử nhân</label>
                                    <select class="form-control col-6" name="info[graduation_year]">
                                        @if($user->sex != NULL)
                                            <option value="{{ $user->graduation_year }}" selected>{{ $user->graduation_year }}(Đã chọn)</option>
                                        @else
                                            <option value="" selected>(Chưa cập nhật)</option>
                                        @endif
                                        @for($year = 2018; $year >= 2010 ; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">4. Chuyên ngành tốt nghiệp cử nhân</label>
                                    <select class="form-control col-6" name="info[graduation_business]">
                                        @if($user->graduation_business != NULL)
                                            <option value="{{ $user->graduation_business }}" selected>{{\App\Models\Business::getNameBusiness($user->graduation_business)->business}}(Đã chọn)</option>
                                        @else
                                            <option value="" selected>(Chưa cập nhật)</option>
                                        @endif
                                        @foreach($business as $business)
                                            <option value="{{ $business->id }}">{{ $business->business }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="info[sex]" value="">
                                <input type="hidden" name="info[email]" value="">
                                <input type="hidden" name="info[phone]" value="">
                                <hr>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">5. Hiện tại Anh/Chị đang có một công việc mang lại thu nhập cho mình hay không?</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        <input class="form-check-input" id="yes" @if(@$jobInfoUsers['job']==\App\Models\JobUser::JOB)checked="checked"@endif type="radio" name="job" value="{{ \App\Models\JobUser::JOB }}" onclick="" required  @if(@$request['job']==\App\Models\JobUser::JOB)checked="checked"@endif><label class="form-check-label">Có</label><br>
                                        <input class="form-check-input" id="no" @if(@$jobInfoUsers['job']==\App\Models\JobUser::UN_JOB)checked="checked"@endif type="radio" name="job" value="{{ \App\Models\JobUser::UN_JOB }}"><label class="form-check-label">Không</label>
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['job']==\App\Models\JobUser::JOB||@$jobInfoUsers['name_job'])@else d-none @endif" id="name_job">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Ghi rõ tên công việc</label>
                                    <input class="form-control col-6" type="text" name="name_job" @if(@$jobInfoUsers['name_job'])value="{{$jobInfoUsers['name_job']}}"@endif value="@if(@$request['name_job']!=NULL){{ $request['name_job'] }}@endif" placeholder="Câu trả lời của bạn">
                                </div>
                                @if(@$error['name_job'])<div id="form-messages" class="alert alert-danger" role="alert">
                                    {{ $error['name_job'] }}
                                </div>@endif
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">6. Anh/Chị có công việc đầu tiên sau khi tốt nghiệp bao lâu?</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach(\App\Models\JobUser::$timeHaveJob as $key => $value)
                                            <input class="form-check-input" type="radio" name="time_have_job" @if(@$jobInfoUsers['time_have_job']==(string)$key)checked="checked"@endif value="{{$key}}" onclick="@if($key==\App\Models\JobUser::TIME_JOB5)show()@else hide()@endif" @if(@$request['time_have_job']==$key)checked="checked"@endif><label class="form-check-label">{{$value}}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                @if(@$error['time_have_job'])<div id="form-messages" class="alert alert-danger" role="alert">
                                    {{ $error['time_have_job'] }}
                                </div>@endif
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">7. Anh/Chị tìm được việc làm hiện tại qua các nguồn thông tin nào?<a style="color: red">(không bắt buộc)</a></label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach(\App\Models\JobUser::$introduceSource as $key => $value)
                                            <input class="form-check-input" type="radio" name="introduce_source" @if(@$jobInfoUsers['introduce_source']==(string)$key)checked="checked"@endif value="{{$key}}" onclick=""><label class="form-check-label">{{$value}}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">8. Loại hình cơ quan Anh/Chị đang làm việc?</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($typeDetailCompany as $key => $type)
                                            <input class="form-check-input" type="radio" name="type_company" @if(@$jobInfoUsers['typeDetailCompany']['typeCompany']['id']==$type['id'])checked="checked"@endif value="{{ $type['id'] }}" onclick=@if($type['id']==1)"country()" @elseif($type['id']==2) "aGencies()" @elseif($type['id']==3) "nonOrganizations()" @endif @if(@$request['type_company']==($type['id']))checked="checked"@endif><label class="form-check-label">{{ $type['type'] }}</label><br>
                                        @endforeach
                                        <input class="form-check-input" type="radio" name="type_company" value="9999999999999999999" onclick="typeCompanyElse()" @if(@$request['type_company']==9999999999999999999)checked="checked"@endif><label class="form-check-label">Khác</label><br>
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['type_company']==1||@$jobInfoUsers['typeDetailCompany']['typeCompany']['id']==1)@else d-none @endif" id="country">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Loại hình cơ quan Nhà nước</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($typeDetailCompany[0]['typeDetailCompany'] as $key => $typeDetail)
                                            <input class="form-check-input" type="radio" name="agencies" @if(@$jobInfoUsers['typeDetailCompany']['id']==$typeDetail['id'])checked="checked"@endif value="{{ $typeDetail['id'] }}" @if(@$request['agencies']==($typeDetail['id']))checked="checked"@endif><label class="form-check-label">{{ $typeDetail['type_detail'] }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['type_company']==2||@$jobInfoUsers['typeDetailCompany']['typeCompany']['id']==2)@else d-none @endif" id="agencies">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Cơ quan/Doanh nghiệp</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($typeDetailCompany[1]['typeDetailCompany'] as $key => $typeDetail)
                                            <input class="form-check-input" type="radio" name="enterprise" @if(@$jobInfoUsers['typeDetailCompany']['id']==$typeDetail['id'])checked="checked"@endif value="{{ $typeDetail['id'] }}" @if(@$request['enterprise']==($typeDetail['id']))checked="checked"@endif><label class="form-check-label">{{ $typeDetail['type_detail'] }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['type_company']==3||@$jobInfoUsers['typeDetailCompany']['typeCompany']['id']==3)@else d-none @endif" id="non_organizations">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Tổ chức phi chính phủ</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($typeDetailCompany[2]['typeDetailCompany'] as $key => $typeDetail)
                                            <input class="form-check-input" type="radio" name="non_organizations" @if(@$jobInfoUsers['typeDetailCompany']['id']==$typeDetail['id'])checked="checked"@endif value="{{ $typeDetail['id'] }}" @if(@$request['non_organizations']==($typeDetail['id']))checked="checked"@endif><label class="form-check-label">{{ $typeDetail['type_detail'] }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['type_company']==9999999999999999999)@else d-none @endif" id="type_company_else">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Loại hình khác(ghi rõ)</label>
                                    <input class="form-control col-6" type="text" name="type_company_else" value="@if(@$request['type_company_else']!=NULL){{ $request['type_company_else'] }}@endif" placeholder="Câu trả lời của bạn">
                                </div>
                                @if(@$error['type_company'])<div id="form-messages" class="alert alert-danger" role="alert">
                                    {{ $error['type_company'] }}
                                </div>@endif
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">9. Ví trí hiện tại Anh/Chị được bố trí?</label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($rollJob as $key => $roll)
                                            <input class="form-check-input" type="radio" name="roll_job" @if(@$jobInfoUsers['roll_job_id']==$roll['id'])checked="checked"@endif value="{{ $roll['id'] }}" onclick="hide1()" @if(@$request['roll_job']==($roll['id']))checked="checked"@endif><label class="form-check-label">{{ $roll['roll'] }}</label><br>
                                        @endforeach
                                        <input class="form-check-input" type="radio" name="roll_job" value="99999999999999" onclick="show1()" @if(@$request['roll_job']==99999999999999)checked="checked"@endif><label class="form-check-label">Vị trí khác</label>
                                    </div>
                                </div>
                                <div class="form-group row @if(@$request['roll_job']==99999999999999)@else d-none @endif" id="roll_job">
                                    <label for="inputEmail3" class="col-4 col-form-label" style="color: green">Ghi rõ vị trí khác</label>
                                    <input class="form-control col-6" type="text" name="roll_job_else" value="@if(@$request['roll_job_else']!=NULL){{ $request['roll_job_else'] }}@endif" placeholder="Câu trả lời của bạn">
                                </div>
                                @if(@$error['roll_job'])<div id="form-messages" class="alert alert-danger" role="alert">
                                    {{ $error['roll_job'] }}
                                </div>@endif
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">10. Mức lương hiện tại của Anh/Chị?<a style="color: red">(không bắt buộc)</a></label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        @foreach($salary as $key => $salary)
                                            <input class="form-check-input" type="radio" name="salary" @if(@$jobInfoUsers['salary_id']==$salary['id'])checked="checked"@endif value="{{ $key+1 }}" @if(@$request['salary']==($key+1))checked="checked"@endif><label class="form-check-label">{{ $salary['salary'] }}</label><br>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-4 col-form-label">11. Anh/chị có phải tham gia các khóa đào tạo thêm nào để có thể đáp ứng công việc hiện tại không?<a style="color: red">(không bắt buộc)</a></label>
                                    <div class="form-check form-control col-6" style="border: 0px">
                                        <input class="form-check-input" type="checkbox" name="traning[0]" value="Ngoại ngữ" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Ngoại ngữ")checked @endif @endforeach><label class="form-check-label">Ngoại ngữ</label><br>
                                        <input class="form-check-input" type="checkbox" name="traning[1]" value="Vi tính" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Vi tính")checked @endif @endforeach><label class="form-check-label">Vi tính</label><br>
                                        <input class="form-check-input" type="checkbox" name="traning[2]" value="Cao học" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Cao học")checked @endif @endforeach><label class="form-check-label">Cao học</label><br>
                                        <input class="form-check-input" type="checkbox" name="traning[3]" value="Văn bằng hai" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Văn bằng hai")checked @endif @endforeach><label class="form-check-label">Văn bằng hai</label><br>
                                        <input class="form-check-input" type="checkbox" name="traning[4]" value="Kỹ năng mềm" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Kỹ năng mềm")checked @endif @endforeach><label class="form-check-label">Kỹ năng mềm</label><br>
                                        <input class="form-check-input" type="checkbox" name="traning[5]" value="Đi du học" @foreach(explode(',',@$jobInfoUsers['traning']) as $value)@if($value == "Đi du học")checked @endif @endforeach><label class="form-check-label">Đi du học</label><br>
                                    </div>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $("#yes").click(function(){
                $("#name_job").removeClass('d-none');
            });
            $("#no").click(function(){
                $("#name_job").addClass('d-none');
            });
        });
        function show(){
            document.getElementById("time_have_job").classList.remove('d-none');
        }
        function hide(){
            document.getElementById("time_have_job").classList.add('d-none');
        }
        function show1(){
            document.getElementById("roll_job").classList.remove('d-none');
        }
        function hide1(){
            document.getElementById("roll_job").classList.add('d-none');
        }
        function country(){
            document.getElementById("country").classList.remove('d-none');
            document.getElementById("agencies").classList.add('d-none');
            document.getElementById("non_organizations").classList.add('d-none');
            document.getElementById("type_company_else").classList.add('d-none');
        }
        function aGencies(){
            document.getElementById("agencies").classList.remove('d-none');
            document.getElementById("country").classList.add('d-none');
            document.getElementById("non_organizations").classList.add('d-none');
            document.getElementById("type_company_else").classList.add('d-none');
        }
        function nonOrganizations(){
            document.getElementById("non_organizations").classList.remove('d-none');
            document.getElementById("agencies").classList.add('d-none');
            document.getElementById("country").classList.add('d-none');
            document.getElementById("type_company_else").classList.add('d-none');
        }
        function typeCompanyElse(){
            document.getElementById("type_company_else").classList.remove('d-none');
            document.getElementById("country").classList.add('d-none');
            document.getElementById("agencies").classList.add('d-none');
            document.getElementById("non_organizations").classList.add('d-none');
        }
    </script>
@endsection