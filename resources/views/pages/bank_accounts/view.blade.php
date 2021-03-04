@extends('layouts.app')
@section('title', 'View Bank Accounts')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form>
                         <div class="form-row align-items-center">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Bank</label>
                                    <input class="form-control" type="text" name="bank_name" value="{{$bank->bankName->name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Branch Location</label>
                                    <textarea class="form-control" name="branch_location" readonly>{{$bank->branch_location}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" type="text" name="account_number" value="{{$bank->account_number}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input class="form-control" type="text" name="account_name" value="{{$bank->account_name}}" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Year Opened</label>
                                    <input class="form-control" type="month" name="year_opened" value="{{$bank->year_opened}}" readonly>
                                    <small class="text-warning">
                                        <strong>Very Important:</strong> Please ensure to accurately fill out the bank account.
                                    </small>
                                </div>
                                
                             <a class="btn btn-danger mb-3 float-left" href="{{URL::to('clients/'.$id.'/view')}}">Back</a>
                        </div>                             
                    </form>
                </div>
            </div>
        </div>
    @endsection

