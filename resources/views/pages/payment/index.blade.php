@extends('layouts.app')
@section('title', 'Payment')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <table class="table table-bordered datatables" id="tbl-accounts">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Account Number</th>
                                <th>Loan Type</th>
                                <th>Branch</th>
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
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/payment/index.js')}}"></script>
@endsection