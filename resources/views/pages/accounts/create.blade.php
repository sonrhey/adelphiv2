@extends('layouts.app')
@section('title', 'Add Accounts')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('accounts')}}">
                        {{ csrf_field() }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Client</label>
                                <select class="form-control" required name="client_id">
                                    <option value="" selected>Select Client</option>
                                    @foreach($clients as $client)
                                        <option value="{{$client->id}}">{{$client->first_name}} {{$client->middle_name}} {{$client->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Desired Loan Amount</label>
                                <select class="form-control" required name="loan_amount_id">
                                    <option value="" selected>Select Amount</option>
                                    @foreach($amounts as $amount)
                                        <option value="{{$amount->id}}">{{$amount->amount}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Loan Type</label>
                                <select class="form-control" required name="loan_type_id">
                                    <option value="" selected>Select Loan Type</option>
                                    @foreach($loan_types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Branch</label>
                                <select class="form-control"name="branch_id" rquired>
                                    <option value="" selected>Select Branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
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
    @endsection
