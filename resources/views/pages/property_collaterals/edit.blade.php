@extends('layouts.app')
@section('title', 'Edit Property Collateral')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('accounts/'.$accounts.'/property_collaterals/'.$id)}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                         <div class="form-row align-items-center">
                            <div class="col-sm-6 my-1">
                                <label>Name Registered</label>
                                <input class="form-control" type="text" name="name_registered" value="{{$property->name_registered}}" required>
                            </div>
                            <div class="col-sm-6 my-1">
                                <label>Property Address</label>
                                <input class="form-control" type="text" name="property_address" value="{{$property->property_address}}" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>City</label>
                                <select class="form-control" type="text" name="city_id" required>
                                    <option value="" select>Select City</option>
                                    @foreach($cities as $city)
                                        @if ($property->city_id === $city->id)
                                            <option value="{{$city->id}}" selected>{{$city->name}}</option>
                                        @else
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Barangay</label>
                                <select class="form-control" type="text" name="barangay_id" required>
                                    <option value="" selected>Select Barangay</option>
                                    @foreach($barangays as $barangay)
                                        @if ($property->barangay_id === $barangay->id)
                                            <option value="{{$barangay->id}}" selected>{{$barangay->name}}</option>
                                        @else
                                            <option value="{{$barangay->id}}">{{$barangay->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Title No.</label>
                                <input class="form-control" type="number" name="title_number" value="{{$property->title_number}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Tax Declaration No.</label>
                                <input class="form-control" type="text" name="tax_declaration_number" value="{{$property->tax_declaration_number}}" required>
                            </div>


                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Lot Area</label>
                                <input class="form-control" type="number" name="lot_area" value="{{$property->lot_area}}" required step=".01">
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Unit of Measure</label>
                                <select name="unit_measure_id" required class="form-control">
                                    <option value="" selected>Select Unit of Measure</option>
                                    @foreach($unit_measures as $unit)
                                        @if ($property->unit_measure_id === $unit->id)
                                            <option value="{{$unit->id}}" selected>{{$unit->code}}</option>
                                        @else
                                            <option value="{{$unit->id}}">{{$unit->code}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Property Type</label>
                                <select name="property_type_id" required class="form-control">
                                    <option value="" selected>Select Property Type</option>
                                    @foreach($property_types as $type)
                                        @if ($property->property_type_id === $type->id)
                                            <option value="{{$type->id}}" selected>{{$type->name}}</option>
                                        @else
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-3 my-1">
                                <label>Date Acquired</label>
                                <input name="date_acquired" type="date" value="{{$property->date_acquired}}" required class="form-control">
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Acquisition Type</label>
                                <input class="form-control" type="text" name="acquisition_type" value="{{$property->acquisition_type}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Acquisition Price</label>
                                <input class="form-control" type="number" name="acquisition_price" value="{{$property->acquisition_price}}" required>
                            </div>
                            <div class="col-sm-3 my-1">
                                <label>Current Value</label>
                                <input class="form-control" type="number" name="current_value" value="{{$property->current_value}}" required>
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

