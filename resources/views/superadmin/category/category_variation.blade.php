
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor_components/select2/dist/css/select2.min.css')}}">

    <style>

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f3f0f017 !important;
        }


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

    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Add Category Variation Theme
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">VariationThemes</li>
            </ol>
        </section>


    <!-- Main content -->
        <section class="content">
            @include('flash::message')
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <b>CHOOSE CATEGORY</b>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <form>
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6">
                                        <label>Choose Category&nbsp;&nbsp;<span class="text-muted">[Only the categories having spec will display here]</span></label>
                                        <select id="category" name="category" class="form-control select2">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-5 col-md-6">
                                        <br>
                                        <button class="btn btn-info" id="add_category_variation" type="button"> Add Variation Theme >> </button>
                                    </div>
                                </div>
                            </form>



                            <br>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>


            <div id="create_new_theme">

            </div>





            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                           <b>CATEGORY VARIATION THEMES</b>

                            <div class="box-tools pull-right">

                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                            <span class="alertmsg" ></span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Theme Name</th>
                                    <th>Last Update</th>
                                   {{-- <th>Status</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($variations))
                                    @foreach($variations as $variation)
                                        <tr>
                                            <td style="width: 20%">{{ $variation->category_details->name }}</td>
                                            <td style="width: 20%">{{ $variation->theme_name }}</td>
                                            <td style="width: 15%">{{ $variation->updated_at->format('F d, Y h:ia') }}</td>
                                           {{-- @if($variation->is_deleted == '1')
                                                <td style="width: 10%">
                                                    <span class="label label-danger" onclick="update_isDeleted('{{$variation->theme_id}}','{{$variation->is_deleted}}');">
                                                        <i class="fa fa-times-circle-o" style="color:black"> &nbsp;InActive</i>
                                                    </span>
                                                </td>
                                            @else

                                                <td style="width: 10%">
                                                    <span class="label label-success" onclick="update_isDeleted('{{$variation->theme_id}}','{{$variation->is_deleted}}');">
                                                        <i class="fa fa-check-circle-o" style="color:white"> &nbsp;Active</i>
                                                    </span>
                                                </td>
                                            @endif--}}

                                            <td style="width: 10%">

                                                <a href="#" class="btn btn-warning" onclick="update_category_variation({{$variation->category_id}})">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                <a href="#" class="deleteBrand btn btn-warning"  onclick="delete_variant({{$variation->theme_id}})" >
                                                    <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

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
    <script src="{{ asset('admin/js/notify.js') }}"></script>
    <script>
        function update_isDeleted(theme_id,status) {
            if(status==1)
            {
                if (!confirm("Do you want to ACTIVE this VariationTheme ?")){
                    return false;
                }
                else
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'text',
                        type: 'post',
                        data:{theme_id:theme_id,status:status},
                        url: '{{ route('admin.category.updateIsDeleted') }}',
                        success: function (res) {
                            $(".alertmsg").notify(
                                "Status updated successfully", "success",
                                { position:"top" }
                            );
                            $( ".table" ).load(window.location.href + " .table" );
                        }
                    });
                }
            }
            else
            {
                if (!confirm("Do you want to INACTIVE this VariationTheme ?")){
                    return false;
                }
                else
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'text',
                        type: 'post',
                        data:{theme_id:theme_id,status:status},
                        url: '{{ route('admin.category.updateIsDeleted') }}',
                        success: function (res) {
                            $(".alertmsg").notify(
                                "Status updated successfully", "success",
                                { position:"top" }
                            );
                            $( ".table" ).load(window.location.href + " .table" );
                        }
                    });
                }
            }
        }

        $('#add_category_variation').click(function(){

            var category_id=$('#category').val();
            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'post',
                url:'{{ route('admin.category.getVariations') }}',
                data:{category_id:category_id},
                success:function(res){

                    $("#create_new_theme").html('');
                    $("#create_new_theme").html(res);
                }
            });
        });
        
        function update_category_variation(category_id) {

            $.ajax({

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType:'text',
                type:'post',
                url:'{{ route('admin.category.getVariations') }}',
                data:{category_id:category_id},
                success:function(res){
                   /* $(".alertmsg").notify(
                        "Variation updated successfully", "success",
                        { position:"top" }
                    );*/
                    $("#create_new_theme").html('');
                    $("#create_new_theme").html(res);
                }
            });
        }
        function delete_variant(theme_id) {

            if (!confirm("Are you sure want to delete ?")){
                return false;
            }
            else
            {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType:'text',
                    type:'post',
                    url:'{{route('admin.category.deleteVariant')}}',
                    data:{theme_id:theme_id},
                    success:function(res){
                        $(".alertmsg").notify(
                            res, "success",
                            { position:"top" }
                        );
                        $(".table").load(location.href + " .table");

                    }
                });
            }

        }

    </script>

    <!-- MinimalPro Admin for advanced form element -->
    <script src="{{ asset('admin/js/pages/advanced-form-element.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/assets/vendor_components/select2/dist/js/select2.full.js')}}"></script>
    <!-- InputMask -->
    <script src="{{ asset('admin/assets/vendor_plugins/input-mask/jquery.inputmask.js')}}"></script>

    <!-- DataTables -->
    <script src="{{ asset('admin/assets/vendor_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


    <!-- start - This is for export functionality only -->
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/ex-js/jszip.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/ex-js/pdfmake.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/ex-js/vfs_fonts.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('admin/assets/vendor_plugins/DataTables-1.10.15/extensions/Buttons/js/buttons.print.min.js')}}"></script>
    <!-- end - This is for export functionality only -->

    <!-- MinimalPro Admin for Data Table -->
    <script src="{{asset('admin/js/pages/data-table.js')}}"}}></script>


@endsection