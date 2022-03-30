@extends('layouts.app')
@section('title', 'Clients')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <a class="btn btn-success mb-3 float-right" href="{{URL('clients/create')}}">Add New</a>
                    </div>
                    <table class="table table-bordered datatables" id="tbl-clients">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                    </table>
                </div>
            </div>
        </div>
    @endsection
@section('custom_css')
    <link href="{{ asset('js/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('custom_js')
    <script src="{{ asset('js/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/clients/index.js')}}"></script>
@endsection