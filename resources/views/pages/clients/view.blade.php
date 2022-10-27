@extends('layouts.app')
@section('title', 'View Client')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form>
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" readonly value="{{$client->first_name}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" readonly value="{{$client->middle_name}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" readonly value="{{$client->last_name}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Date of Birth</label>
                                <input class="form-control" type="date" name="birth_date" readonly value="{{$client->birth_date}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Civil Status</label>
                                <input class="form-control" type="text" name="civil_status" readonly value="{{$client->civil_status->name}}">

                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Gender</label>
                                @if($client->gender == 1)
                                <input class="form-control" type="text" name="gender" value="Male" readonly>
                                @else
                                <input class="form-control" type="text" name="gender" value="Female" readonly>

                                @endif

                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Nationality</label>
                                <input class="form-control" type="text" name="birth_date" readonly value="{{$client->nationality->name}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Mobile Number</label>
                                <input class="form-control" type="text" name="mobile_number" readonly value="{{$client->mobile_number}}">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Landline Number</label>
                                <input class="form-control" type="text" name="landline_number" readonly value="{{$client->landline_number}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 1</label>
                                <input class="form-control" type="text" name="address_1" readonly value="{{$client->address_1}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <input class="form-control" type="text" name="address_1" readonly value="{{$client->city1->name}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <input class="form-control" type="text" name="address_1" readonly value="{{$client->address_2}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_1" readonly value="{{$client->length_stay_1}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Address 2</label>
                                <input class="form-control" type="text" name="address_2" readonly value="{{$client->address_2}}">
                            </div>
                            <div class="col-sm-2 my-1">
                                <label>City</label>
                                <input class="form-control" type="text" name="address_1" readonly value="{{$client->city2->name}}">

                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Barangay</label>
                                <input class="form-control" type="text" name="address_1" readonly value="{{$client->barangay2->name}}">

                            </div>
                            <div class="col-sm-2 my-1">
                                <label>Length Stay</label>
                                <input class="form-control" type="text" name="length_stay_2" readonly value="{{$client->length_stay_2}}">
                            </div>
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
    <script type="text/javascript">
      var APP_URL = {!! json_encode(url('/')) !!};

    </script>
    <script src="{{ asset('js/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/clients/view.js')}}"></script>
@endsection
