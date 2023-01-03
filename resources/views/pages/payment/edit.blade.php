@extends('layouts.app')
@section('custom_css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}"> --}}
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
@endsection
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
                                <?php
                                $total += $cheque->cheque_value;
                                ?>
                            @endforeach
                            <?php
                            $total += @$account->client->cash->first()->amount;
                            ?>
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
                    <h5 class="mb-5">Account Number: {{$account->account_number}}  <span style="color: green; text-transform: uppercase">[<strong>{{$account->status->name}}</strong>]</span></h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Client Name</label>
                            <input type="text" class="form-control" value="{{ $account->client->first_name }} {{ $account->client->last_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Loan Amount</label>
                            <input type="text" class="form-control" value="&#8369; {{ number_format($account->approved_loan_amount, 2, '.', ',') }}" readonly>
                        </div>
                    </div>
                    <div class="mb-5"></div>
                    <div class="row">
                        <div class="col-md-6">
                        <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirmation-modal">CLOSE ACCOUNT</button>
                        @if($account->loan_type->name == "Interest Only")
                            <button class="btn btn-primary" data-toggle="modal" data-target="#payout-modal" type="button">PAY OUT</button>
                        @else
                            <button class="btn btn-primary" data-toggle="modal" data-target="#revert-modal" type="button">REVERT TO INTEREST ONLY</button>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h5 class="mb-5">Payment Schedules</h5>
                    <table class="table table-bordered" id="tbl-payments">
                        <thead>
                            <tr>
                                <th>Due Date</th>
                                <th>(&#8369;) Due Amount</th>
                                <th>(&#8369;) Curr. Balance</th>
                                <th>(&#8369;) Prev. Balance</th>
                                <th>(&#8369;) Penalty</th>
                                <th style="width: 0px !important;">Days Due</th>
                                <th style="width: 0px !important;">Status</th>
                                <th>(&#8369;) Payment</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--nextcycle modal-->
        <div class="modal fade" id="nextCycle">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h4><span class="cycle-count"></span> payment cycle is done, Do you wish to proceed to the next cycle?</h4>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-dismiss="modal" data-target="#renewal-fee">YES</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">NO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--renewal modal-->
        <div class="modal fade" id="renewal-fee">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h4>A renewal fee of <strong>5,000.00 Pesos</strong> will be charged. Do you wish to proceed?</h4>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="renew" id="renew" method="GET">
                                        <button class="btn btn-danger" type="submit">OK</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--fullypaid modal-->
        <div class="modal fade" id="fullypaid">
            <div class="modal-dialog modal-sm">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h4>Loan Successfuly Paid!</h4>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
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
        <!--confirmation modal-->
        <div class="modal fade" id="confirmation-modal">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <div class="modal-body" style="">
                            <h4>Are you sure you want to close this account?</h4>
                        </div>
                        <div class="modal-footer">
                            <div class="row">
                                <div class="col-md-6">
                                <form method="GET" action="/accounts/{{$account->id}}/close-account">
                                    <button class="btn btn-primary" type="submit" onclick="localstorage.removeItem('loan_cycle')">YES</button>
                                </form>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">NO</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--payout modal-->
        <div class="modal fade" id="payout-modal">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <form method="GET" action="payout">
                            <div class="modal-body" style="">
                                <div class="form-group">
                                    <h4>Please input the amount you want to payout. <br><h6><i>(New Interest payment will be reflected in the next cycle.)</i></h6></h4>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="payout_amount" class="form-control" placeholder="Enter amount">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">OK</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--revert modal-->
        <div class="modal fade" id="revert-modal">
            <div class="modal-dialog modal-md">
                <div class="modal-content" style="border: 0;">
                    <div class="modal-header" style="background: #0d7b5d;color: white;">
                        <h6 style="">System Information</h6>
                        <label class="modal-close" data-dismiss="modal" style="margin: 0; color: white;" data-toggle="modal">X</label>
                        </div>
                        <form method="GET" action="revert">
                            <div class="modal-body" style="">
                                <div class="form-group">
                                    <h4>Are you sure you want to revert this Account to <strong>Interest Only?</strong></h4>
                                    <div class="mb-2"></div>
                                    <span style="color: red"><i><strong>WARNING: </strong>Please note that this current account will be <strong>CLOSED</strong>, and a new account with <strong>INTEREST ONLY</strong> will be created. All pending balances in this account will be sum up and the amount paid by client will be deducted to the principal amount.</i></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit" >Yes</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger" type="button" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="preloader" style="display: none"><div class="loader"></div></div>
    @endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        var ar = $('#tbl-payments').DataTable({
        pageLength: 50,
        searching: false,
	    processing: true,
	    serverSide: true,
	    ajax: '/payment/{{$account->id}}/pay-schedules',
	    columns: [
            {data: 'due_date', name: 'ammortization.due_date', orderable: false},
	        {data: 'due_ammount', name: 'ammortization.due_ammount', orderable: false},
            {data: 'balance', name: 'ammortization.balance', orderable: false},
            {data: 'balance', name: 'ammortization.balance', orderable: false},
            {data: 'penalty', name: 'ammortization.penalty', orderable: false},
            {data: 'days_due', name: 'ammortization.days_due', orderable: false},
            {data: 'ammortization_status', name: 'ammortization_status', orderable: false},
	        {data: 'action', name: 'action', orderable: false, searchable: false}
	    ]
	    });
    </script>
    <script src="{{asset('js/pages/payment/edit.js')}}"></script>
@endsection
