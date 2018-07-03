@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/jquery.mCustomScrollbar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/scroll.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('admin/css/master_style.css')}}">
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
                        <div class="box-body">
                            <form class="form-style-5" action="{{route('category.store')}}" onsubmit="return validation();" enctype="multipart/form-data" method="post">
                                {{csrf_field()}}
                                {{--  @include('flash::message')--}}
                                <fieldset>
                                    <legend><span class="number">1</span> Category Info</legend>

                                    @if($errors->first('name'))
                                        <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('name')}}<br></b>
                                    @endif
                                    <input type="text" name="name" value="{{old('name')}}" placeholder="Category Name *" class="form-control" required>




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

                                            <input type="file" id="file2" name="image2" placeholder="Category Icon Image *" class="form-control" accept="image/*" onchange="readURL2(this);" required >

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
                                                    <img id="blah" src="{{asset('images/noimage.png' )}}" width="150" height="100" alt=" no image choosen" />
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
                                                    <img id="blah2" src="{{asset('images/noimage.png' )}}" width="150" height="100" alt=" no image choosen" />
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


                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">- -Choose Parent- -</button>
                                    <input type="text" name="parent_id" id="parent" value="0" hidden>
                                    <br>
                                    <br>
                                    <input type="text" name="parent_name" id="parent_name" value="" placeholder="--Parent name--" readonly>
                                </fieldset>
                                @if($errors->first('specification_titles'))
                                    <b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{$errors->first('specification_titles')}}<br><br></b>
                                @endif


                                <div id="fieldset_spec" style="display: none">
                                    <fieldset>
                                        <legend><span class="number">3</span> Spec Titles</legend>


                                        &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
                                        <span id="is_check_error" style="display: none" ><b style="color: red;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp; Check any option..!!!</b></span>

                                        <div class="row">
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="checkbox" id="last_child" name="last_child">
                                                <label for="last_child">Last Child Category? </label>
                                            </div>
                                            <div class="col-md-1">
                                            </div>
                                            <div class="col-md-5">
                                                <input type="checkbox" id="not_a_last_child" name="not_a_last_child">
                                                <label for="not_a_last_child">Not Last Child Category? </label>
                                            </div>
                                        </div>


                                        <div id="spec" style="display: none">
                                            &nbsp;<i style="color: red;">[ If the category is a last child category ]</i>
                                            <input type="text" name="specification_titles" id="specification_titles" placeholder="Add specification titles *" class="form-control bootstrap-tagsinput" value="" data-role="tagsinput">
                                        </div>

                                    </fieldset>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn1">Create</button>
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


    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h7 class="modal-title" id="largeModalLabel">Select Category</h7><em></em>
                </div>
                {{--<div class="modal-body">--}}
                    {{--<span style="float: right">--}}
                            {{--<button class="btn btn-danger btn-sm" id="add_here" type="button"  data-dismiss="modal">Add Here</button>--}}
                    {{--</span>--}}

                    {{--<br>--}}
                    {{--<div class="row repe" id="rep">--}}

                        {{--@if(count($categories))--}}
                            {{--@foreach ($categories as $category)--}}
                                {{-- <option value="{{$category->id}}" style="background-image:url({{asset('images/'.$category->image )}});">{{$category->name}}</option>--}}
                                 {{--</option>--}}
                                {{--<div class="col-md-3">--}}
                                    {{--<label class="btn btn-warning" style="float: left;height: 100Px;">--}}
                                        {{--<img  src="{{asset('images/'.$category->icon )}}" alt="..." class="img-thumbnail img-check cat-img" id="{{$category->id}}" value="{{$category->id}}">--}}
                                        {{--<input type="checkbox" name="{{$category->name}}" id="{{$category->id}}" value="{{$category->id}}"--}}
                                               {{--class="hidden parent_category" autocomplete="off">--}}
                                    {{--</label>--}}
                                {{--</div>--}}

                            {{--@endforeach--}}
                        {{--@endif--}}

                    {{--</div>--}}
                {{--</div>--}}
                <div class="modal-body">
                    <button id="addCatChild" type="button" class="btn btn-primary add" style="display:none;">
                        ADD HERE
                    </button>
                    <div class="content-bottom demo-x">
                        <div class="scrol-bottom">
                            <div class="div_content" id="cat_1">
                                <div class="content1 content-3d">
                                    <div class="viewport">
                                        <ul class="cat">
                                            <li>
                                                <button type="button" class="btn btn-primary btn-xs selectParent">
                                                    ADD HERE
                                                </button>
                                                <input type="text" class="chosenParentName" name="chosenParentName1" id="chosenParentName1" value="" hidden>
                                                <input type="text" class="chosenParent" name="chosenParent1" id="chosenParent1" value="0" hidden>
                                            </li>
                                            @foreach($categories as $cat)
                                                <li>
                                                    <a href="#" id="{{ $cat->id }}" class="icon-list-main icon-list block rel lheight16 tdnone clr">
                                                        <span class="inlblk">
                                                            {{ $cat->name }}
                                                        </span>
                                                        <span class="target abs hidden">&nbsp;</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')
    <script src="{{asset('admin/js/jquery.mCustomScrollbar.concat.min.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            //category selection scroll fn start
            var catDivs = [1];
            var parent = [];
            var in_use=false;
            $(document).on('click','.cat li a', function(){
                if(!in_use)
                {
                    par = $.trim($('.inlblk', this).html());
                    mainDiv = $(this).closest('.div_content').attr('id');
                    divNo = parseInt(mainDiv.split("_").pop());
                    parent[divNo - 1] = par;
                    NextDivNo = divNo + 1;
                    cat = $(this).attr('id');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'get',
                        url:'{{ route('category.getSubCategory') }}',
                        data:{category:cat},
                        success:function(res){

                            i = catDivs.length - 1;
                            while(i >= 0){
                                if(catDivs[i] >= NextDivNo){
                                    $('#cat_'+ catDivs[i]).remove();
                                    catDivs.splice( $.inArray(catDivs[i], catDivs), 1 );
                                }
                                i--;
                            }

                            j = parent.length - 1;
                            while(j > (divNo-1)){
                                parent.splice(j, 1);
                                j--;
                            }

                            parentString = '';
                            for(key in parent){
                                parentString += '>>' + parent[key];
                            }

                            $('#'+ mainDiv +' .cat li a').removeClass('click_active');
                            $('#'+ cat).addClass('click_active');
                            $('#'+ mainDiv +' .cat li a span.pull-right').remove();
                            if(res.sub_categories.length > 0){
                                $('#'+ cat).append('<span class="pull-right"><i class="fa fa-angle-double-right fa-lg" aria-hidden="true"></i></span>');
                                var opt = '';
                                for(key in res.sub_categories){
                                    opt += '<li>\n' +
                                        '      <a href="#" id="'+ res.sub_categories[key].id +'" class="icon-list-main icon-list block rel lheight16 tdnone clr">\n' +
                                        '          <span class="inlblk">\n'
                                        + res.sub_categories[key].name +
                                        '          </span>\n' +
                                        '          <span class="target abs hidden">&nbsp;</span>\n' +
                                        '      </a>\n' +
                                        '  </li>\n';
                                }
                                newDiv = '<div class="div_content" id="cat_'+ NextDivNo +'">\n' +
                                    '  <div class="content1 content-3d">\n' +
                                    '      <div class="viewport">\n' +
                                    '          <ul class="cat">\n' +
                                    '              <li>\n' +
                                    '                  <button type="button" class="btn btn-primary btn-xs selectParent">\n' +
                                    '                      ADD HERE\n' +
                                    '                  </button>\n' +
                                    '                  <input type="text" class="chosenParentName" name="chosenParentName'+ NextDivNo +'" id="chosenParentName'+ NextDivNo +'" value="'+ parentString +'" hidden>\n' +
                                    '                  <input type="text" class="chosenParent" name="chosenParent'+ NextDivNo +'" id="chosenParent'+ NextDivNo +'" value="'+ cat +'" hidden>\n' +
                                    '              </li>\n'
                                    + opt +

                                    '          </ul>\n' +
                                    '      </div>\n' +
                                    '  </div>\n' +
                                    '</div>';
                                $('div.scrol-bottom').append(newDiv);
                                makeScroll();
                                catDivs.push(NextDivNo);
                                $('#addCatChild').hide();
                            }else{
                                $('#addCatChild').html('Add Under "' + par + '"');
                                $('#addCatChild').after('' +
                                    '<input type="text" class="chosenParentName" name="chosenParentName'+ NextDivNo +'" id="chosenParentName'+ NextDivNo +'" value="'+ parentString +'" hidden>\n' +
                                    '<input type="text" class="chosenParent" name="chosenParent'+ NextDivNo +'" id="chosenParent'+ NextDivNo +'" value="'+ cat +'" hidden>');
                                $('#addCatChild').show();
                            }
                            in_use=false;
                        }
                    });
                }


            });

            $(document).on('click','button.selectParent', function(){
                cid = $(this).closest('ul.cat').find('.chosenParent').val();
                cname = $(this).closest('ul.cat').find('.chosenParentName').val();
                $('#parent').val(cid);
                $('#parent_name').val(cname);
                $('#myModal').modal('toggle');

                var parent_name = $('#parent_name').val();
                if(parent_name !='')
                {
                    $('#fieldset_spec').show();
                }
            });

            $('#addCatChild').on('click',function(){
                cid = $(this).closest('.modal-body').find('.chosenParent').first().val();
                cname = $(this).closest('.modal-body').find('.chosenParentName').first().val();
                $('#parent').val(cid);
                $('#parent_name').val(cname);
                $('#myModal').modal('toggle');

                var parent_name = $('#parent_name').val();
                if(parent_name !='')
                {
                    $('#fieldset_spec').show();
                }
            });
            //category selection scroll fn end
        });

        //category selection scroll fn start

        function makeScroll() {
            $.mCustomScrollbar.defaults.scrollButtons.enable = true; //enable scrolling buttons by default
            $.mCustomScrollbar.defaults.axis = "yx"; //enable 2 axis scrollbars by default

            $("#content-3d").mCustomScrollbar({theme: "rounded-dark"});

            $(".content-3d").mCustomScrollbar({theme: "rounded-dark"});

            $("#content-3dd").mCustomScrollbar({theme: "rounded-dark"});

            $("#content-3dt").mCustomScrollbar({theme: "3d-thick"});

            $("#content-3dtd").mCustomScrollbar({theme: "rounded-dark"});

            $(".all-themes-switch a").click(function (e) {
                e.preventDefault();
                var $this = $(this),
                    rel = $this.attr("rel"),
                    el = $(".content");
                switch (rel) {
                    case "toggle-content":
                        el.toggleClass("expanded-content");
                        break;
                }
            });

            $.mCustomScrollbar.defaults.theme = "dark-thin"; //set "light-2" as the default theme

            $(".demo-y").mCustomScrollbar();

            $(".demo-x").mCustomScrollbar({
                axis: "x",
                advanced: {
                    autoExpandHorizontalScroll: true
                }
            });

            $(".demo-yx").mCustomScrollbar({
                axis: "yx"
            });

            $(".scrollTo a").click(function (e) {
                e.preventDefault();
                var $this = $(this),
                    rel = $this.attr("rel"),
                    el = rel === "content-y" ? ".demo-y" : rel === "content-x" ? ".demo-x" : ".demo-yx",
                    data = $this.data("scroll-to"),
                    href = $this.attr("href").split(/#(.+)/)[1],
                    to = data ? $(el).find(".mCSB_container").find(data) : el === ".demo-yx" ? eval("(" + href + ")") : href,
                    output = $("#info > p code"),
                    outputTXTdata = el === ".demo-yx" ? data : "'" + data + "'",
                    outputTXThref = el === ".demo-yx" ? href : "'" + href + "'",
                    outputTXT = data ? "$('" + el + "').find('.mCSB_container').find(" + outputTXTdata + ")" : outputTXThref;
                $(el).mCustomScrollbar("scrollTo", to);
                output.text("$('" + el + "').mCustomScrollbar('scrollTo'," + outputTXT + ");");
            });

            /*
            get snap amount programmatically or just set it directly (e.g. "273")
            in this example, the snap amount is list item's (li) outer-width (width+margins)
            */
            var amount = Math.max.apply(Math, $("#content-1 li").map(function () {
                return $(this).outerWidth(true);
            }).get());

            $("#content-1").mCustomScrollbar({
                axis: "x",
                theme: "inset",
                advanced: {
                    autoExpandHorizontalScroll: true
                },
                scrollButtons: {
                    enable: true,
                    scrollType: "stepped"
                },
                keyboard: {scrollType: "stepped"},
                snapAmount: amount,
                mouseWheel: {scrollAmount: amount}
            });
        }
        (function ($) {
            $(window).on("load", function () {
                makeScroll();
            });
        })(jQuery);
        //category selection scroll fn end

        /*$(".modal-body #add_here").click(function()
        {
            var parent_name=$('#parent_name').val();
            if(parent_name !='')
            {
                $('#fieldset_spec').show();
            }
        });*/

        $('#last_child').change(function(){
            if (document.getElementById('last_child').checked)
            {
                $("#not_a_last_child").prop("checked",false);
                $("#spec").show();
            }
            else
            {
                $("#last_child").prop("checked",false);
                $("#spec").hide();
            }

        });

        $('#not_a_last_child').change(function(){
            $("#last_child").prop("checked",false);
            $("#spec").val('');
            $("#spec").hide();
        });

/*
        $(".img-check").click(function() {
            $(this).toggleClass("check");
            var main_cat = this.id;
            $('input[name=parent_name]').val("")
            $('#parent').val(main_cat);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'get',
                url:'{{ route('category.getSubCategory') }}',
                data:{category:main_cat},
                success:function(res){

                    $('#rep').removeClass("row");
                    $('#rep').addClass("col-md-2");

                    var obj = jQuery.parseJSON(res);
                    var p_name=obj['parent_name'][0].name;

                    //  $('#parent_name').val(p_name);
                    $('#parent_name').val($('#parent_name').val() + ' >>'+p_name);
                    $("em").append(' >>'+p_name);
                    $('#rep').html('');
                    if(obj['sub_categories'].length>0)
                    {
                        for(var i=0;i<obj['sub_categories'].length;i++)
                        {
                            var id = obj['sub_categories'][i].id;
                            var name = obj['sub_categories'][i].name;
                            /!* var url_name='subCat/'+id;
                             var sub='<a href="'+url_name+'" class="test">'+name+'</a>';*!/
                            var sub='<a href="#" onclick="myfn(this)" id="'+id+'">'+name+'</a>';
                            /!*var sub='<a href="#">'+name+'</a>*!/
                            $('#rep').append('<div class="row">' + sub + '</div>');
                        }

                    }
                    else
                    {
                        $('#rep').html('');
                    }
                }
            });
            //alert(main_cat);
        });
*/

        function myfn(input)
        {

            var id=input.id;
            $('#parent').val(id);
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'get',
                url:'{{ route('category.subCat') }}',
                data:{category:id},
                success:function(res){

                    $('#rep').removeClass("row");
                    $('#rep').addClass("col-md-2");


                    var obj = jQuery.parseJSON(res);
                    $('#rep').html('');

                    var p_name=obj['parent_name'][0].name;
                    $('#parent_name').val($('#parent_name').val() + ' >>'+p_name);
                    $("em").append( ' >>'+p_name);

                    if(obj['sub_categories'].length>0) {

                        for(var i=0;i<obj['sub_categories'].length;i++) {

                            var id = obj['sub_categories'][i].id;
                            var name = obj['sub_categories'][i].name;

                            var sub='<a href="#"  onclick="myfn(this)"  id="'+id+'">'+name+'</a>';

                            $('#rep').append('<div class="row">' + sub + '</div>');
                        }
                    }

                    else
                    {
                        ('#rep').html('');
                    }
                }

            });
        }

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
                        $('#pic').hide();
                        //$('#img_err').show();
                    }
                };
                image.src = _URL.createObjectURL(file);
            }
        });

        // var _URL = window.URL || window.webkitURL;
        $("#file2").change(function(e) {

            var image, file;

            if ((file = this.files[0])) {

                image = new Image();
                image.onload = function() {
                    if ((this.width != 179 && this.height != 179))
                    {
                        alert("Image Dimension should be 179x179");
                        $("#file2").val('');
                        $('#pic2').hide();
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
                $('#pic2').show();
                reader.readAsDataURL(input.files[0]);
            }
        }

        function validation()
        {
            var parent_name=$('#parent_name').val();
            if(parent_name !='')
            {
                if(document.getElementById('last_child').checked || (document.getElementById('not_a_last_child').checked))
                {
                    return true;
                }
                else
                {
                    $('#is_check_error').show();
                    return false;
                }
            }
            else
            {
                return true;
            }
        }
    </script>
@endsection

