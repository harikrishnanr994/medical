
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="user-profile treeview">
                <a href="index-2.html">
                    <img src="{{ asset('admin/images/user5-128x128.jpg')}}" alt="user">
                    <span>{{Auth::user()->name}}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{route('auth.logout')}}"><i class="fa fa-power-off mr-5"></i>Logout</a>
                    </li>
                </ul>
            </li>
            {{--
                        <li class="header nav-small-cap">PERSONAL</li>
            --}}
            <li class={{$request->segment(1) == 'home' ? 'active' : ''}}>
                <a href="{{route('home')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>User Management</span>
                    <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">
                     <li>
                         <a href="{{route('permissions.index')}}"><i class="fa fa-circle-thin"></i>Permissions</a>
                     </li>
                     <li>
                         <a href="{{route('roles.index')}}"><i class="fa fa-circle-thin"></i>Roles</a>
                     </li>
                    <li>
                        <a href="{{route('users.index')}}"><i class="fa fa-circle-thin"></i>All Users</a>
                    </li>
                </ul>
            </li>
            <!-- ADMIN-->
            @can('creates_admin')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('admins.index')}}"><i class="fa fa-circle-thin"></i>Create admin</a>
                        </li>
                        <li>
                            <a href="{{route('admins.index')}}"><i class="fa fa-circle-thin"></i>All admins</a>
                        </li>
                    </ul>
                </li>
            @endcan
        <!--END ADMIN-->

        </ul>
    </section>
</aside>