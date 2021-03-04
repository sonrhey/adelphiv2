@extends('layouts.app')
@section('title', 'Add Client')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients')}}">
                        {{ csrf_field() }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" name="birth_date" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Civil Status</label>
                                <select class="form-control" required name="civil_status_id">
                                    <option value="" selected>Select Civil Status</option>
                                    @foreach($civil_status as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Gender</label>
                                <select name="gender" required class="form-control">
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Nationality</label>
                                <select name="nationality_id" required class="form-control">
                                    @foreach($nationality as $n)
                                    <option value="{{$n->id}}">{{$n->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Landline Number</label>
                                <input class="form-control" type="text" name="landline_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email_address" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 1</label>
                                <input class="form-control" type="text" name="address_1" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city1_id" required>
                                   @foreach($city as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay1_id" required>
                                    @foreach($barangay as $b)
                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_1" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 2</label>
                                <input class="form-control" type="text" name="address_2" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city2_id" required>
                                    @foreach($city as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay2_id" required>
                                    @foreach($barangay as $b)
                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_2" required>
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

