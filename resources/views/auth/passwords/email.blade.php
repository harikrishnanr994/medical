{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
--}}
        <!doctype html>
<html class="no-js " lang="en">

<!-- Mirrored from thememakker.com/templates/nexa/html/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2018 11:47:35 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>:: Med::</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/authentication.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/css/color_skins.css')}}">
</head>

<body class="theme-orange">
<div class="authentication">
    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header slideDown">
                        <div class="logo"><img src="{{ asset('admin/images/logo.png')}}" alt="Nexa"></div>
                        <h1>Med Admin</h1>
                        <ul class="list-unstyled l-social">
                            <li><a href="#"><i class="zmdi zmdi-facebook-box"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-linkedin-box"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <form class="col-lg-12" id="sign_in" method="POST"  action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                    <h5 class="title">Forgot Password?</h5>
                    <small class="msg">Enter your e-mail address below to reset your password.</small>
                    <div class="form-group form-float">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="form-line">

                                <input type="email" class="form-control" value="{{ old('email') }}" required>
                                <label class="form-label">Email</label>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="col-lg-12">
                    <a href="index.html" class="btn btn-raised btn-primary waves-effect">Reset my password</a>
                </div>
                <div class="col-lg-12 m-t-20">
                    <a href="{{ route('login') }}" title="">Sign In!</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
</body>

<!-- Mirrored from thememakker.com/templates/nexa/html/forgot-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 04 Jan 2018 11:47:35 GMT -->
</html>
