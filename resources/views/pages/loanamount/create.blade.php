@extends('layouts.app')
@section('title', 'Create Loan Amount')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form action="{{URL('loan_amount')}}" method="post">
                        @csrf
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Loan Amount</label>
                                    <input type="number" class="form-control" name="amount">
                                </div>
                            </div>
                        </fieldset>
                        <div class="mb-4"></div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger">Back</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
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