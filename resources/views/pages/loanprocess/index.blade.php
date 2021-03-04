@extends('layouts.app')
@section('title', 'Loan Process')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                  <div class="container-fluid">
                      <br /><br />
                      <ul class="list-unstyled multi-steps">
                        <li class="is-active">Requirements</li>
                        <li>Appraisal and Traceback</li>
                        <li>Releasing</li>
                        <li>Schedule for Releasing</li>
                        <li>Notorial</li>
                        <li>Annotation</li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/property_collaterals/edit.js')}}"></script>
    <script src="{{asset('js/pages/identification/edit.js')}}"></script>
    <script src="{{asset('js/progress/s.js')}}"></script>
@endsection