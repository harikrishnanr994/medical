@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h4>
                Users
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Med</a></li>
                <li class="breadcrumb-item"><a href="#">User Management</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </section>

    @include('flash::message')
    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h2><a href="{{ route('users.create') }}" class="btn btn-warning btn-sm">Add New User </a> </h2>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date/Time Added</th>
                                    <th>User Roles</th>
                                    <th>Profile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($users))
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                                            <td><span class="badge badge-dark">{{ $user->roles()->pluck('name')->implode(' ') }}</span></td>
                                            <?php
                                            $role_arr=$user->roles()->pluck('name');
                                            for($i=0;$i<count($role_arr);$i++)
                                            {
                                                $roles[]=$role_arr[$i];
                                            }
                                            ?>
                                            @if($user->hasRole('Vendor'))
                                                <td><a href="{{route('admin.profile.create',$user->id)}}">Add profile</a> </td>
                                            @else
                                                <td></td>
                                            @endif
                                            <?php
                                            if( $user->is_deleted==0)
                                            {
                                            ?>
                                            <td><span class="label label-success" @if(!$user->hasRole('Admin')) onclick="change_status('{{$user->id}}','{{$user->is_deleted}}');" @endif><i class="fa fa-check-circle-o" style="color:white"> &nbsp;Active</i></span></td>

                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <td><span class="label label-warning" onclick="change_status('{{$user->id}}','{{$user->is_deleted}}');"><i class="fa fa-times-circle-o" style="color:black"> &nbsp;Inactive</i></span></td>
                                            <?php
                                            }
                                            ?>
                                            <td>
                                                <a href="{{ URL::to('admin/users/'.$user->id.'/edit') }}" class="btn btn-warning btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                                {!! Form::open(['method' => 'DELETE','onsubmit' => "return confirm('".trans("Are you sure want to delete")."');", 'route' => ['users.destroy', $user->id] ]) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                                {!! Form::close() !!}
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
        function change_status(user_id,status) {


            if(status==0)
            {
                if (!confirm("Do you want to INACTIVE this user ?")){
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
                        data:{user_id:user_id,status:status},
                        url: '{{ route('admin.user.updateStatus') }}',
                        success: function (res) {
                            $.notify("Status Updated","error");
                            setTimeout(function() {
                            }, 1000)
                            $( ".table" ).load(window.location.href + " .table" );                        }
                    });
                }
            }
            else
            {
                if (!confirm("Do you want to ACTIVE this user ?")){
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
                        data:{user_id:user_id,status:status},
                        url: '{{ route('admin.user.updateStatus') }}',
                        success: function (res) {
                            $.notify("Status Updated","success");
                            setTimeout(function() {
                            }, 1000)
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
