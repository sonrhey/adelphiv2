@extends('layouts.app')
@section('title', 'View City')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
            
                    <form method="get">
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="{{$city->name}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger float-right" href="{{ URL::to('cities') }}">Back</a>
                            </div>
                        </div>
                              
                    </form>
                </div>
            </div>
        </div>
    @endsection

