{{-- \resources\views\permissions\index.blade.php --}}

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Roles
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">UserManagement</a></li>
                <li class="breadcrumb-item active">Role</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2><a href="{{ route('roles.create')}}" class="btn btn-warning btn-sm">Add New Role</a> </h2>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                        <td>
                                            <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-warning pull-left">Edit</a>
                                            {!! Form::open(['method' => 'DELETE', 'onsubmit' => "return confirm('".trans("Are you sure want to delete")."');",'route' => ['roles.destroy', $role->id] ]) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
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




    {{-- <!-- JQuery DataTable Css -->
     <link rel="stylesheet" href="{{ asset('admin/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
     <section class="content">
         <div class="block-header">
             <div class="row">
                 <div class="col-lg-7 col-md-6 col-sm-12">
                     <h2>Roles
                         <small class="text-muted">Welcome to F-boxx</small>
                     </h2>
                 </div>
                 <div class="col-lg-5 col-md-6 col-sm-12">
                     <ul class="breadcrumb float-md-right">
                         <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="zmdi zmdi-home"></i> F-boxx</a></li>
                         <li class="breadcrumb-item"><a href="javascript:void(0);">User Management</a></li>
                         <li class="breadcrumb-item active">Roles</li>
                     </ul>
                 </div>
             </div>
         </div>
         <div class="container-fluid">
             <div class="row clearfix">
                 <div class="col-lg-12 col-md-12 col-sm-12">
                     <div class="card">
                         <div class="header">
                             <h2><a href="{{ URL::to('roles/create')}}" class="btn btn-warning">Add Role</a> </h2>
                             <ul class="header-dropdown">
                                 <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more-vert"></i> </a>
                                     <ul class="dropdown-menu pull-right">
                                         <li><a href="javascript:void(0);">Action</a></li>
                                         <li><a href="javascript:void(0);">Another action</a></li>
                                         <li><a href="javascript:void(0);">Something else here</a></li>
                                     </ul>
                                 </li>
                             </ul>
                         </div>
                         <div class="body">
                             <div class="table-responsive">
                                 @include('flash::message')
                                 <table class="table table-bordered table-striped">
                                     <thead>
                                     <tr>
                                         <th>Role</th>
                                         <th>Permissions</th>
                                         <th>Action</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach ($roles as $role)
                                         <tr>
                                             <td>{{ $role->name }}</td>
                                             <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                             <td>
                                                 <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-warning pull-left">Edit</a>
                                                 {!! Form::open(['method' => 'DELETE', 'onsubmit' => "return confirm('".trans("Are you sure want to delete")."');",'route' => ['roles.destroy', $role->id] ]) !!}
                                                 {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                 {!! Form::close() !!}
                                             </td>
                                         </tr>
                                     @endforeach
                                     </tbody>
                                 </table>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
     </section>--}}
@stop
@section('javascript')
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

