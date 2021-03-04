@extends('layouts.app')
@section('title', 'Edit Client Family')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL::to('clients/'.$id.'/family/'.$famid)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" value="{{$family->first_name}}" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" value="{{$family->middle_name}}" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" value="{{$family->last_name}}" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" name="birth_date" value="{{$family->birth_date}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Civil Status</label>
                                <select name="civil_status_id" class="form-control" required>
                                    @foreach($civil_status as $status)
                                        @if($status->id == $family->civil_status_id)
                                        <option value="{{$status->id}}" selected>{{$status->name}}</option>
                                        @else
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Gender</label>
                                <select name="gender" required class="form-control">
                                    <option value="1" {{($family->gender == 1 ? 'selected' : '')}}> Male</option>
                                    <option value="2" {{($family->gender == 2 ? 'selected' : '')}}> Female</option>
                                </select>

                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Relation</label>
                                <select name="client_relation_id" class="form-control" required>
                                    @foreach($relation as $r)
                                        @if($r->id == $family->client_relation_id)
                                        <option value="{{$status->id}}" selected>{{$r->name}}</option>
                                        @else
                                        <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Nationality</label>
                                <select name="nationality_id" class="form-control" required>
                               @foreach($nationality as $n)
                                        @if($n->id == $family->nationality_id)
                                        <option value="{{$n->id}}" selected>{{$n->name}}</option>
                                        @else
                                        <option value="{{$n->id}}">{{$n->name}}</option>
                                        @endif
                                @endforeach
                            </select>
                                
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" value="{{$family->mobile_number}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Landline Number</label>
                                <input class="form-control" type="text" name="landline_number" value="{{$family->landline_number}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Email Address</label>
                                <input class="form-control" type="email" name="email_address" value="{{$family->email_address}}" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 1</label>
                                <input class="form-control" type="text" name="address_1" value="{{$family->address_1}}" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city1_id" value="" required>
                                    @foreach($city as $c)
                                        @if($c->id == $family->city1_id)
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                        @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay1_id" value="" required>
                                    @foreach($barangay as $b)
                                        @if($b->id == $family->barangay1_id)
                                        <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                        @else
                                        <option value="{{$b->id}}">{{$b->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_1" value="{{$family->length_stay_1}}" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 2</label>
                                <input class="form-control" type="text" name="address_2" value="{{$family->address_2}}" required>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city2_id" value="" required>
                                    @foreach($city as $c)
                                        @if($c->id == $family->city2_id)
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                        @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay2_id" value="" required>
                                    @foreach($barangay as $b)
                                        @if($b->id == $family->barangay2_id)
                                        <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                        @else
                                        <option value="{{$b->id}}">{{$b->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_2" value="{{$family->length_stay_2}}" required>
                            </div>
                        </div>  
                         <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                 <a class="btn btn-danger float-right" href="{{ URL::to('clients/'.$id.'/edit') }}">Back</a>
                            </div>
                            <div class="col-xs-2 my-1">
                                <button class="btn btn-primary" type="submit">Save</button>
                               
                            </div>
                        </div>
                           
                    </form>
                </div>
            </div>
        </div>
    @endsection

