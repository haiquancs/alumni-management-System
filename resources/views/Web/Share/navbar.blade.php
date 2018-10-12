<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_STUDENT)
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link">Mã sinh viên: {{Auth::user()->code}}</b>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link">Tên sinh viên: {{Auth::user()->full_name}}</b>
        </li>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_ADMIN)
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link">Quyền: {{\App\Models\User::$role[Auth::user()->role]}}</b>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link">Tên admin: {{Auth::user()->full_name}}</b>
        </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <b class="nav-link" id="timeVN"></b>
        </li>
        <script>
          setInterval(displayTime, 1000);
          function displayTime(){
             var d = new Date();
             document.getElementById("timeVN").innerHTML = d.toLocaleTimeString();
          }
        </script>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <img src="{{asset('img/staff.png')}}" alt="User Avatar" class="img-size-32 mr-1 img-circle"
                     style="border-radius: 50%">
                <b>{{Auth::user()->full_name}}</b>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="javascript:void (0);" onclick="showModal('#show-info')" class="dropdown-item">
                    <i class="fa fa-id-card mr-2"></i>Thông tin
                </a>
                <div class="dropdown-divider"></div>
                <a href="javascript:void (0);"
                   onclick="showModal('#modal-change-password')" class="dropdown-item">
                    <i class="fa fa-unlock-alt mr-2"></i>Đổi mật khẩu
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('web.auth.logout')}}" class="dropdown-item">
                    <i class="nav-icon fas fa-sign-out-alt mr-2"></i>Đăng xuất
                </a>
                <div class="dropdown-divider"></div>
            </div>
        </li>
    </ul>
</nav>
<div class="modal fade" id="modal-change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f2f2f2;">
                <h3>ĐỔI MẬT KHẨU</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('web.users.changePassword', Auth::id())}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group row old-password">
                        <label class="col-sm-4">Mật khẩu cũ <span class="required">(*)</span> </label>
                        <input id="old_password" type="password" name="old_password" class="form-control col-8">
                    </div>
                    <div class="form-group row new-password">
                        <label class="col-sm-4">Mật khẩu mới <span class="required">(*)</span></label>
                        <input id="new_password" type="password" name="new_password" class="form-control col-8">
                    </div>
                    <div class="form-group row confirm-new-password">
                        <label class="col-sm-4">Nhập lại mật khẩu <span class="required">(*)</span></label>
                        <input id="confirm_new_password" type="password" name="confirm_new_password"
                               class="form-control col-8">
                    </div>
                    <div class="modal-footer">
                        <button id="form-change-password" type="button" class="btn btn-primary">Đổi Mật Khẩu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f2f2f2;">
                <h3>Thông tin tài khoản</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <table class="table table-user-information">
                            <tbody>
                            <tr>
                                <td>Tên sinh viên:</td>
                                <td>{{Auth::user()->full_name}}</td>
                            </tr>
                            <tr>
                                <td>Mã sinh viên:</td>
                                <td>{{Auth::user()->code}}</td>
                            </tr>
                            <tr>
                                <td>Giới tính:</td>
                                <td>{{Auth::user()->sex}}</td>
                            </tr>
                            <tr>
                                <td>Phone:</td>
                                <td>{{Auth::user()->phone}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>Năm tốt nghiệp:</td>
                                <td>{{Auth::user()->graduation_year}}</td>
                            </tr>
                            <tr>
                                <td>Chuyên ngành tốt nghiệp:</td>
                                <td>{{Auth::user()->business}}</td>
                            </tr>
                            <tr>
                                <td>Ngày tạo:</td>
                                <td>{{Auth::user()->last_access_at}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-sm btn-primary" href="{{route('web.users.edit', Auth::user()->id)}}">Sửa thông tin</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    .required {
        color: red;
    }
</style>