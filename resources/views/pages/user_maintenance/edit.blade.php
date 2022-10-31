@extends('layouts.app')
@section('title', 'Edit User')
    @section('content')

        <!-- Modal -->
        <div class="modal fade" id="approvemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <!-- <form action="/accounts/account->id}}/accountloanprocess/updatestatus" method="post"> -->
              <form action="#" method="post">
                   @csrf
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approval Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="accountid" value="accountid">
                    <input type="hidden" name="acctlpid">
                    <h6>Are you sure you want to approve this step?</h6>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-rounded" data-dismiss="modal">Decline</button>
                    <button type="submit" class="btn btn-success btn-rounded">Approve</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="mb-5">User Information:</h4>
                        </div>
                        <div class="col-lg-6">
                            <h4>User Access:</h4>
                        </div>
                    </div>

                    <!-- <form method="POST" action="store" id="user-form"> -->
                    <form action="#" id="user-form">
                        @csrf
                         <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{$user->last_name}}">
                                </div>

                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{$user->first_name}}">
                                </div>

                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                </div>

                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="user_type_id" class="form-control">
                                        @foreach($usertype as $us)
                                            @if($user->user_type->id == $us->id)
                                                <option value="{{ $us->id }}" selected> {{ $us->name }}</option>
                                            @else
                                                <option value="{{ $us->id }}"> {{ $us->name }}</option>
                                            @endif

                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 user-access">
                                @include('pages.user_maintenance.user_access')
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
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables/responsive.jqueryui.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
@endsection
@section('custom_js')
    <!-- Start datatable js -->
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('js/pages/user_maintenance/edit.js')}}"></script>
@endsection
