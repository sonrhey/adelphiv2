@extends('layouts.app')
@section('title', 'Add Penalty')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
            
                    <form method="POST" action="{{URL('penalties')}}">
                        
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Percentage</label>
                                <input class="form-control" type="number" name="percentage" required placeholder="%">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <button class="btn btn-primary float-right" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger float-right" href="{{ URL::to('penalties') }}">Back</a>
                            </div>
                        </div>
                              
                    </form>
                </div>
            </div>
        </div>
    @endsection

