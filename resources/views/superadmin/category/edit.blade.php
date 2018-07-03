@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">
    <style>


        /*category model*/
        input[type="file"] {

            display:block;
        }
        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            margin: 10px 10px 0 0;
            padding: 1px;
        }
        .cat-img{
            height: 100%;
            float: left;
        }


        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color:  #d2d9dd;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #151313 !important;
        }
        .form-style-5{
            max-width: 700px;
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
        .form-style-5 input[type="checkbox"]:focus,
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
            background: #109177;
        }
        .cat-img{
            height: 100%;
            float: left;
        }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Category
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">Create</li>
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

{{--
                        @if(!$category_used)
--}}
                            <div class="box-body">
                                <form class="form-style-5" action="{{route('category.nonEdit.update',$id)}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    {{--  @include('flash::message')--}}
                                    <fieldset>
                                        <legend><span class="number">1</span> Category Info</legend>

                                        @if($errors->first('name'))
                                            <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('name')}}<br></b>
                                        @endif
                                        <input type="text" name="name" placeholder="Category Name *" value="{{ $datas->name }}"  class="form-control" required>




                                        <div class="row">
                                            <div class="col-md-5">

                                                Category Image
                                                [ <span class="text-muted">Dimension 296 x 400</span>]

                                                <input type="file" id="file" name="image" placeholder="Category Image *" class="form-control" accept="image/*" onchange="readURL(this);" >
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-5">

                                                Category Icon
                                                [ <span class="text-muted">Dimension 179 x 179</span>]

                                                <input type="file" id="file2" name="image2" placeholder="Category Icon Image *" class="form-control" accept="image/*" onchange="readURL2(this);" >

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-5">
                                                @if($errors->first('image'))
                                                    <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('image')}}<br></b>
                                                @endif
                                                <div class="lib_image_holder">
                                                    <div id="pic" class="form-group">
                                                        {{-- <img id="blah" src="#" alt=" no image choosen" />--}}
                                                        @if($datas->image!='')
                                                            <img id="blah" src="{{asset('images/'.$datas->image )}}" alt=" no image choosen" width="150 px" height="100 px"/>
                                                        @else
                                                            <img id="blah" src="{{asset('images/noimage.png' )}}" width="150" height="100" alt=" no image choosen" />

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">

                                            </div>
                                            <div class="col-md-5">
                                                @if($errors->first('image2'))
                                                    <b style="color: red;">Icon field is required<br></b>
                                                @endif
                                                <div class="lib_image_holder">
                                                    <div id="pic2" class="form-group">
                                                        {{-- <img id="blah2" src="#" alt=" no image choosen" />--}}
                                                        @if($datas->icon!='')
                                                            <img id="blah2" src="{{asset('images/'.$datas->icon )}}" alt=" no image choosen" width="150 px" height="100 px"/>
                                                        @else
                                                            <img id="blah2" src="{{asset('images/noimage.png' )}}" width="150" height="100" alt=" no image choosen" />

                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>



                                    </fieldset>

                                    <fieldset>
                                        <legend><span class="number">2</span> Parent Info</legend>
                                        @if($errors->first('roles'))
                                            <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('categories')}}<br><br></b>
                                        @endif


{{--
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">- -Choose Parent- -</button>
--}}
                                        <input type="text" name="parent_id" id="parent" value="{{ $datas->parent_id}}" hidden>
                                        <br>
                                        <input type="text" name="parent_name" id="parent_name" value="{{">> ". $datas->parent_text }}" placeholder="--Parent name--" readonly>
                                    </fieldset>
                                    @if($errors->first('specification_titles'))
                                        <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('specification_titles')}}<br><br></b>
                                    @endif


                                    <div id="fieldset_spec" @if(!$spec) style="display: none"@endif>
                                        <fieldset>
                                            <legend><span class="number">3</span> Spec Titles</legend>



                                            <div class="row">
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="checkbox" @if($spec)  checked @endif default>
                                                    <label for="last_child">Last Child Category? </label>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="checkbox"  default>
                                                    <label for="not_a_last_child">Not Last Child Category? </label>
                                                </div>
                                            </div>


                                            <div id="spec"  @if(!$spec) style="display: none" @endif>
                                                &nbsp;<i style="color: red;">[ If the category is a last child category ]</i>
                                                <input type="text" name="" id="" placeholder="Add specification titles *" class="form-control bootstrap-tagsinput" value="{{$spec}}" default>
                                            </div>

                                        </fieldset>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit" class="btn1">Update</button>
                                    </div>

                                </form>
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
    <script>




        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(100);
                };
                $('#pic').show();
                reader.readAsDataURL(input.files[0]);
            }
        }


        var _URL = window.URL || window.webkitURL;

        $("#file").change(function(e) {
            var image, file;
            if ((file = this.files[0])) {

                image = new Image();
                image.onload = function() {
                    if ((this.width != 296 && this.height != 400))
                    {
                        alert("Image Dimension should be 296x400");
                        $("#file").val('');
                        $( "#pic").load(window.location.href + " #pic" );
                    }
                };
                image.src = _URL.createObjectURL(file);
            }
        });

        var _URL = window.URL || window.webkitURL;
        $("#file2").change(function(e) {

            var image, file;

            if ((file = this.files[0])) {

                image = new Image();
                image.onload = function() {
                    if ((this.width != 179 && this.height != 179))
                    {
                        alert("Image Dimension should be 179x179");
                        $("#file2").val('');
                        $( "#pic2" ).load(window.location.href + " #pic2" );
                        //$('#img_err').show();
                    }
                };
                image.src = _URL.createObjectURL(file);

            }

        });


        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah2')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(100);
                };
               // $('#pic2').show();
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#file2").change(function(e) {

            var image, file;

            if ((file = this.files[0])) {

                image = new Image();
                /*
                                image.onload = function() {
                                    if ((this.width != '296' )&& (this.height != '400' )) {
                                        alert("Image Dimension should be 296x400");
                                        $("#file").val('');
                                        $('#pic').hide();
                                        //$('#img_err').show();
                                    }
                                };*/
                image.src = _URL.createObjectURL(file2);

            }

        });


    </script>
@endsection

