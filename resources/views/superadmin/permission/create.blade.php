{{-- \resources\views\permissions\index.blade.php --}}

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <style>


        .form-style-5{
            max-width: 500px;
            padding: 10px 20px;
            background: #f4f7f8;
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
            background: #1abc9c;
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
            background: #1abc9c;
            font-size: 18px;
            text-align: center;
            font-style: normal;
            width: 100%;
            border: 1px solid #16a085;
            border-width: 1px 1px 3px;
            margin-bottom: 10px;
        }
        .form-style-5 input[type="submit"]:hover,
        .form-style-5 input[type="button"]:hover
        {
            background: #109177;
        }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Permissions
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">UserManagement</a></li>
                <li class="breadcrumb-item active">Permission</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-style-5">
                                {{ Form::open(['url' => route('permissions.store')]) }}
                                <fieldset>
                                    <legend><span class="number">1</span>Permission</legend>
                                    @if($errors->first('name'))
                                        <b style="color: red;">{{$errors->first('name')}}<br></b>
                                    @endif
                                    {{ Form::text('name', '', array('placeholder' => 'Permission Name','class' => 'form-control')) }}
                                </fieldset>
                                <fieldset>
                                    @if(!$roles->isEmpty())
                                        <legend><span class="number">2</span>Assign Permissions to Roles</legend>
                                        @foreach ($roles as $role)
                                            {{-- {{ Form::checkbox('roles[]',  $role->id ) }}--}}
                                            <input type="checkbox" id={{$role->name}} name="roles[]" value={{$role->id}}>

                                            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                        @endforeach
                                    @endif
                                </fieldset>
                                {{ Form::submit('Save', array('class' => 'btn1')) }}
                                {{ Form::close() }}
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
                    <h2>Create New Permission
                        <small class="text-muted">Welcome to F-boxx</small>
                    </h2>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> F-boxx</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">UserManagement</a></li>
                        <li class="breadcrumb-item active">NewPermission</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Input -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header"> <div class="body">
                                <h2 class="card-inside-title"></h2>

                                <div class="form-style-5">
                                    {{ Form::open(array('url' => 'permissions')) }}
                                    <fieldset>
                                        <legend><span class="number">1</span>Permission</legend>
                                        @if($errors->first('name'))
                                            <b style="color: red;">{{$errors->first('name')}}<br></b>
                                        @endif
                                        {{ Form::text('name', '', array('placeholder' => 'Permission Name','class' => 'form-control')) }}
                                    </fieldset>
                                    <fieldset>
                                        @if(!$roles->isEmpty())
                                            <legend><span class="number">2</span>Assign Permissions to Roles</legend>
                                            @foreach ($roles as $role)
                                                --}}{{-- {{ Form::checkbox('roles[]',  $role->id ) }}--}}{{--
                                                <input type="checkbox" id={{$role->name}} name="roles[]" value={{$role->id}}>

                                                {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                            @endforeach
                                        @endif
                                    </fieldset>
                                    {{ Form::submit('Save', array('class' => 'btn1')) }}
                                    {{ Form::close() }}
                                </div>
                        </div>


                            --}}{{--<div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="name" class="card-inside-title">PERMISSION</label>
                                                {{ Form::open(array('url' => 'permissions')) }}
                                                           {{ Form::text('name', '', array('class' => 'form-control')) }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-line">
                                           @if(!$roles->isEmpty())
                                                <label for="name" class="card-inside-title">Assign Permission to Roles</label>
                                                      @foreach ($roles as $role)
                                                          {{ Form::checkbox('roles[]',  $role->id ) }}
                                                          {{ Form::label($role->name, ucfirst($role->name)) }}<br>
                                                      @endforeach
                                                  @endif

                                        </div>
                                    </div>
                                </div>
                            </div>--}}{{--
                        </div>

                    </div>
                </div>
            </div>
            <!-- #END# Input -->

        </div>
    </section>--}}
    @endsection