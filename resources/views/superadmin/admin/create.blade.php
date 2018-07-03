@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
<style>

    .form-style-5{
        max-width: 800px;
        padding: 10px 20px;
        background: #1e88e5;
        margin: 10px auto;
        padding: 20px;
        background: #f4f7f8;
        border-radius: 8px;
        font-family: Georgia, "Times New Roman", Times, serif;
    }
    .form-style-5 fieldset{
        border: none;
    }
    .form-style-5 legend {
        font-size: 1.4em;
        margin-bottom: 10px;
    }
    .form-style-5 label {
        display: block;
        margin-bottom: 8px;
    }
    .form-style-5 input[type="text"],
    .form-style-5 input[type="date"],
    .form-style-5 input[type="datetime"],
    .form-style-5 input[type="email"],
    .form-style-5 input[type="password"],
    .form-style-5 input[type="number"],
    .form-style-5 input[type="search"],
    .form-style-5 input[type="time"],
    .form-style-5 input[type="url"],
    .form-style-5 textarea,
    .form-style-5 select {
        font-family: Georgia, "Times New Roman", Times, serif;
        background: rgba(255,255,255,.1);
        border: none;
        border-radius: 4px;
        font-size: 16px;
        margin: 0;
        outline: 0;
        padding: 7px;
        width: 100%;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        background-color: #e8eeef;
        color:#8a97a0;
        -webkit-box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
        box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
        margin-bottom: 30px;

    }
    .form-style-5 input[type="text"]:focus,
    .form-style-5 input[type="date"]:focus,
    .form-style-5 input[type="datetime"]:focus,
    .form-style-5 input[type="email"]:focus,
    .form-style-5 input[type="number"]:focus,
    .form-style-5 input[type="search"]:focus,
    .form-style-5 input[type="time"]:focus,
    .form-style-5 input[type="checkbox"]:focus,
    .form-style-5 input[type="url"]:focus,
    .form-style-5 textarea:focus,
    .form-style-5 select:focus{
        background: #d2d9dd;
    }
    .form-style-5 select{
        -webkit-appearance: menulist-button;
        height:35px;
    }
    .form-style-5 .number {
        background: #1e88e5;
        color: #fff;
        height: 30px;
        width: 30px;
        display: inline-block;
        font-size: 0.8em;
        margin-right: 4px;
        line-height: 30px;
        text-align: center;
        text-shadow: 0 1px 0 rgba(255,255,255,0.2);
        border-radius: 15px 15px 15px 0px;
    }

    .form-style-5 input[type="submit"],
    .form-style-5 input[type="button"],
    .btn1
    {
        position: relative;
        display: block;
        padding: 19px 39px 18px 39px;
        color: #FFF;
        margin: 0 auto;
        background: #1e88e5;
        font-size: 18px;
        text-align: center;
        font-style: normal;
        width: 100%;
        border: 1px solid #1e88e5;
        border-width: 1px 1px 3px;
        margin-bottom: 10px;
    }
    .form-style-5 input[type="submit"]:hover,
    .form-style-5 input[type="button"]:hover
    {
        background: #1e88e5;
    }
</style>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h4>
            User
        </h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Med</a></li>
            <li class="breadcrumb-item"><a href="#">Admins</a></li>
            <li class="breadcrumb-item active">New</li>
        </ol>
    </section>

@include('flash::message')
<!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        &nbsp;&nbsp; <h4>Create New Admin</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-style-5">
                            {{--  @include('flash::message')--}}
                            {!! Form::open(array('url' => route('admins.store'))) !!}
                            <fieldset>
                                <legend><span class="number">1</span> User Info</legend>
                                {{-- <input type="text" name="field1" placeholder="Your Name *">--}}
                                @if($errors->first('name'))
                                    <b style="color: red;">{{$errors->first('name')}}<br></b>
                                @endif
                                {!! Form::text('name', '', array('placeholder'=>'Your Name *','class' => 'form-control')) !!}

                                @if($errors->first('email'))
                                    <b style="color: red;">{{$errors->first('email')}}<br></b>
                                @endif
                                {!! Form::email('email', '', array('placeholder'=>'Your Email *','class' => 'form-control')) !!}

                                @if($errors->first('user_name'))
                                    <b style="color: red;">{{$errors->first('user_name')}}<br></b>
                                @endif
                                {!! Form::text('user_name', '', array('placeholder'=>'Your UserName *','class' => 'form-control')) !!}

                                @if($errors->first('password'))
                                    <b style="color: red;">{{$errors->first('password')}}<br></b>
                                @endif
                                {!! Form::password('password', array('placeholder'=>'Your Password *','class' => 'form-control')) !!}
                                {!! Form::password('password_confirmation', array('placeholder'=>'Confirm Password *','class' => 'form-control')) !!}

                            </fieldset>
                            <fieldset>
                                <legend><span class="number">2</span> Role Info</legend>
                                @if($errors->first('roles'))
                                    <b style="color: red;">{{$errors->first('roles')}}<br><br></b>
                                @endif
                                @foreach ($roles as $role)
                                    {{--{!! Form::checkbox('roles[]',  $role->id ) !!}--}}
                                    <input type="checkbox" id="{{$role->name}}" name="roles[]" value="{{$role->id}}">

                                    {!! Form::label($role->name, ucfirst($role->name)) !!}<br>
                                @endforeach
                            </fieldset>
                            {{--<input type="submit" value="Apply" />--}}
                            {!! Form::submit('Register', array('class' => 'btn1')) !!}
                            {!! Form::close() !!}
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>





















