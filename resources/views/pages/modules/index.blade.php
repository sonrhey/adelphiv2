@extends('layouts.app')
@section('title', 'Modules')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <form method="POST" action="{{URL('storemodule')}}">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-sm-4 my-1">
                                <label>Name</label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Module Type</label>
                                <select class="form-control" name="_type" required>
                                    <option></option>
                                    <option value="1">Is Parent</option>
                                    <option value="2">Sub Module</option>
                                </select>
                            </div>
                            <div class="col-sm-4 my-1">
                                <label>Parent</label>
                                <select id="parent" class="form-control" name="parent">
                                    
                                </select>
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

@section('custom_js')
   
    <script src="{{asset('js/pages/modules/index.js')}}"></script>
@endsection