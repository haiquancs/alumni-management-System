<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_STUDENT){{route('web.surveys.index')}}@else#@endif" class="brand-link"  style="margin-left: 16px">
        <img src="{{asset('favicon.ico')}}" alt="User Avatar" class="mr-3 img-circle" width="40px" height="40px">
        <span class="brand-text font-weight-light">CỰU SINH VIÊN</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_STUDENT)
                    <li class="nav-item has-treeview">
                        <a href="{{route('web.surveys.index')}}" class="nav-link {{ Request::path()=='surveys'?'activeCustom':'' }}" id="abc">
                            <i class="nav-icon fas fa-mortar-board"></i>
                            <p>
                                Survey
                            </p>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_ADMIN)
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link {{ Request::path()=='manage-opes'?'activeCustom':'' }}" id="abc">
                            <i class="nav-icon fas fa fa-line-chart"></i>
                            <p>
                                Thống kê, báo cáo
                            </p>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="#" class="nav-link {{-- {{ explode('/',Request::path())[0]=='users'?'activeCustom':'' }} --}}">
                            <i class="nav-icon fas fa fa-edit"></i>
                            <p>
                                Quản Lý Survey
                            </p>
                        </a>
                    </li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user()->role == \App\Models\User::ROLE_ADMIN)
                    <li class="nav-item">
                        <a href="{{ route('web.users.index') }}" class="nav-link {{ explode('/',Request::path())[0]=='users'?'activeCustom':'' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Quản Lý Tài Khoản
                            </p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>