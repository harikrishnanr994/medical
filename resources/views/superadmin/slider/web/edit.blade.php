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
                Slider Web
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Slider</a></li>
                <li class="breadcrumb-item active">Web</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
                     <section class="content">

                                @foreach($datas as $data)
                                    @if($data->page == "product_list")
                                <div class="col-md-6 col-lg-10">
                                    <!-- box product list form -->
                                    <div class="row listView">
                                        <div class="col-12">
                                            <div class="box">
                                                <div class="box-body">
                                                    <div class="row">
                                                        <div class="form-group col-6">
                                                            <label>Category</label>
                                                            <p>{{ $data->category }}</p>
                                                        </div>

                                                        <div class="form-group col-6">
                                                            <label>Brand</label>
                                                            <p>{{ $data->brands }}</p>
                                                        </div>

                                                    </div>

                                            <div class="row">

                                                <div class="form-group col-6">
                                                        <label>Discount Min</label>
                                                        <p>{{ $data->discount_min }} %</p>
                                                </div>
                                                <div class="form-group col-6">
                                                        <label> DiscountMax</label>
                                                         <p>{{ $data->discount_max }} %</p>

                                                </div>
                                            </div>


                                                        <div class="row">
                                                            <div class="form-group col-6">
                                                                <label>Start Date</label>
                                                             <p>{{ $data->start_date }}</p>
                                                            </div>


                                                            <div class="form-group col-6">
                                                                <label>Expiry Date</label>
                                                            <p>{{ $data->expiry_date }}</p>
                                                            </div>
                                                        </div>


                                                            <div class="row" >
                                                                <div class="col-6">
                                                                            <div>
                                                                                <img src="{{asset('images/'.$data->image )}}" alt="" width="300" height="150">
                                                                            </div>
                                                                </div>

                                                            </div>


                                                        <div class="form-group">
                                                            <div class="text-xs-right pull-right">
                                                                <button  class="btn btn-sm btn-square bg-primary listEdit" >Edit</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                   @else

                             <!-- box product detail form -->
                                 <div class="row detailView">
                                     <div class="col-12">
                                         <div class="box">
                                             <div class="box-header with-border" style="background-color: #d2d7e0;">
                                                 <i class="fa fa-check-square-o text-black"></i>
                                                 <h3 class="box-title">PRODUCT DETAIL</h3>
                                             </div>

                                             <div class="box-body">



                                                     <div class="form-group col-7">
                                                         <p></p>
                                                     </div>

                                                     <div class="form-group">
                                                         <label>Slug</label>
                                                        <p>{{ $data->slug }}</p>
                                                     </div>


                                                 <div class="row">
                                                     <div class="form-group col-6">
                                                         <label>Start Date</label>
                                                         <p>{{ $data->start_date }}</p>
                                                     </div>


                                                     <div class="form-group col-6">
                                                         <label>Expiry Date</label>
                                                         <p>{{ $data->expiry_date }}</p>
                                                     </div>
                                                 </div>

                                                 <div class="row" >
                                                     <div class="col-6">
                                                         <div>
                                                             <img src="{{asset('images/'.$data->image )}}" alt="" width="300" height="150">
                                                         </div>
                                                     </div>

                                                 </div>


                                                     <div class="form-group">
                                                         <div class="text-xs-right pull-right">
                                                             <button  class="btn btn btn-sm bg-primary detailEdit">Edit</button>
                                                         </div>
                                                     </div>

                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>

                             @endif
                                @endforeach






                                    {{-- edit--}}
                            <div class="col-md-6 col-lg-10">
                                <!-- box product list form -->
                                <div class="row listSec" style="display: none;">
                                    <div class="col-12">
                                        <div class="box">
                                            <div class="box-header with-border" style="background-color: #d2d7e0;">
                                                <i class="fa fa-list text-black"></i>
                                                <h3 class="box-title">Edit Slider</h3>
                                            </div>
                                            @foreach($datas as $data1)
                                            <div class="box-body">
                                                <form role="form" id="listForm" method="post" action="{{ route('admin.slider.web.update',$data1->id) }}" enctype="multipart/form-data" >
                                                    {{ csrf_field() }}

                                                    <div class="row" >
                                                        <div class="col-12">
                                                            <div class="box">
                                                                <div class="box-body">
                                                                    <div class="previewImg" id="previewImg">
                                                                        <img  class="imageThumb" src="{{asset('images/'.$data1->image )}}"  width="300" height="150">
                                                                    </div>
                                                                    <div class="form-group"  style="text-align: center;">
                                                                        <div class="btn bg-pink btn-file">
                                                                            <i class="fa fa-cloud-upload"></i> Change Image
                                                                            <input type="file"  id="listImg" name="listImg" accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group col-7">
                                                        <input type="text" class="form-control col-6"name="page_type" value="product_list" required style="display: none;">&nbsp;&nbsp;&nbsp;
                                                        <input type="text" class="form-control col-6" name="_method"  value="patch"  required style="display: none;">&nbsp;&nbsp;&nbsp;
                                                        <input type="text" class="form-control col-6" name="oldImg"  value="{{ $data1->image }}"  required style="display: none;">&nbsp;&nbsp;&nbsp;

                                                    </div>

                                                    <div class="form-group col-7">
                                                        <label>Category</label>
                                                        <select type="text" class="select2 col-4" style="width: 100%;" name="category" required>
                                                            <option hidden>Select Category</option>
                                                             @foreach($categories as $category)
                                                                 <option value="{{ $category->name }}" @if($category->name==$data1->category){{ "selected" }} @endif>{{ $category->name }}</option>
                                                             @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-7">
                                                        <label>Brand</label>
                                                        <select type="text" class="select2 col-4" multiple="multiple" name="brand[]" data-placeholder="Select Brand"
                                                                style="width: 100%;" required>
                                                            <?php $myBrands = explode(",",$data1->brands); ?>
                                                             @foreach($brands as $brand)
                                                                 <option value="{{ $brand->name }}" @if(in_array($brand->name,$myBrands)){{ "selected" }} @endif >{{ $brand->name }}</option>
                                                             @endforeach

                                                        </select>
                                                    </div>


                                                    <div class="form-group col-7">
                                                        <label>Discount in %</label>
                                                        <input type="text" value="" class="slider form-control" data-slider-min="0"  data-slider-max="100"
                                                               data-slider-step="1" data-slider-value="[{{ $data1->discount_min }},{{ $data1->discount_max }}]" data-slider-orientation="horizontal"
                                                               data-slider-selection="before" data-slider-tooltip="show"  data-slider-id="red">
                                                        <div class="input-group">
                                                            <input type="text" id="min" class="form-control col-6" placeholder="Min in %" name="min_amount" value="{{ $data1->discount_min }}" required style="text-align: center;">&nbsp;&nbsp;&nbsp;
                                                            <input type="text" id="max" class="form-control col-6" placeholder="Max in %" name="max_amount" value="{{ $data1->discount_max }}" required style="text-align: center;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label>Start Date</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="datepicker" name="start_date1" value="{{ $data1->start_date }}" style="text-align: center;" required>
                                                            </div>
                                                        </div>


                                                        <div class=" col-4">
                                                            <label>Expiry Date</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="datepicker2" name="end_date1" value="{{ $data1->expiry_date }}" style="text-align: center;" required>
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="form-group">
                                                        <div class="text-xs-right pull-right">
                                                            <button type="submit" class="btn  bg-primary">Update</button>
                                                        </div>
                                                    </div>

                                                </form>
                                                @endforeach
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
                                                <h3 class="box-title">Edit Slide</h3>
                                            </div>

                                            <div class="box-body">
                                                @foreach($datas as $data2)
                                                <form  id="detailForm" method="post" action="{{ route('admin.slider.web.update',$data2->id) }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="row" >

                                                        <div class="col-12">
                                                            <div class="box">
                                                                <div class="box-body">
                                                                    <div class="previewImg" id="previewImg1">
                                                                        <img  class="imageThumb1" src="{{asset('images/'.$data2->image )}}"  width="300" height="150">
                                                                    </div>
                                                                    <div class="form-group"  style="text-align: center;">
                                                                        <div class="btn bg-pink btn-file">
                                                                            <i class="fa fa-cloud-upload"></i> Change Image
                                                                            <input type="file"  id="detailImg" name="detailImg" accept="image/*"  multiple>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group col-7">
                                                        <input type="text" class="form-control col-6" name="page_type" value="product_detail" required style="display: none;">&nbsp;&nbsp;&nbsp;
                                                        <input type="text" class="form-control col-6" name="_method"  value="patch"  required style="display: none;">&nbsp;&nbsp;&nbsp;
                                                        <input type="text" class="form-control col-6" name="oldImg1"  value="{{ $data2->image }}"  required style="display: none;">&nbsp;&nbsp;&nbsp;
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Slug</label>
                                                        <?php $slugvalue =str_replace("-",' ',$data2->slug);
                                                        ?>
                                                      <!--  <input type="text" class="form-control" placeholder="Slug" name="slug" value="{{ $slugvalue }}" required>-->
                                                        <select class="form-control select2 slug" style="width: 50%;"  name="slug"  onkeypress="getProduct()" required>
                                                            <option value="{{ $slugvalue }}" selected>{{ $slugvalue }} </option>
                                                        </select>


                                                    </div>

                                                    <div class="form-group row">
                                                        <div class="col-4">
                                                            <label>Start Date</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="datepicker3" name="start_date2" value="{{ $data2->start_date }}"  required>
                                                            </div>
                                                        </div>


                                                        <div class=" col-4">
                                                            <label>Expiry Date</label>
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-calendar"></i>
                                                                </div>
                                                                <input type="text" class="form-control pull-right" id="datepicker4" name="end_date2" value="{{ $data2->expiry_date }}" required>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="text-xs-right pull-right">
                                                            <button type="submit" class="btn bg-primary">Update</button>
                                                        </div>
                                                    </div>

                                                </form>
                                         @endforeach
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>

                     </section>

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
            <script>

        $( function() {
            $( "#datepicker" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker2" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker3" ).datepicker({ format: "yyyy-mm-dd"});
            $( "#datepicker4" ).datepicker({ format: "yyyy-mm-dd"});
        });</script>
    <script>
        $('.listEdit').on('click', function () {

                $('.listView').hide();
                $('.listSec').fadeIn();

        });
        $('.detailEdit').on('click', function () {

                $('.detailView').hide();
                $('.detailSec').fadeIn();

        });


        var _URL = window.URL || window.webkitURL;
        $("#listImg").change(function (e) {
            var file, img;
            if ((file = this.files[0])) {
                img = new Image();
                img.onload = function () {
                   // if( this.width == 1920 && this.height  >= 320) {
            $(".imageThumb").remove();
            var files = e.target.files ,
                filesLength = files.length ;
            for (var i = 0; i < filesLength ; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<img></img>",{
                        class : "imageThumb",
                        src : e.target.result,
                        title : file.name,
                        width : 200,
                        height : 150
                    }).insertAfter("#previewImg");
                });
                fileReader.readAsDataURL(f);
            }
                 /*   }else{
                        $.notify("Please upload image with dimension 1920 X 320");
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
                   // if (this.width == 1920 && this.height  >= 320) {
            $(".imageThumb1").remove();
            var files = e.target.files ,
                filesLength = files.length ;
            for (var i = 0; i < filesLength ; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<img></img>",{
                        class : "imageThumb1",
                        src : e.target.result,
                        title : file.name,
                        width : 200,
                        height : 150
                    }).insertAfter("#previewImg1");
                });
                fileReader.readAsDataURL(f);
            }
     /*   }else{
            $.notify("Please upload image with dimension 1920 X 320");
            $("#detailImg").val('');
        }*/
        };
        img.src = _URL.createObjectURL(file);
        }
        });


        function getProduct(str) {
            var string = str.value;
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