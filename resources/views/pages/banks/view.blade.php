@extends('layouts.app')
@section('title', 'View Bank')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">

                    <form method="get">
                         <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Code</label>
                                <input class="form-control" type="text" name="code" value="{{$banks->code}}" readonly>
                            </div>

                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" value="{{$banks->name}}" readonly>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-primary float-right" href="{{ URL::to('banks') }}">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection

