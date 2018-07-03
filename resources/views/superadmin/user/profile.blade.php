@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- Bootstrap Markdown -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/bootstrap-markdown-master/css/bootstrap-markdown.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">



    <style>

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color:#a9c9f3;;
            border-color: #367fa9;
            padding: 1px 10px;
            color: #151313 !important;
        }
        input[type="file"] {

            display:block;
        }
        .imageThumb {
            max-height: 75px;
            border: 2px solid;
            margin: 10px 10px 0 0;
            padding: 1px;
        }


        .thumb {
            width:100px;
            height: 100px;
            margin: 0.2em -0.7em 0 0;
        }
        .remove_img_preview {
            position:relative;
            top:-25px;
            right:5px;
            background:black;
            color:white;
            border-radius:50px;
            font-size:0.9em;
            padding: 0 0.3em 0;
            text-align:center;
            cursor:pointer;
        }
        .remove_img_preview:before {
            content: "×";
        }
        .btn-default{
            display: none;
        }
    </style>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Vendor Profile
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Vendor</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-12">
                    @include('flash::message')
                    <form id="myform" action="{{route('admin.profile.store',$id)}}" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="box">
                            <div class="box-header with-border">
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Vendor Name :</label>
                                            @if($errors->first('name'))
                                                <br><b style="color: red;">{{$errors->first('name')}}<br></b>
                                            @endif
                                            <input type="text" class="form-control" name="name" id="name" value="{{$details['name']}}" placeholder="  Enter Vendor Name *" readonly required>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group"  id="athira">
                                            <label>Choose Categories :</label>
                                            @if($errors->first('category'))
                                                <br><b style="color: red;">{{$errors->first('category')}}<br></b>
                                            @endif
                                            <?php
                                            if(count($profile))
                                            {
                                                $arr=explode(",",$profile['categories']);
                                                for($i=0;$i<count($arr);$i++)
                                                {
                                                    $new_arr[$i]=$arr[$i];
                                                }
                                            }
                                            else
                                            {
                                                $new_arr=array();
                                            }
                                            ?>
                                            <select  class="form-control select2" multiple="multiple" id="my-select" name="category[]" data-placeholder="Select a State" style="width: 100%;" required>

                                                @foreach($categories as $category)
                                                    @if(in_array($category->id,$new_arr))
                                                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                                    @else
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image : </label>


                                            <div id="dvPreview">
                                                @if($profile)
                                                <input type="file" id="files" name="image" placeholder="Vendor Image *" class="form-control" accept="image/*">
                                                    @if($profile['image']!='')
                                                        <img src="{{asset('images/'.$profile['image'] )}}" width="150" height="150">
                                                    @else
                                                        <img id="blah" src="{{asset('images/noimage.png' )}}" width="150" height="150">
                                                    @endif

                                                @else

                                                    <img id="blah" src="{{asset('images/noimage.png' )}}" width="150" height="150" alt=" no image choosen" />
                                                @endif

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description : </label>
                                            @if($errors->first('description'))
                                                <br><b style="color: red;">Description is required<br></b>
                                            @endif

                                            <div class="example example-responsive">
                                            {{--<textarea data-provide="markdown" data-iconlibrary="fa" data-width="400" name="description" required>


                                            </textarea>--}}
                                                <textarea name="description1" >@if($profile){{$profile->description}}@endif</textarea>
                                                <script>
                                                    CKEDITOR.replace( 'description1' );
                                                </script>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-danger" >Submit</button>
                            </div>
                        </div>
                        <!-- /.box -->
                    </form>
                </div>
            </div>
        </section>
    </div>


























@stop
@section('javascript')


    <script>
        $(document).ready(function() {

            if(window.File && window.FileList && window.FileReader) {
                $("#files").on("change",function(e) {
                    var files = e.target.files ,
                        filesLength = files.length ;
                    for (var i = 0; i < filesLength ; i++) {
                        var f = files[i]
                        var fileReader = new FileReader();
                        fileReader.onload = (function(e) {
                            $('#dvPreview').html();
                            $('#blah').hide();
                            var file = e.target;
                            $("<img></img>",{
                                class : "imageThumb",
                                src : e.target.result,
                                title : file.name
                            }).insertAfter("#files");
                        });
                        fileReader.readAsDataURL(f);
                    }
                });
            } else { alert("Your browser doesn't support to File API") }
        });

    </script>

    {{--<script>
        $('#my-select').multiSelect();
    </script>--}}
    <script>
        /* ('#myform').submit(function(e)*/
        function validation()
        {
            var details=$('#details').val();
            var image=$('#file').val();
            var id='<?php echo $id;?>';

            if(details=='')
            {
                $.notify("Enter the details","error");
                setTimeout(function() {
                    test();
                }, 1000)
                return false;
            }
            else if(image=='')
            {
                //alert('hi');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'text',
                    type:'post',
                    url:'{{ route('admin.profile.checkImage') }}',
                    data:{id:id},
                    success:function(res){

                        if(res!='true')
                        {
                            alert('dont submit');

                            // e.preventDefault(); // Cancel the submit
                            //  return false; // Exit the .each loop
                            $.notify("Please choose an image","error");
                            return false;

                        }
                        else
                        {
                            return true;
                        }

                    },
                    error:function(res){
                        alert('hello')
                        $.notify("Please choose an image","error");
                        setTimeout(function() {
                        }, 1000);

                        return false;
                    }

                });
            }
            else
            {
                return true;
            }
            // $("#myform").validate();
        }


    </script>
    <!-- Bootstrap markdown -->
    <script src="{{ asset('admin/assets/vendor_components/bootstrap-markdown-master/js/bootstrap-markdown.js')}}"></script>

    <!-- marked-->
    <script src="{{ asset('admin/assets/vendor_components/marked/marked.js')}}"></script>

    <!-- to markdown -->
    <script src="{{ asset('admin/assets/vendor_components/to-markdown/to-markdown.js')}}"></script>


    <script src="{{ asset('admin/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
    <script src="{{ asset('admin/js/pages/advanced-form-element.js')}}"></script>

@endsection
