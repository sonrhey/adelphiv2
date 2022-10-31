@extends('layouts.app')
@section('title', 'Add Identification List')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">

                    <form method="POST" action="{{URL('identification_list')}}">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Code</label>
                                <input class="form-control" type="text" name="code" placeholder="Enter a unique Identifier" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter Industry name" required>
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <button class="btn btn-primary float-right" type="submit">Submit</button>
                            </div>
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger float-right" href="{{ URL::to('identification_list') }}">Back</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection

