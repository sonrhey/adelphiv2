@extends('layouts.app')
@section('title', 'View Client Family')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form>
                        
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{$family->first_name}}" readonly>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" value="{{$family->middle_name}}" readonly>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{$family->last_name}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Date of Birth</label>
                                <input class="form-control" type="text" name="birth_date" value="{{$family->birth_date}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Civil Status</label>
                                <input class="form-control" type="text" name="civil_status" value="{{$family->civil_status->name}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Gender</label>
                                @if($family->gender == 1)
                                <input class="form-control" type="text" name="gender" value="Male" readonly>
                                @else
                                <input class="form-control" type="text" name="gender" value="Female" readonly>

                                @endif

                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Relation</label>
                                <input class="form-control" type="text" name="relation" value="{{$family->client_relation->name}}" readonly>
                                
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Nationality</label>
                                <input class="form-control" type="text" name="nationality" value="{{$family->nationality->name}}" readonly>
                                
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" value="{{$family->mobile_number}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Landline Number</label>
                                <input class="form-control" type="text" name="landline_number" value="{{$family->landline_number}}" readonly>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email_address" value="{{$family->email_address}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 1</label>
                                <input class="form-control" type="text" name="address_1" value="{{$family->address_1}}" readonly>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city1_id" value="" readonly>
                                    <option value="1">Cebu City</option>
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay1_id" value="" readonly>
                                    <option value="1">Bato</option>
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_1" value="{{$family->length_stay_1}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 2</label>
                                <input class="form-control" type="text" name="address_2" value="{{$family->address_2}}" readonly>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <input class="form-control" type="text" name="city_2" value="{{$family->city2->name}}" readonly>
                                
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <input class="form-control" type="text" name="city_2" value="{{$family->barangay2->name}}" readonly>
                                
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_2" value="{{$family->length_stay_2}}" readonly>
                            </div>
                        </div>  
                        <div class="col-12 my-1">
                                <a class="btn btn-danger float-left" href="{{ URL::to('clients/'.$id.'/view') }}">Back</a>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    @endsection

