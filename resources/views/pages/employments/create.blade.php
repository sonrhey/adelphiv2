@extends('layouts.app')
@section('title', 'Add Employment')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients/'.$client.'/employments')}}">
                        {{ csrf_field() }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Company Name</label>
                                <input class="form-control" type="text" name="company_name" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Contact Number</label>
                                <input class="form-control" type="text" name="contact_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Industry</label>
                                <select class="form-control" name="industry_id" required>
                                    <option value="" selected>Select Industry</option>
                                    @foreach($industries as $industry)
                                        <option value="{{$industry->id}}">{{$industry->name}}</option>
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>

                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Position</label>
                                <input class="form-control" type="text" name="position" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Status</label>
                                <select class="form-control" name="employment_status_id" required>
                                    @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Monthly Income</label>
                                <input class="form-control" type="number" name="monthly_income" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address </label>
                                <input class="form-control" type="text" name="address" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" name="city_id" required>
                                    @foreach($city as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay_id" required>
                                    @foreach($barangay as $b)
                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay" required>
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

