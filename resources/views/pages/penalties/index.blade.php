@extends('layouts.app')
@section('title', 'Penalties')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <a class="btn btn-success mb-5 float-right" href="{{URL('penalties/create')}}">Add New</a>
                    <table class="table table-bordered datatables" id="tbl-penalty">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Percentage</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                    </table>
                </div>
            </div>
            @include('alerts.confirm')
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
    <script src="{{ asset('js/pages/penalties/index.js') }}"></script>
@endsection