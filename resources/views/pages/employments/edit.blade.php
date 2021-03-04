@extends('layouts.app')
@section('title', 'Edit Employment')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients/'.$id.'/employments/'.$employment_id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                         <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Company Name</label>
                                <input value="{{$employment->company_name}}" class="form-control" type="text" name="company_name" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Contact Number</label>
                                <input value="{{$employment->contact_number}}" class="form-control" type="text" name="contact_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input value="{{$employment->mobile_number}}" class="form-control" type="text" name="mobile_number" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Industry</label>
                                <select class="form-control" name="industry_id" required>
                                    @foreach($industries as $industry)
                                        @if($industry->id == $employment->industry_id)
                                        <option value="{{$industry->id}}" selected>{{$industry->name}}</option>
                                        @else
                                        <option value="{{$industry->id}}" selected>{{$industry->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                               
                            </div>
                        </div>

                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Position</label>
                                <input value="{{$employment->position}}" class="form-control" type="text" name="position" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Status</label>
                                <select class="form-control" name="employment_status_id" required>
                                    @foreach($statuses as $status)
                                    @if($status->id == $employment->employment_status_id)
                                    <option value="{{$status->id}}" selected>{{$status->name}}</option>
                                    @else
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Monthly Income</label>
                                <input value="{{$employment->monthly_income}}" class="form-control" type="number" name="monthly_income" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input value="{{$employment->email}}" class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address </label>
                                <input value="{{$employment->address}}" class="form-control" type="text" name="address" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" name="city_id" required>
                                    @foreach($city as $c)
                                    @if($c->id == $employment->city_id)
                                    <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                    @endif

                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay_id" required>
                                    @foreach($barangay as $b)
                                        @if($b->id == $employment->barangay_id)
                                    <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                    @else
                                    <option value="{{$b->id}}">{{$b->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input value="{{$employment->length_stay}}" class="form-control" type="text" name="length_stay" required>
                            </div>
                        </div>  
                        <div class="col-12 my-1">
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger" href="{{ URL::to('clients/'.$id.'/edit') }}">Back</a>
                           
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    @endsection

