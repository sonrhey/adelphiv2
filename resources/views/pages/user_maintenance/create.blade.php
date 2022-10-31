@extends('layouts.app')
@section('title', 'Add User')
    @section('content')
        <div class="card">
            <div class="card-body">
                <div class="container">

                    <form method="POST" action="{{URL('usermaintenance/store_user')}}">
                        @csrf
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Middle Name</label>
                                <input type="text" name="middle_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>User Type</label>
                                <select name="user_type_id" class="form-control" required>
                                    @foreach($usertype as $us)
                                        <option value="{{ $us->id }}"> {{ $us->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-row align-items-center">
                                <div class="col-xs-2 my-1">
                                    <button class="btn btn-primary float-right" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