{{--

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Users
                        <small class="text-muted">Welcome to F-boxx</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> F-boxx</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">User Management</a></li>
                        <li class="breadcrumb-item active">CreateUser</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><i class='fa fa-user-plus'></i> Create User</h2>
                            <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="form-style-5">
                              --}}{{--  @include('flash::message')--}}{{--
                                {!! Form::open(array('url' => 'users')) !!}
                                    <fieldset>
                                        <legend><span class="number">1</span> User Info</legend>
                                       --}}{{-- <input type="text" name="field1" placeholder="Your Name *">--}}{{--
                                        @if($errors->first('name'))
                                            <b style="color: red;">{{$errors->first('name')}}<br></b>
                                        @endif
                                        {!! Form::text('name', '', array('placeholder'=>'Your Name *','class' => 'form-control')) !!}

                                        @if($errors->first('email'))
                                            <b style="color: red;">{{$errors->first('email')}}<br></b>
                                        @endif
                                        {!! Form::email('email', '', array('placeholder'=>'Your Email *','class' => 'form-control')) !!}

                                        @if($errors->first('user_name'))
                                            <b style="color: red;">{{$errors->first('user_name')}}<br></b>
                                        @endif
                                        {!! Form::text('user_name', '', array('placeholder'=>'Your UserName *','class' => 'form-control')) !!}

                                        @if($errors->first('password'))
                                            <b style="color: red;">{{$errors->first('password')}}<br></b>
                                        @endif
                                        {!! Form::password('password', array('placeholder'=>'Your Password *','class' => 'form-control')) !!}
                                        {!! Form::password('password_confirmation', array('placeholder'=>'Confirm Password *','class' => 'form-control')) !!}

                                    </fieldset>
                                    <fieldset>
                                        <legend><span class="number">2</span> Role Info</legend>
                                        @if($errors->first('roles'))
                                            <b style="color: red;">{{$errors->first('roles')}}<br><br></b>
                                        @endif
                                        @foreach ($roles as $role)
                                            --}}{{--{!! Form::checkbox('roles[]',  $role->id ) !!}--}}{{--
                                            <input type="checkbox" id="{{$role->name}}" name="roles[]" value="{{$role->id}}">

                                            {!! Form::label($role->name, ucfirst($role->name)) !!}<br>
                                        @endforeach
                                    </fieldset>
                                    --}}{{--<input type="submit" value="Apply" />--}}{{--
                                {!! Form::submit('Register', array('class' => 'btn1')) !!}
                                {!! Form::close() !!}
                            </div>
--}}{{--

                            {!! Form::open(array('url' => 'users')) !!}
                            <div class="form-group @if ($errors->has('name')) has-error @endif">
                                {!! Form::label('name', 'Name') !!}
                                {!! Form::text('name', '', array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group @if ($errors->has('email')) has-error @endif">
                                {!! Form::label('email', 'Email') !!}
                                {!! Form::email('email', '', array('claass' => 'form-control')) !!}
                            </div>
                            <div class="form-group @if ($errors->has('roles')) has-error @endif">
                                @foreach ($roles as $role)
                                    {!! Form::checkbox('roles[]',  $role->id ) !!}
                                    {!! Form::label($role->name, ucfirst($role->name)) !!}<br>
                                @endforeach
                            </div>
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {!! Form::label('password', 'Password') !!}<br>
                                {!! Form::password('password', array('class' => 'form-control')) !!}
                            </div>
                            <div class="form-group @if ($errors->has('password')) has-error @endif">
                                {!! Form::label('password', 'Confirm Password') !!}<br>
                                {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
                            </div>
                            {!! Form::submit('Register', array('class' => 'btn btn-primary')) !!}
                            {!! Form::close() !!}--}}{{--
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>--}}
@stop
