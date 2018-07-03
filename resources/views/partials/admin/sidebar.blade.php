
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
            <!-- ADMIN-->
            @can('hqadmin_manage')
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-user"></i>
                        <span>Hq Admin</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('hq.index')}}"><i class="fa fa-circle-thin"></i>All Hq Admins</a>
                        </li>
                        <li>
                            <a href="{{route('hq.create')}}"><i class="fa fa-circle-thin"></i>Create Hq Admin</a>
                        </li>
                    </ul>
                </li>


            @endcan
        <!--END ADMIN-->
        </ul>
    </section>
</aside>