@extends('layouts.app')
@section('title', 'Edit Client')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('clients/'.$id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" required value="{{$client->first_name}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" required value="{{$client->middle_name}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" required value="{{$client->last_name}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" name="birth_date" required value="{{$client->birth_date}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Civil Status</label>
                                <select name="civil_status_id" class="form-control" required>
                                    @foreach($civil_status as $status)
                                        @if($status->id == $client->civil_status_id)
                                        <option value="{{$status->id}}" selected>{{$status->name}}</option>
                                        @else
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                               
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Gender</label>
                                <select name="gender" required class="form-control">
                                    <option value="1" {{($client->gender == 1 ? 'selected' : '')}}> Male</option>
                                    <option value="2" {{($client->gender == 2 ? 'selected' : '')}}> Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Nationality</label>
                                <select name="nationality" required class="form-control">
                                    @foreach($nationality as $n)
                                        @if($n->id == $client->nationality_id)
                                        <option value="{{$n->id}}" selected>{{$n->name}}</option>
                                        @else
                                        <option value="{{$n->id}}">{{$n->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" required value="{{$client->mobile_number}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Landline Number</label>
                                <input class="form-control" type="text" name="landline_number" required value="{{$client->landline_number}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 1</label>
                                <input class="form-control" type="text" name="address_1" required value="{{$client->address_1}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city1_id" required>
                                    @foreach($city as $c)
                                        @if($c->id == $client->city1_id)
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                        @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay1_id" required>
                                    @foreach($barangay as $b)
                                        @if($b->id == $client->barangay1_id)
                                        <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                        @else
                                        <option value="{{$b->id}}">{{$b->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_1" required value="{{$client->length_stay_1}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 2</label>
                                <input class="form-control" type="text" name="address_2" required value="{{$client->address_2}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city2_id" required>
                                    @foreach($city as $c)
                                        @if($c->id == $client->city2_id)
                                        <option value="{{$c->id}}" selected>{{$c->name}}</option>
                                        @else
                                        <option value="{{$c->id}}">{{$c->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay2_id" required>
                                    @foreach($barangay as $b)
                                        @if($b->id == $client->barangay2_id)
                                        <option value="{{$b->id}}" selected>{{$b->name}}</option>
                                        @else
                                        <option value="{{$b->id}}">{{$b->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_2" required value="{{$client->length_stay_2}}">
                            </div>
                        </div>  
                        <div class="col-12 my-1">
                                <button class="btn btn-primary float-right" type="submit">Submit</button>
                        </div>      
                    </form>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Family Member</h3>
                        <a class="btn btn-success btn-xs float-right" href="family/create">Add New</a>
                    </div>
                    <table class="table table-striped" id="tbl-family">
                        <thead>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Relation</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Bank Accounts</h3>
                        <a class="btn btn-success btn-xs float-right" href="bank_accounts/create">Add New</a>
                    </div>
                    <table class="table table-striped" id="tbl-bank">
                        <thead>
                            <th>Account Name</th>
                            <th>Account Number</th>
                            <th>Branch Location</th>
                            <th>Year Opened</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
         <div class="card mt-5">
            <div class="card-body">
                <div class="container">
                    <div class="clearfix">
                        <h3 class="header-title float-left">Employments</h3>
                        <a class="btn btn-success btn-xs float-right" href="employments/create">Add New</a>
                    </div>
                    <table class="table table-striped" id="tbl-employment">
                        <thead>
                            <th>Company Name</th>
                            <th>Postion</th>
                            <th>Length of Stay</th>
                            <th>Monthly Income</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    @endsection

@section('custom_css')
    <link href="{{ asset('js/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('custom_js')
    <script src="{{ asset('js/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/clients/edit.js')}}"></script>
@endsection