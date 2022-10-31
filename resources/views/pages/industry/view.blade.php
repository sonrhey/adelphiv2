@extends('layouts.app')
@section('title', 'View Industry')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="container">
                <div class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <label>Code</label>
                        <input class="form-control" type="text" name="code" placeholder="Enter a unique Identifier" value="{{ $industry->code }}" readonly>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-sm-4 my-1">
                        <label>Name</label>
                        <input class="form-control" type="text" name="name" placeholder="Enter Industry name" value="{{ $industry->name }}" readonly>
                    </div>
                </div>
                <div class="form-row align-items-center">
                    <div class="col-xs-2 my-1">
                        <a class="btn btn-danger float-right" href="{{ URL::to('identification_list') }}">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

