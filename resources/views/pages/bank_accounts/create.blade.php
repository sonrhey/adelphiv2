@extends('layouts.app')
@section('title', 'Add Bank Accounts')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients/'.$client.'/bank_accounts')}}">
                        {{ csrf_field() }}
                         <div class="form-row align-items-center">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Bank</label>
                                    <select class="form-control" name="bank_id" required>
                                            <option>Select Bank</option>
                                        @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}} ({{$bank->code}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Branch Location</label>
                                    <textarea class="form-control" name="branch_location" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" type="text" name="account_number" required>
                                </div>
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input class="form-control" type="text" name="account_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Year Opened</label>
                                    <input class="form-control" type="month" name="year_opened" required>
                                    <small class="text-warning">
                                        <strong>Very Important:</strong> Please ensure to accurately fill out the bank account.
                                    </small>
                                </div>
                                
                             <button class="btn btn-outline-primary mb-3 float-right" type="submit">Submit</button>
                        </div>                             
                    </form>
                </div>
            </div>
        </div>
    @endsection

