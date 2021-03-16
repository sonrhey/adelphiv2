@extends('layouts.app')
@section('title', 'Loan Payment')
    @section('content')
        <div class="card mb-3">
            <div class="card-body">
                <div class="container">
                    <input type="hidden" value="{{$account->id}}" name="account_id">
                    <div class="row">
                        <div class="col-md-3">
                            <h3>Wallet Balance:</h3>
                        </div>
                        <div class="col-md-9">
                            <?php $total = 0; ?>
                            @foreach ($account->client->cheque as $cheque)
                                <?php $total += $cheque->cheque_value ?>
                            @endforeach
                            <h2>&#8369;{{ number_format($total, 2, '.', ',') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="container">
                    <input type="hidden" value="{{$account->id}}" name="account_id">
                    <h5 class="mb-5">Account Number: {{$account->account_number}}</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Client Name</label>
                            <input type="text" class="form-control" value="{{ $account->client->first_name }} {{ $account->client->last_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Loan Amount</label>
                            <input type="text" class="form-control" value="&#8369; {{ $account->approved_loan_amount }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h5 class="mb-5">Payment Schedules</h5>
                    <table class="table table-bordered datatables" id="tbl-payments">
                        <thead>
                            <tr>
                                <th>Due Date</th>
                                <th>(&#8369;) Due Amount</th>
                                <th>(&#8369;) Curr. Balance</th>
                                <th>(&#8369;) Prev. Balance</th>
                                <th>(&#8369;) Penalty</th>
                                <th>Days Due</th>
                                <th>Status</th>
                                <th>(&#8369;) Payment</th>
                            </tr>
                        </thead>    
                    </table>
                </div>
            </div>
        </div>
        <!--success modal-->
        <div class="modal fade" id="succesPayment">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">Success Payment</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h4>Payment Success!</h4>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        <!--error modal-->
        <div class="modal fade" id="errorPayment">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #f54b35;color: white;">
                        <h6 style="">Error Payment</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h5>Payment Error, Please try again!</h5>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="preloader" style="display: none"><div class="loader"></div></div>
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
    <script>
        var ar = $('#tbl-payments').DataTable({
        pageLength: 50,
	    processing: true,
	    serverSide: false,
	    ajax: '/payment/{{$account->id}}/pay-schedules',
	    columns: [
            {data: 'due_date', name: 'ammortization.due_date', orderable: false},
	        {data: 'due_ammount', name: 'ammortization.due_ammount', orderable: false},
            {data: 'balance', name: 'ammortization.balance', orderable: false},
            {data: 'balance', name: 'ammortization.balance', orderable: false},
            {data: 'penalty', name: 'ammortization.penalty', orderable: false},
            {data: 'days_due', name: 'ammortization.days_due', orderable: false},
            {data: 'ammortization_status.name', name: 'ammortization_status.name', orderable: false},
	        {data: 'action', name: 'action', orderable: false, searchable: false}
	    ]
	    });
    </script>
    <script src="{{asset('js/pages/payment/edit.js')}}"></script>
@endsection