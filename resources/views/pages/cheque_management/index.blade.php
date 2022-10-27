@extends('layouts.app')
@section('title', 'Cheque Management')
    @section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
            <button type="button" class="btn btn-xs close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Success!</strong> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="container">
                <a class="btn btn-success mb-5 float-right" data-toggle="modal" data-target="#addcheque" style="color: white">Add New</a>
                <table class="table table-bordered datatables" id="tbl-cheque">
                    <thead>
                        <tr>
                            <th>Client Name</th>
                            <th>Bank Name</th>
                            <th>Cheque Number</th>
                            <th>(&#8369;) Cheque Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcheque">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Cheque</h4>
                </diV>
                <div class="modal-body">
                    <form action="{{URL('chequemanagement')}}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Client</label>
                            <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="client_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bank Name</label>
                            <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="bank_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cheque Number</label>
                            <input type="number" class="form-control" name="cheque_name" required>
                        </div>
                        <div class="form-group">
                            <label>Cheque Expiry Date</label>
                            <input type="date" class="form-control" name="cheque_expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label>Cheque Value</label>
                            <input type="number" step="any" class="form-control" name="cheque_value" required>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editcheque">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Cheque</h4>
                </diV>
                <div class="modal-body">
                    <form action="{{URL('chequemanagement/update/')}}" method="POST">
                        {{method_field('PUT')}}
                        {{ csrf_field() }}
                        <input type="hidden" name="cheque_id">
                        <div class="form-group">
                            <label>Client</label>
                            <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="selected_client_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bank Name</label>
                            <select class="form-control selectpicker" data-live-search="true" data-style="btn-user btn-bordered" name="selected_bank_id" required>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Cheque Number</label>
                            <input type="number" class="form-control" name="selected_cheque_name" required>
                        </div>
                        <div class="form-group">
                            <label>Cheque Value</label>
                            <input type="number" step="any" class="form-control" name="selected_cheque_value" required>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('alerts.confirm')
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
    <script src="{{ asset('js/pages/clients/client_list.js') }}"></script>
    <script src="{{ asset('js/pages/cheque_management/bank_list.js') }}"></script>
    <script src="{{ asset('js/pages/cheque_management/cheque_list.js') }}"></script>
@endsection
