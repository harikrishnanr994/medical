@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_plugins/bootstrap-slider/slider.css')}}">

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Slider Mobile
            </h4>

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Slider</a></li>
                <li class="breadcrumb-item active">Mobile</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"></h3>

                            <?php $msg = Session::get('msg'); ?>

                            @if(isset($msg) && $msg == "failed")
                                <div class="alert alert-danger alert-dismissable col-lg-4" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-exclamation-circle"></i>  Failed
                                </div>
                            @endif
                            @if(isset($msg) && $msg == "success")
                                <div class="alert alert-success alert-dismissable col-lg-4" style="text-align: center;">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-check-circle"></i>   Success
                                </div>
                            @endif

                            <?php $request->session()->forget('msg'); ?>


                            <div class="box-tools pull-right">
                                <button  class="btn btn-sm   bg-primary" data-toggle="modal" data-target="#modal-center">
                                   <i class="fa fa-plus"></i> &nbsp; Create New
                                </button>
                            </div>


                        </div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs nav-tabs-light-mode" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#home1" role="tab" aria-expanded="true">All Slides</a>
                            </li>

                        </ul>


                        <!-- Tab panes -->
                        <div class="box-body tab-content">
                            <div class="tab-pane fade active show" id="home1" aria-expanded="true">
                                <div class="col-md-6 col-lg-10">
                                    <table class="table table-responsive table-borderless table-hover">
                                        <thead>
                                        <th>Page Type</th>
                                        <th  style="text-align: center;">Start Date</th>
                                        <th  style="text-align: center;">End Date</th>
                                        <th  style="text-align: center;">Image</th>
                                        <th  style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Action</th>
                                        </thead>
                                        @foreach($sliders as $slider)
                                            <tr>
                                                <td>  @if($slider->page=="product_detail")
                                                        {{ "Product Detail"  }}
                                                    @else
                                                        {{ "Product List" }}
                                                    @endif</td>
                                                <td  style="text-align: center;">{{ $slider->start_date }}</td>
                                                <td  style="text-align: center;">{{ $slider->expiry_date }}</td>
                                                <td  style="text-align: center;"><img src="{{asset('images/'.$slider->image )}}"  width="100" height="30"></td>
                                                <td  style="text-align: center;">
                                                    <?php $currentDate = date('Y-m-d') ?>
                                                    @if($currentDate >  $slider->expiry_date)
                                                        <label for="status" class="bg-warning" style="width: 70px; text-align: center;">Expired</label>
                                                    @else
                                                        <label for="status" class="bg-success" style="width: 70px; text-align: center;">Active</label>
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ route('admin.slider.mobile.view', $slider->id) }}" class="btn btn-info btn-sm">View</a>
                                                    <a href="{{ route('admin.slider.delete', $slider->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <ul class="pagination">{{ $sliders->links() }} </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>




    <!-- Modal -->
    <div class="modal  fade" id="modal-center" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Slide</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="col-6" >
                            <div class="form-group">
                                <label>Page Type</label>
                                <select class="form-control  type" style="width: 100%;"  >
                                    <option hidden>Select Page Type</option>
                                    <option value="listing">Product Listing</option>
                                    <option value="detail">Product Detail</option>
                                </select>
                            </div>
                        </div>


                        <!-- box product list form -->
                        <div class="row listSec" style="display: none;">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-header with-border" style="background-color: #d2d7e0;">
                                        <i class="fa fa-list text-black"></i>
                                        <h3 class="box-title">PRODUCT LISTING</h3>
                                    </div>

                                    <div class="box-body">
                                        <form role="form" id="listForm" method="post" action="{{ route('admin.slider.mobile.save') }}" enctype="multipart/form-data" >
                                            {{ csrf_field() }}

                                            <div class="row" >
                                                <div class="col-12">
                                                    <div class="box">
                                                        <div class="box-body">
                                                            <div class="previewImg" id="previewImg">
                                                            </div>
                                                            <div class="form-group"  style="text-align: center;">
                                                                <div class="btn bg-pink btn-file">
                                                                    <i class="fa fa-cloud-upload"></i> Upload Image
                                                                    <input type="file"  id="listImg" name="listImg" accept="image/*"  required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group col-7">
                                                <input type="text" class="form-control col-6"name="page_type" value="product_list" required style="display: none;">&nbsp;&nbsp;&nbsp;

                                            </div>

                                            <div class="form-group col-7">
                                                <label>Category</label>
                                                <select type="text" class="select2 col-4" style="width: 100%;" name="category" required>
                                                    <option hidden>Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->name }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group col-7">
                                                <label>Brand</label>
                                                <select type="text" class="select2 col-4" multiple="multiple" name="brand[]" data-placeholder="Select Brand"
                                                        style="width: 100%;" required>
                                                    @foreach($brands as $brand)
                                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>


                                            <div class="form-group col-7">
                                                <label>Discount in %</label>
                                                <input type="text" value="" class="slider form-control" data-slider-min="0" data-slider-max="100"
                                                       data-slider-step="1" data-slider-value="[0,100]" data-slider-orientation="horizontal"
                                                       data-slider-selection="before" data-slider-tooltip="show"  data-slider-id="red">
                                                <div class="input-group">
                                                    <input type="text" id="min" class="form-control col-6" placeholder="Min in %" name="min_amount" required> &nbsp;&nbsp;&nbsp;
                                                    <input type="text" id="max" class="form-control col-6" placeholder="Max in %" name="max_amount" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Start Date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker" name="start_date1" required>
                                                    </div>
                                                </div>


                                                <div class=" col-4">
                                                    <label>Expiry Date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker2" name="end_date1" required>
                                                    </div>
                                                </div>

                                            </div>


                                            <div class="form-group">
                                                <div class="text-xs-right pull-right">
                                                    <button type="submit" class="btn  bg-primary">Submit</button>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- box product detail form -->
                        <div class="row detailSec" style="display: none;">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-header with-border" style="background-color: #d2d7e0;">
                                        <i class="fa fa-check-square-o text-black"></i>
                                        <h3 class="box-title">PRODUCT DETAIL</h3>
                                    </div>

                                    <div class="box-body">
                                        <form  id="detailForm" method="post" action="{{ route('admin.slider.mobile.save') }}" enctype="multipart/form-data">
                                            {{ csrf_field() }}

                                            <div class="row" >
                                                <div class="col-12">
                                                    <div class="box">
                                                        <div class="box-body">
                                                            <div class="previewImg" id="previewImg1">
                                                            </div>
                                                            <div class="form-group"  style="text-align: center;">
                                                                <div class="btn bg-pink btn-file">
                                                                    <i class="fa fa-cloud-upload"></i> Upload Image
                                                                    <input type="file"  id="detailImg" name="detailImg" accept="image/*"  multiple required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group col-7">
                                                <input type="text" class="form-control col-6" name="page_type" value="product_detail" required style="display: none;">&nbsp;&nbsp;&nbsp;

                                            </div>

                                            <div class="form-group">
                                                <label>Slug</label>
                                                <select class="form-control select2 slug" style="width: 50%;"  name="slug" onkeypress="getProduct()" required>
                                                </select>
                                                {{--<input type="text" class="form-control" placeholder="Slug" name="slug" required>--}}
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-4">
                                                    <label>Start Date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker3" name="start_date2" required>
                                                    </div>
                                                </div>


                                                <div class=" col-4">
                                                    <label>Expiry Date</label>
                                                    <div class="input-group date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control pull-right" id="datepicker4" name="end_date2" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="text-xs-right pull-right">
                                                    <button type="submit" class="btn bg-primary">Submit</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->








