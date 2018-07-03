
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">

    <title>Med - Log in </title>

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
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="{{route('login')}}"><b>Haitch </b>Admin</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form id="sign_in" method="POST" action="{{ route('login') }}" class="form-element">
            {{csrf_field()}}
            @if ($errors->has('email'))
                <span class="help-block">
                     <strong style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;{{ $errors->first('email') }}</strong>
                    <br>
                </span>
            @endif

            @if ($errors->has('password'))
                <span class="help-block">
                     <strong style="color: red"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp;{{ $errors->first('password') }}</strong>
                 </span>
            @endif
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Email ID" id="email" name="email">
                <span class="ion ion-person form-control-feedback "></span>

            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" id="password" name="password" >
                <span class="ion ion-locked form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="checkbox">
                        <input type="checkbox" id="basic_checkbox_1" >
                        <label for="basic_checkbox_1">Remember Me</label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <div class="fog-pwd">
                        <a href="{{ route('forgetPassword.email') }}"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-info btn-block margin-top-10">SIGN IN</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->


<!-- jQuery 3 -->
<script src="{{ asset('admin/assets/vendor_components/jquery/dist/jquery.min.js')}}"></script>

<!-- popper -->
<script src="{{ asset('admin/assets/vendor_components/popper/dist/popper.min.js')}}"></script>

<!-- Bootstrap 4.0-->
<script src="{{ asset('admin/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

</body>

</html>
