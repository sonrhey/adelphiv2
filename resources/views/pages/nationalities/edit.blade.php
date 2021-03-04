@extends('layouts.app')
@section('title', 'Edit Nationality')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('nationality/'.$nationalityId)}}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" required value="{{$nationality->name}}">
                            </div>
                        </div>
                        <div class="form-row align-items-center">
                            <div class="col-xs-2 my-1">
                                <button class="btn btn-primary" type="submit">Save</button>
                            </div>
                            <div class="col-xs-2 my-1">
                                <a class="btn btn-danger float-right" href="{{ URL::to('nationality') }}">Back</a>
                            </div>
                        </div>
                             
                    </form>
                </div>
            </div>
        </div>

        
    @endsection

@section('custom_css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection
@section('custom_js')
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
@endsection