@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Categories
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">All</li>
            </ol>
        </section>


    <!-- Main content -->
        <section class="content">
            @include('flash::message')
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2><a href="{{ route('category.create') }}" class="btn btn-warning btn-sm">Add Category </a> </h2>
                            <span class="alertmsg" ></span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                                <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th style="width:5%">Name</th>
                                    <th style="width:20%">Image</th>
                                    <th>Parent Category</th>
                                    <th>Category Specification</th>
                                    <th style="width:20%">Created</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($categories))
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td><img src="{{asset('images/'.$category->icon )}}" width="100px" height="100px"></td>


                                            @if($category->parent_text !='')
                                                <td>{{">> ". $category->parent_text }}</td>
                                                @if(count($category->category_details))
                                                    <td> <a href="{{route('category.specification.view',[$category->id,$category->name])}}" style="color: cornflowerblue">Click here to view specs</a></td>
                                                @else
                                                    <td><a href="{{route('category.specification.view',[$category->id,$category->name])}}" style="color: cornflowerblue">Click here to add specs</a></td>
                                                @endif
                                            @else
                                                <td>--NIL--</td>
                                                <td>--NIL--</td>
                                            @endif

                                            <td style="width: 15%">{{ $category->created_at->format('F d, Y h:ia') }}</td>


                                            <?php
                                            if( $category->is_deleted==1)
                                            {
                                            ?>
                                            <td>
                                                    <span class="label label-danger" onclick="change_status('{{$category->id}}','{{$category->is_deleted}}');">
                                                        <i class="fa fa-times-circle-o" style="color:black"> &nbsp;Inactive</i>
                                                    </span>
                                            </td>

                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <td><span class="label label-success" onclick="change_status('{{$category->id}}','{{$category->is_deleted}}');"><i class="fa fa-check-circle-o" style="color:white"> &nbsp;Active</i></span></td>


                                            <?php
                                            }
                                            ?>


                                            <td>

                                                <a href="{{route('category.edit',$category->id) }}">
                                                    <span class="label label-info"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                </a>

                                                &nbsp; &nbsp;

                                               <span class="label label-danger"  onclick="destroy('{{$category->id}}')">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                               </span>


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
        function destroy(category_id) {

            if (!confirm("Do you want to Delete this Category ?")){
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
                    data:{category_id:category_id},
                    url: '{{ route('category.destroy')}}',
                    success: function (res) {

                        if (res== "false")
                        {
                            $(".alertmsg").notify(
                                "Sorry the category is already in use","error"
                            );

                        }
                    else
                        {
                            $(".alertmsg").notify(
                                "Category deleted successfully","success"
                            );
                            $( ".table" ).load(window.location.href + " .table" );
                        }

                    }
                });
            }

        }

        function change_status(category_id,status) {
            if(status==0)
            {
                if (!confirm("Do you want to InACTIVE this product ?")){
                    return false;
                }
                else
                {
                    //var id=$(this).data('id');
                    var id=id;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'text',
                        type: 'post',
                        data:{category_id:category_id,status:status},
                        url: '{{ route('admin.category.updateStatus') }}',
                        success: function (res) {
                            $(".alertmsg").notify(
                                "Category status changed", "success",
                                { position:"top" }
                            );
                            $( ".table" ).load(window.location.href + " .table" );
                        }
                    });
                }
            }
            else
            {
                if (!confirm("Do you want to ACTIVE this product ?")){
                    return false;
                }
                else
                {
                    //var id=$(this).data('id');
                    var id=id;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'text',
                        type: 'post',
                        data:{category_id:category_id,status:status},
                        url: '{{ route('admin.category.updateStatus') }}',
                        success: function (res) {

                            $(".alertmsg").notify(
                                "Category status changed", "success",
                                { position:"top" }
                            );
                            $( ".table" ).load(window.location.href + " .table" );
                        }
                    });
                }
            }
        }
    </script>
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