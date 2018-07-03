<body class="hold-transition skin-blue-light sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <b class="logo-mini">
                <span class="light-logo">{{--<img src="{{ asset('admin/images/logo.png')}}" width="30px" height="30px"
                                              alt="logo">--}}</span>
            </b>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">
                <b>Med</b>
	  </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">



                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                        </a>
                        <ul class="dropdown-menu scale-up">
                            <li class="header">You have {{$notificationCount}} notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu inner-content-div">
                                    @foreach($notifications as $notification)
                                        <li>
                                            <a href="{{ route('notification.read', $notification->notification_id) }}">
                                                <i class="fa fa-users text-aqua"></i>  {{ $notification->text }}
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('admin/images/user5-128x128.jpg')}}" class="user-image rounded-circle"
                                 alt="User Image">
                        </a>
                        <ul class="dropdown-menu scale-up">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('admin/images/user5-128x128.jpg')}}"
                                     class="float-left rounded-circle" alt="User Image">

                                <p>
                                    {{Auth::user()->name}}
                                    <small class="mb-5"> {{Auth::user()->email}}</small>

                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row no-gutters">
                                    <div role="separator" class="divider col-12"></div>
                                    <div class="col-12 text-left">
                                        <a href="{{route('auth.logout')}}"><i class="fa fa-power-off"></i> Logout</a>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>

    </header>
