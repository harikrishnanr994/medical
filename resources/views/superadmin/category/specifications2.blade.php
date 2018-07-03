@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <style>

        .bootstrap-select > select {
            position: relative !important;
            bottom: 0;
            left:  10px !important;
            display: block !important;
            width: 100% !important;
            height: 100% !important;
            /* padding: 0 !important; */
            border: none;
            opacity: 22 !important;
        }
        .btn-default{
            display: none;
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
        .form-style-5 legend {
            font-size: 1.4em;
            margin-bottom: 10px;
        }
        .form-style-5 label {
            display: block;
            margin-bottom: 8px;
        }

        .form-style-5 input[type="date"],
        .form-style-5 input[type="datetime"],
        .form-style-5 input[type="email"],
        .form-style-5 input[type="password"],
        .form-style-5 input[type="number"],
        .form-style-5 input[type="search"],
        .form-style-5 input[type="time"],
        .form-style-5 input[type="url"],
        .form-style-5 textarea{
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

        .form-style-5 input[type="date"]:focus,
        .form-style-5 input[type="datetime"]:focus,
        .form-style-5 input[type="email"]:focus,
        .form-style-5 input[type="number"]:focus,
        .form-style-5 input[type="search"]:focus,
        .form-style-5 input[type="time"]:focus,
        .form-style-5 input[type="checkbox"]:focus,
        .form-style-5 input[type="url"]:focus,
        .form-style-5 textarea:focus{
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
                {{$category}} Specifications
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">Specifications</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <!-- SELECT2 EXAMPLE -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><a href="{{route('category.index')}}">
                                    <i class="fa fa-fast-backward" aria-hidden="true"></i>
                                </a>&nbsp;&nbsp;&nbsp;Select Elements</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
{{--
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
--}}
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Specification Name</label>
                                        <input type="text" class="form-control" name="category" id="category" placeholder="  Enter Specification *">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group"  id="athira">
                                        <label>Possible Values</label>
                                        <span style="color: red">&nbsp;&nbsp;[Press <i>ENTER</i>  Key after adding each value]</span>
                                        <br>
                                        <span id="features_values" class="label label-primary" style="display: none">

                                        </span>
                                        <input type="text" name="features" id="features" placeholder="Add Possible Values *" class="form-control bootstrap-tagsinput" value="" data-role="tagsinput">

                                    </div>
                                    <!-- /.form-group -->
                                    <br>
                                    <button type="button" class="cancel btn btn-danger" style="float: left;">Cancel</button>

                                </div>
                                <!-- /.col -->
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Choose Control</label>
                                        <select class="form-control select2"  id="control" name="control"  style="width: 100%;">
                                            @foreach ($controls as $control)
                                                <option value="{{$control->id}}"> &nbsp;&nbsp;{{$control->input}}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="category_id" id="category_id" value="{{$id}}" hidden>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Choose Specification Title</label>
                                        <select class="form-control select2"  id="spec_title" name="spec_title"  style="width: 100%;">
                                            @foreach ($titles as $title)
                                                <option value="{{$title->id}}"> &nbsp;&nbsp;{{$title->spec_title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <br>
                                    <input type="text" value="" name="edit_id" id="edit_id" hidden>
                                    <button type="submit" class="post btn btn-success" style="float: right">Save</button>
                                    {{-- <div id="update" hidden>--}}
                                    <button type="submit" class="update btn btn-success" style="float: right;">Update</button>

                                    {{--  </div>--}}

                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->




                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h5> &nbsp;&nbsp;&nbsp;ALL SPECIFICATIONS </h5>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                    <tr class="item-row" id="0">
                                        <th>Specification</th>
                                        <th>Control</th>
                                        <th>Possible Values</th>
                                        <th>Action</th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>





@stop
@section('javascript')
    <script src="{{ asset('admin/js/notify.js') }}"></script>
<script>

    $(document).on("click", ".cancel", function (e) {
        $(this).closest('form').find("input[type=text], textarea").val("");
        location.reload();
    });

    $( document ).ready(function() {
        $('.update').hide();
        var id=$('#category_id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'text',
            type:'post',
            url:'{{route('category.specification.get')}}',
            data:{category_id:id},
            success:function(res){
                var obj =jQuery.parseJSON(res);
                var limit=obj.length;
                $('.data').empty();
                for(var i=0;i<limit;i++)
                {
                    var id=obj[i].id;
                    var spec_name=obj[i].spec_name;
                    var specifications=obj[i].specifications;
                    var control_name=obj[i].control_name;

                    $(".item-row:last").after('<tr id="'+id+'" class="item-row data"> '+
                        '<td>'+spec_name+'</td><td>'+control_name+'</td><td>'+specifications+'</td>' +
                        '<td> <a href="#" class="btn btn-warning"  onclick="editItem('+id+')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;' +
                        '<a href="#" class="btn btn-danger" onclick="deleteItem('+id+')"> <i class="fa fa-trash" aria-hidden="true"></a></td></tr>');

                }
            }
        });
    });

    function test() {
    $('.update').hide();
    var id=$('#category_id').val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType:'text',
        type:'post',
        url:'{{route('category.specification.get')}}',
        data:{category_id:id},
        success:function(res){
            var obj =jQuery.parseJSON(res);
            var limit=obj.length;
            $('.data').empty();
            for(var i=0;i<limit;i++)
            {
                var id=obj[i].id;
                var spec_name=obj[i].spec_name;
                var specifications=obj[i].specifications;
                var control_name=obj[i].control_name;

                $(".item-row:last").after('<tr id="'+id+'" class="item-row data"> '+
                    '<td>'+spec_name+'</td><td>'+control_name+'</td><td>'+specifications+'</td>' +
                    '<td> <a href="#" class="btn btn-warning"  onclick="editItem('+id+')"> <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;' +
                    '<a href="#" class="btn btn-danger" onclick="deleteItem('+id+')"> <i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>');
            }
        }
    });
}
    $(document).on("click", ".post", function (e) {
        e.preventDefault();


        $('.update').hide();
        var id=$('#category_id').val();
        var category=$('#category').val();
        var control=$('#control').val();
        var features=$('#features').val();
        var spec_title=$('#spec_title').val();
        var control_name='abc';
        if(category=='' || features=='' || control=='' || features=='')
        {
           alert('All Fields are mandatory');
           // $.notify("All Fields are mandatory","error");
        }
        else
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'post',
                url:'{{ route('category.specification.store') }}',
                data:{category_id:id,spec_name:category,specifications:features,control:control,control_name:control_name,spec_title:spec_title},
                success:function(res){
                    $('#category').val('');
                    $('#features').tagsinput('removeAll');
                    //$('#category_id').val('');
                    $.notify("Specification added Successfully","success");
                    setTimeout(function() {
                        test();
                    }, 1000)

                }
            });
        }

    });

    function editItem(id) {
        $('.post').hide();
        $('.update').show();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'text',
            type:'post',
            url:'{{ route('category.specification.edit') }}',
            data:{id:id},
            success:function(res){

                var obj =jQuery.parseJSON(res);
                var limit=obj.length;
                $('.data').empty();
                for(var i=0;i<limit;i++) {
                    var id = obj[i].id;
                    var spec_name = obj[i].spec_name;
                    var specifications = obj[i].specifications;
                    var category_id = obj[i].category_id;
                    var control = obj[i].control;
                    var spec_title = obj[i].spec_title;

                    $('#category').val(spec_name);


                    $('#features_values').show();
                    $('#features_values').text(specifications);
                    $('#category_id').val(category_id);
                    $('#edit_id').val(id);

                    $("#control option").each(function() {
                        if($(this).val()==control)
                        {
                            $(this).attr("selected", "selected");
                        }
                    });
                    $("#spec_title option").each(function() {
                        if($(this).val()==spec_title)
                        {
                            $(this).attr("selected", "selected");
                        }
                    });



                }
            }
        });
    }

    $(document).on("click", ".update", function (e) {
        $('.hide').hide();
        e.preventDefault();
        var id=$('#edit_id').val();
        var category=$('#category').val();
        var control=$('#control').val();
        var features=$('#features').val();
        var spec_title=$('#spec_title').val();
        var control_name='abc';
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType:'text',
            type:'post',
            url:'{{ route('category.specification.update') }}',
            data:{id:id,spec_name:category,specifications:features,control:control,control_name:control_name,spec_title:spec_title},
            success:function(res){

                location.reload();
                $.notify("Updated Successfully","success");
                setTimeout(function() {
                    test();
                }, 1000)
                // alert('Specification added Successfully');


            }
        });
    });


    function deleteItem(id) {
        $('.update').hide();
        var category_id=$('#category_id').val();

        if (confirm("Are you sure?")) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'post',
                url:'{{ route('category.specification.delete') }}',
                data:{id:id,category_id:category_id},
                success:function(res){
                    $.notify(res,"error");
                    setTimeout(function() {
                        test();
                    }, 1000)
                    //location.reload(true)
                }
            });

        }
        return false;

    }


</script>


@endsection

