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
                    <form  action="#" id="user-form">
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
                            <div class="col-lg-6">

                                    @foreach($modules as $module)
                                        @if($module->parent == 0 && $module->has_sub == 0)
                                        <div class="custom-control custom-checkbox">
                                        @foreach($useraccess as $ua)
                                            @if($ua->module_id == $module->id && $ua->grant == 1)
                                                <input type="checkbox" class="custom-control-input" name="isParent" id="isParent{{$module->id}}" value="{{ $module->id }}" checked>
                                                <label class="custom-control-label" for="isParent{{$module->id}}">{{ $module->name }}</label>
                                            @elseif($ua->module_id == $module->id && $ua->grant == 0)
                                                <input type="checkbox" class="custom-control-input" name="isParent" id="isParent{{$module->id}}" value="{{ $module->id }}">
                                                <label class="custom-control-label" for="isParent{{$module->id}}">{{ $module->name }}</label>
                                            @endif
                                        @endforeach
                                        </div>

@elseif($module->has_sub > 0 && $module->parent == 0)

    <div class="custom-control custom-checkbox">
    @foreach($useraccess as $ua)
        @if($ua->module_id == $module->id && $ua->grant == 1)
            <input type="checkbox" class="custom-control-input" name="hasSub" id="hasSub{{$module->id}}" value="{{$module->id}}" checked>
            <label class="custom-control-label" for="hasSub{{$module->id}}">{{ $module->name }}</label>

            <ul id="collapse">
            @foreach($modules as $sub_module)
                @if($sub_module->parent == $module->id)
                <li>
                    <div class="custom-control custom-checkbox">
                    @foreach($useraccess as $uaa)
                    @if($uaa->module_id == $sub_module->id && $uaa->grant == 1)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}" checked>
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @elseif($uaa->module_id == $sub_module->id && $uaa->grant == 0)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}">
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @endif
                    @endforeach
                    </div>
                <li>

                @endif
            @endforeach
        </ul>
        @elseif($ua->module_id == $module->id && $ua->grant == 0)
         <input type="checkbox" class="custom-control-input" name="hasSub" id="hasSub{{$module->id}}" value="{{$module->id}}">
            <label class="custom-control-label" for="hasSub{{$module->id}}">{{ $module->name }}</label>

            <ul id="collapse">
            @foreach($modules as $sub_module)
                @if($sub_module->parent == $module->id)
                <li>
                    <div class="custom-control custom-checkbox">
                    @foreach($useraccess as $uaa)
                    @if($uaa->module_id == $sub_module->id && $uaa->grant == 1)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}" checked>
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @elseif($uaa->module_id == $sub_module->id && $uaa->grant == 0)
                        <input type="checkbox" class="custom-control-input" name="subModule" id="subModule{{$sub_module->id}}" data-id="sub{{$module->id}}" value="{{$sub_module->id}}">
                        <label class="custom-control-label" for="subModule{{$sub_module->id}}">{{ $sub_module->name }}</label>
                    @endif
                    @endforeach
                    </div>
                <li>

                @endif
            @endforeach
        </ul>
        @endif
    @endforeach

    </div>
@endif
@endforeach
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
