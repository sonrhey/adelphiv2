@extends('layouts.app')
@section('title', 'Deductions')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <a class="btn btn-success mb-3 float-right" href="loan_amount/deductions/create">Add New</a>
                        <a class="btn btn-primary mb-3 mr-2 float-right" href="#">Upload</a>
                    </div>
                    <table class="table table-bordered datatables" id="tbl-deductions">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Status</th>
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
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- <script src="{{ asset('js/pages/banks/index.js') }}"></script> -->
@endsection