@stop

@section('javascript')
    <script src="{{ asset('admin/js/notify.js') }}"></script>
    <script src="{{ asset('admin/js/select2.full.js') }}"></script>
    <script src="{{ asset('admin/js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
    <script>
        $(function () {
            /* BOOTSTRAP SLIDER */
            $('.slider').slider()
            $(".slider").on("slide", function(slideEvt) {
                var values =slideEvt.value;
                $("#min").val(values[0]);
                $("#max").val(values[1]);
            });
        });

    </script>
    <script>  $( function() {
            $( "#datepicker" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker2" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker3" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker4" ).datepicker({ format: "yyyy-mm-dd"});
        });</script>
    <script>
        $('.type').on('change', function () {
            var type =  $('.type :selected').val();
            if(type=="listing"){
                $('.detailSec').hide();
                $('.listSec').fadeIn();
            }else if(type=="detail"){
                $('.listSec').hide();
                $('.detailSec').fadeIn();
            }
        });

        var _URL = window.URL || window.webkitURL;
        $("#listImg").on("change",function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
            //if(this.width == 960 && this.height == 460) {
                $(".imageThumb").remove();
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<img></img>", {
                            class: "imageThumb",
                            src: e.target.result,
                            title: file.name,
                            width: 200,
                            height: 150
                        }).insertAfter("#previewImg");
                    });
                    fileReader.readAsDataURL(f);
                }
          /*  }else{
                $.notify("Please upload image with dimension 960 X 460");
                $("#listImg").val('');

            }*/
        };
        img.src = _URL.createObjectURL(file);
        }
        });

        var _URL = window.URL || window.webkitURL;

        $("#detailImg").on("change",function(e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
          //  if(this.width == 960 && this.height == 460) {
                $(".imageThumb1").remove();
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<img></img>", {
                            class: "imageThumb1",
                            src: e.target.result,
                            title: file.name,
                            width: 200,
                            height: 150
                        }).insertAfter("#previewImg1");
                    });
                    fileReader.readAsDataURL(f);
                }
         /*   }else{
                $.notify("Please upload image with dimension 960 X 460");
                $("#detailImg").val('');
            }*/
                };
                img.src = _URL.createObjectURL(file);
            }
        });

        $(document).ready(function (e) {
            setTimeout(function() {
                $('.alert').fadeOut();
            }, 2000);

        });


        function getProduct(str) {
            var string = str.value;
            // alert(string);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'text',
                type: 'get',
                data:{string:string},
                url: '{{ route('admin.slider.getSlug') }}',
                success: function (res) {
                    //alert(res);

                    var obj = jQuery.parseJSON(res);
                    var limit = obj.length;

                    if (limit != 0) {
                        //$('#emp').empty();
                        for (var i = 0; i < limit; i++) {
                            var opt = '<option></option><option value="' + obj[i].slug + '">' + obj[i].name + '</option>';
                            addoption(opt);

                        }
                    }
                }

            });


        }

        function  addoption(opt)
        {
            $(".slug").append(opt);
        }



    </script>

@endsection