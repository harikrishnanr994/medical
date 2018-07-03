
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>Med - Registration </title>

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css')}}">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap/dist/css/bootstrap-extend.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/css/master_style.css')}}">

    <!-- MinimalPro Admin Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/css/skins/_all-skins.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="../../index-2.html"><b>Med</b>Admin</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form method="POST" action="{{ route('register') }}" class="form-element">
            {{csrf_field()}}
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name" name="name">
                <span class="ion ion-person form-control-feedback "></span>
                @if ($errors->has('name'))
                    <span style="color:red">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="ion ion-email form-control-feedback "></span>
                @if ($errors->has('email'))
                    <span style="color:red">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Full name" name="user_name">
                <span class="ion ion-person form-control-feedback "></span>
                @if ($errors->has('user_name'))
                    <span style="color:red">{{ $errors->first('user_name') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="ion ion-locked form-control-feedback "></span>
                @if ($errors->has('password'))
                    <span style="color:red">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
                <span class="ion ion-log-in form-control-feedback "></span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1" >
                        <label for="basic_checkbox_1">I agree to the <a href="#"><b>Terms</b></a></label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN UP</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-social-icon btn-circle btn-facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="btn btn-social-icon btn-circle btn-google"><i class="fa fa-google-plus"></i></a>
        </div>
        <!-- /.social-auth-links -->

        <div class="margin-top-20 text-center">
            <p>Already have an account?<a href="{{ route('login') }}" class="text-info m-l-5"> Sign In</a></p>
        </div>

    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->


<!-- jQuery 3 -->
<script src="{{ asset('admin/assets/vendor_components/jquery/dist/jquery.min.js')}}"></script>

<!-- popper -->
<script src="{{ asset('admin/assets/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('admin/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>


</body>


</html>



















    {{--    <!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from thememakker.com/templates/nexa/html/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2018 11:47:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:: F-Boxx Admin::</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/authentication.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/color_skins.css')}}">
    <style>
        .authentication .card {
            max-width: 350px;
            margin-top: 85px;}

        .form-group {
            padding-bottom: -5px;
            /* margin: 27px 0 0 0; */
        }
    </style>
</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header slideDown">
                        <div class="logo"><img src="{{ asset('admin/images/logo.png')}}" alt="Nexa"></div>
                        <h1>F-Boxx Admin</h1>
                        <ul class="list-unstyled l-social">
                            <li><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <form class="col-lg-12" method="POST" action="{{ route('register') }}">
                    {{csrf_field()}}
                  --}}{{--  <h5 class="title">Register a new membership</h5>--}}{{--
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" required>
                            <label class="form-label">Name Surname</label>
                            @if ($errors->has('name'))
                                <span style="color:red">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" required>
                            <label class="form-label">Email Address</label>

                            @if ($errors->has('email'))
                                 <span style="color:red">{{ $errors->first('email') }}</span>
                            @endif
                        </div>


                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="user_name" required>
                            <label class="form-label">User Name</label>
                            @if ($errors->has('user_name'))
                                <span style="color:red">{{ $errors->first('user_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" required>
                            <label class="form-label">Password</label>

                            @if ($errors->has('password'))
                                <span style="color:red">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="password" class="form-control" name="password_confirmation" required>
                            <label class="form-label">Confirm Password</label>
                        </div>
                    </div>


                <div class="col-lg-12">
                    <button type="submit" class="btn btn-raised btn-primary waves-effect">SIGN UP</button>
                </div>
                </form>
                <div class="col-lg-12 m-t-20">
                    <a href="{{ route('login') }}">You already have a membership?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jquery Core Js -->
<script src="{{ asset('admin/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('admin/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{ asset('admin/bundles/mainscripts.bundle.js')}}"></script><!-- Custom Js -->
</body>

<!-- Mirrored from thememakker.com/templates/nexa/html/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2018 11:47:35 GMT -->
</html>
--}}