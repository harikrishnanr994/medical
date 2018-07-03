@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    
    !-- Bootstrap Markdown -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap-markdown-master/css/bootstrap-markdown.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">
    <style>

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color:  #d2d9dd;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #151313 !important;
        }
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
        .form-style-5 input[type="text"],
        .form-style-5 input[type="date"],
        .form-style-5 input[type="datetime"],
        .form-style-5 input[type="email"],
        .form-style-5 input[type="password"],
        .form-style-5 input[type="number"],
        .form-style-5 input[type="search"],
        .form-style-5 input[type="time"],
        .form-style-5 input[type="url"],
        .form-style-5 input[type="file"],
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

        .form-style-5 input[type="submit"],
        .form-style-5 input[type="button"],
        .btn1
        {
            position: relative;
            padding: 10px 30px 10px 30px;
            color: #FFF;
            margin: 0 auto;
            background: #1abc9c;
            font-size: 11px;
            text-align: center;
            font-style: normal;
            width: 75%;
            border: 10px solid #16a085;
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
                Settings
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item active">Setting</li>
            </ol>
        </section>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">

                        <div class="box-header with-border">
                            <h6 class="box-subtitle">Setting Details</h6>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- Tab links -->
                        <div class="box-body wizard-content">
                            <form id="dropzone_from" name=coupon_form action="{{route('admin.setting.store')}}"  class="tab-wizard wizard-circle" method="get" enctype="multipart/form-data">
                            {{csrf_field()}}

                                <div class="row">
                                    <div class="col-md-2">
                                        Box purchasing last date :
                                    </div>
                                    <div class="col-md-3 input-group">
                                        
                                        <select name="box_purchasing_last_date">
                                            <option>--SELECT--</option>
                                        <?php 
                                        for($i=1; $i<=28; $i++) {
                                            echo '<option value="'.$i.'" '.($purchase_date->value==$i ? 'selected' : null).'>'.$i.'</option>';
                                        }
                                        ?> 
                                        <option name="box_purchasing_last_date"> </option>   
                                        </select> 
                                        
                                    </div>

                                    <div class="col-md-2">
                                        Box customization last date :
                                    </div>
                                    <div class="col-md-3 input-group">
                                        
                                        <select name="box_customization_last_date">
                                            <option>--SELECT--</option>
                                        <?php 
                                        for($i=1; $i<=28; $i++) {
                                            echo '<option value="'.$i.'" '.($custom_date->value==$i ? 'selected' : null).'>'.$i.'</option>';
                                        }
                                        ?> 
                                        <option name="box_customization_last_date"> </option>   
                                        </select>

                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-md-2">
                                        Box holding last date :
                                    </div>
                                    <div class="col-md-3 input-group">
                                        
                                        <select name="box_holding_last_date">
                                            <option>--SELECT--</option>
                                        <?php 
                                        for($i=1; $i<=28; $i++) {
                                            echo '<option value="'.$i.'" '.($hold_date->value==$i ? 'selected' : null).'>'.$i.'</option>';
                                        }
                                        ?> 
                                        <option name="box_holding_last_date"> </option>   
                                        </select>

                                    </div>

                                    <div class="col-md-2">
                                        Box cancellation last date :
                                    </div>
                                    <div class="col-md-3 input-group">

                                        <select name="box_cancellation_last_date">
                                            <option>--SELECT--</option>
                                        <?php 
                                        for($i=1; $i<=28; $i++) {
                                            echo '<option value="'.$i.'" '.($cancel_date->value==$i ? 'selected' : null).'>'.$i.'</option>';
                                        }
                                        ?> 
                                        <option name="box_cancellation_last_date"> </option>   
                                        </select>

                                    </div>
                                    <div class="col-md-3 input-group">
                                    </div>
                                    <div class="col-md-3 input-group">

                                       <div class="col-xs-5 text-center col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-8 col-md-offset-2">
                                            <input class="btn1" type="submit" value="Change">
                                        </div> 

                                    </div>

                                    <!-- <div class="row"> -->
                                        
                                    <!-- </div> -->
                                </div><br>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>

@stop
@section('javascript')

    <!-- Bootstrap markdown -->
    <script src="{{ asset('admin/assets/vendor_components/bootstrap-markdown-master/js/bootstrap-markdown.js')}}"></script>

    <!-- marked-->
    <script src="{{ asset('admin/assets/vendor_components/marked/marked.js')}}"></script>
    
    <!-- to markdown -->
    <script src="{{ asset('admin/assets/vendor_components/to-markdown/to-markdown.js')}}"></script>
    
    <script src="{{ asset('admin/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
    <script src="{{ asset('admin/js/pages/advanced-form-element.js')}}"></script>

@endsection

