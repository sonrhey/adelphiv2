@extends('layouts.app')
@section('title', 'Edit Accounts')
    @section('content')
        @if($process > 0)
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Loan Process</h3>
                    </div>
                    <ul class="list-unstyled multi-steps">
                        @foreach($acctloanprocess as $alp)
                            @if($alp->status == 1)
                                <li class="is-active" data-value="{{ $alp->id }}" data-acctid="{{ $alp->account_id }}" id="finstep">{{ $alp->loanprocess->name }}</li>
                            @elseif($alp->status == 2)
                                <li data-value="{{ $alp->id }}">{{ $alp->loanprocess->name }}</li>
                            @elseif($alp->status == 0)
                                <li data-value="{{ $alp->id }}">{{ $alp->loanprocess->name }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="approvemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="/accounts/{{$account->id}}/accountloanprocess/updatestatus" method="post">
                   @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approval Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="accountnumber" value="{{$account->account_number}}">
                    <input type="hidden" name="acctlpid">
                    <h6>Are you sure you want to approve this step?</h6>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Decline</button>
                    <button type="submit" class="btn btn-success btn-rounded">Approve</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h5 class="mb-5">Account Number: {{$account->account_number}}</h5>
                    <form method="POST" action="{{URL('accounts', $account->id)}}">
                        {{ csrf_field() }}
                        @method('PATCH')
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Client</label>
                                <select class="form-control" required name="client_id">
                                    <option value="" selected>Select Client</option>
                                    @foreach($clients as $client)
                                        @if($client->id == $account->client_id)
                                             <option value="{{$client->id}}" selected>{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}</option>
                                        @else
                                            <option value="{{$client->id}}">{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Loan Amount</label>
                                <select class="form-control" required name="loan_amount_id">
                                    <option value="" selected>Select Amount</option>
                                    @foreach($amounts as $amount)
                                        @if($account->loan_amount_id == $amount->id)
                                            <option value="{{$amount->id}}" selected>{{$amount->amount}}</option>
                                        @else
                                            <option value="{{$amount->id}}">{{$amount->amount}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Approved Loan Amount</label>
                                <select class="form-control"name="approved_load_amount_id">
                                    <option value="" selected>Select Approved Amount</option>
                                    @foreach($amounts as $amount)
                                        @if($amount->id == $account->approved_load_amount_id)
                                            <option value="{{$amount->id}}" selected>{{$amount->amount}}</option>
                                        @else
                                            <option value="{{$amount->id}}">{{$amount->amount}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Loan Type</label>
                                <select class="form-control" required name="loan_type_id">
                                    <option value="" selected>Select Loan Type</option>
                                    @foreach($loan_types as $type)
                                        @if($type->id == $account->loan_type_id)
                                            <option value="{{$type->id}}" selected>{{$type->name}}</option>
                                        @else
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Branch</label>
                                <select class="form-control"name="branch_id" rquired>
                                    <option value="" selected>Select Branch</option>
                                    @foreach($branches as $branch)
                                        @if($branch->id == $account->branch_id)
                                            <option value="{{$branch->id}}" selected>{{$branch->name}}</option>
                                        @else
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Status</label>
                                <select class="form-control" name="account_status_id" rquired>
                                    <option value="" selected>Status</option>
                                    @foreach($statuses as $status)
                                        @if($status->id == $account->account_status_id)
                                            <option value="{{$status->id}}" selected>{{$status->name}}</option>
                                        @else
                                            <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endif

                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-12 my-1">
                                <button class="btn btn-primary float-right" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if(count($acctloanprocess) > 0)
            @if($acctloanprocess[2]->status == 1)
            <div class="card mt-5">
                <div class="card-body">
                    <div class="container">
                        <div class="clearfix">
                            <h3 class="header-title float-left">Temporary Payment Schedule</h3>
                            <button class="btn btn-danger btn-xs float-right" onclick="printDiv()">Print Schedule</button>
                        </div>
                        <div class="payment-schedule">
                            <div class="form-group">
                                <h4>Account Number: {{$account->account_number}} - Payment Schedule</h4>
                            </div>
                            <table class="table table-striped" id="tbl-payments">
                                <thead>
                                    <tr>
                                        <th>Due Date</th>
                                        <th>(&#8369;) Due Amount</th>
                                        <th>(&#8369;) Interest</th>
                                        <th>(&#8369;) Principal</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        @endif
        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Property Collateral</h3>
                        <a class="btn btn-success btn-xs float-right" href="property_collaterals/create">Add New</a>
                    </div>
                    <table class="table table-striped" id="tbl-property-collaterals">
                        <thead>
                            <th>Name Registered</th>
                            <th>Property Address</th>
                            <th>Lot Area</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Identification</h3>
                        <!-- <a class="btn btn-success btn-xs float-right" href="property_collaterals/create">Add New</a> -->
                    </div>
                    <form action="/accounts/store" method="post" id="identification">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="account_id" value="{{$account->id}}">
                                <select class="form-control" name="idlist">
                                    <option selected disabled>Select ID</option>
                                    @foreach($identificationlist as $il)
                                        <option value="{{$il->id}}">{{$il->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3"></div>
                        <table class="table table-striped" id="id-list">
                            <thead>
                                <tr>
                                    <th>ID Name</th>
                                    <th>ID Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="idlistdata">
                            </tbody>
                        </table>
                        <div class="mb-5"></div>
                        <button class="btn btn-primary float-right" type="submit">Submit</button>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/property_collaterals/edit.js')}}"></script>
    <script src="{{asset('js/pages/identification/edit.js')}}"></script>
    <script src="{{asset('js/pages/accounts/payment_schedule/print.min.js')}}"></script>
    <script src="{{asset('js/pages/accounts/payment_schedule/print.js')}}"></script>
    <script src="{{asset('js/pages/accounts/payment_schedule/schedules.js')}}"></script>
@endsection

