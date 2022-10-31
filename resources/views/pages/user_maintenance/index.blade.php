@extends('layouts.app')
@section('title', 'User Maintenance')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <a class="btn btn-success mb-5 float-right" href="{{URL('usermaintenance/create_new_user')}}">Add New</a>
                    </div>
                    <table class="table table-bordered datatables" id="tbl-users">
                        <thead>
                            <tr>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Username</th>
                                <th>User Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}">
@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/user_maintenance/index.js')}}"></script>
@endsection
