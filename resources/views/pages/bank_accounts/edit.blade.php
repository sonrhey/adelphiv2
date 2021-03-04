@extends('layouts.app')
@section('title', 'Edit Bank Accounts')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients/'.$id.'/bank_accounts/'.$bankid)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                         <div class="form-row align-items-center">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label>Bank</label>
                                    <select class="form-control" name="bank_id" required>
                                        @foreach($banks as $bank)
                                            @if($bank->id == $bankaccount->bank_id)
                                            <option value="{{$bank->id}}" selected>{{$bank->name}} ({{$bank->code}})</option>
                                            @else
                                            <option value="{{$bank->id}}">{{$bank->name}} ({{$bank->code}})</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Branch Location</label>
                                    <textarea class="form-control" name="branch_location" required>{{$bankaccount->branch_location}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" type="text" name="account_number" value="{{$bankaccount->account_number}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Account Name</label>
                                    <input class="form-control" type="text" name="account_name" value="{{$bankaccount->account_name}}" required>
                                </div>
                                <div class="form-group">
                                    <label>Year Opened</label>
                                    <input class="form-control" type="month" name="year_opened" value="{{$bankaccount->year_opened}}" required>
                                    <small class="text-warning">
                                        <strong>Very Important:</strong> Please ensure to accurately fill out the bank account.
                                    </small>
                                </div>
                                
                            <div class="form-row align-items-center">
                                <div class="col-xs-2 my-1">
                                    <a class="btn btn-danger float-right" href="{{ URL::to('clients/'.$id.'/edit') }}">Back</a>
                                </div>
                                <div class="col-xs-2 my-1">
                                    <button class="btn btn-primary" type="submit">Save</button>
                               
                                </div>
                        </div>
                        </div>
                                                     
                    </form>
                </div>
            </div>
        </div>
    @endsection

