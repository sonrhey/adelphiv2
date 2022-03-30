@extends('layouts.app')
@section('title', 'Payment Schedule')
    @section('content')
        <div class="card">
            <div class="card-body">
            <div class="container">
                <button class="btn btn-info mb-3" onclick="printDiv1()">Print Payment Schedule</button>
                <div id="DivIdToPrint">
                    <h3>Loan Payment Schedule</h3>
                        <div class="form-group">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th colspan="2">Loan Information</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Loan Amount</td>
                                        <td>&#8369; {{$amschedule->first()->account->approved_loan_amount}}</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Type</td>
                                        <td>{{$amschedule->first()->account->loan_type->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Per 6months Interest Rate</td>
                                        <td>2%</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Terms</td>
                                        <td>18</td>
                                    </tr>
                                    <tr>
                                        <td>No. of Payments</td>
                                        <td>18</td>
                                    </tr>
                                    <tr>
                                        <td>Loan Start Date</td>
                                        <td>{{$amschedule->first()->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lender Name</td>
                                        <td>{{$amschedule->first()->account->client->first_name}} {{$amschedule->first()->account->client->last_name}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Due Amount</th>
                                        <th>Due Date</th>
                                        <th>Interest (%)</th>
                                        <th>Principal (&#8369;)</th>
                                        <th>To be Paid (&#8369;)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $count = 0; ?>
                                @foreach($amschedule as $am)
                                    <?php $count++; ?>
                                    <tr>
                                        <td>{{$count}}</td>
                                        <td>&#8369; {{number_format($am->due_ammount, 2, '.', ',')}}</td>
                                        <td>{{$am->due_date}}</td>
                                        <td>&#8369; {{number_format($am->interest, 2, '.', ',')}}</td>
                                        <td>&#8369; {{number_format($am->principal, 2, '.', ',')}}</td>
                                        <td>&#8369; {{number_format($am->balance, 2, '.', ',')}}</td>
                                        <td><b>For Payment</b></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <br>
                            <label>Approved By: </label>
                            <label>{{$amschedule->first()->account->user->first_name}} {{$amschedule->first()->account->user->last_name}}<label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('custom_css')

@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{asset('js/pages/accounts/payment_schedule/index.js')}}"></script>
    <script src="{{asset('js/pages/accounts/payment_schedule/print.min.js')}}"></script>
    <script src="{{asset('js/pages/accounts/payment_schedule/print.js')}}"></script>
@endsection