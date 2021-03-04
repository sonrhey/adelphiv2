@extends('layouts.app')
@section('title', 'Add Barangay')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
            
                    <form method="POST" action="{{URL('barangays/'.$barangay->id)}}">
                        @csrf
                        @method('PATCH')
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" required value="{{ $barangay->name }}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>City</label>
                                <select class="form-control" name="city_id">
                                @foreach($city as $c)
                                    @if($barangay->city_id == $c->id)
                                        <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
                                    @else
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endif
                                    
                                @endforeach
                                </select>
                            </div>                           
                            
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <button class="btn btn-primary float-right" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger float-right" href="{{ URL::to('barangays') }}">Back</a>
                            </div>
                        </div>
                              
                    </form>
                </div>
            </div>
        </div>
    @endsection

