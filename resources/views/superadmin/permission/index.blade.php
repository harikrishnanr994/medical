{{-- \resources\views\permissions\index.blade.php --}}

@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Permissions
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> FBoxx</a></li>
                <li class="breadcrumb-item"><a href="#">UserManagement</a></li>
                <li class="breadcrumb-item active">Permission</li>
            </ol>
        </section>

    @include('flash::message')
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2><a href="{{ route('permissions.create') }}" class="btn btn-warning btn-sm">Add New Permission</a> </h2>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-warning pull-left">Edit</a>


                                            {!! Form::open(['method' => 'DELETE', 'onsubmit' => "return confirm('".trans("Are you sure want to delete")."');",
                                            'route' => ['permissions.destroy', $permission->id] ]) !!}
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

@stop
@section('javascript')
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