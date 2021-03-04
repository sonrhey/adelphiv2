@extends('layouts.app')
@section('title', 'View Employment')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form>
                         <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Company Name</label>
                                <input class="form-control" type="text" name="company_name" value="{{$employment->company_name}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Contact Number</label>
                                <input class="form-control" type="text" name="contact_number" value="{{$employment->contact_number}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" value="{{$employment->mobile_number}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Industry</label>
                                <input class="form-control" type="text" name="industry" value="{{$employment->industry->name}}" readonly>
                            </div>
                        </div>

                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Position</label>
                                <input class="form-control" type="text" name="position" value="{{$employment->position}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Status</label>
                                <input class="form-control" type="text" name="status" value="{{$employment->employmentStatus->name}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Monthly Income</label>
                                <input class="form-control" type="number" name="monthly_income" value="{{$employment->monthly_income}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email" value="{{$employment->email}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address </label>
                                <input class="form-control" type="text" name="address" value="{{$employment->address}}" readonly>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <input class="form-control" type="text" name="city" value="{{$employment->city->name}}" readonly>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <input class="form-control" type="text" name="barangay" value="{{$employment->barangay->name}}" readonly>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay" value="{{$employment->length_stay}}" readonly>
                            </div>
                        </div>  
                        <div class="col-12 my-1">
                                <a class="btn btn-danger float-left" href="{{URL::to('clients/'.$id.'/view')}}">Back</a>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    @endsection

