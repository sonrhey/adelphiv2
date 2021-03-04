@extends('layouts.authenticationform')

@section('content')
<div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100">
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Template</p>
                    </div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username">Username</label>
                            <input type="text" id="username" class="focused {{ $errors->has('username') ? ' is-invalid' : '' }} " name="username" value="{{ old('username') }}" required>
                            <i class="ti-email"></i>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    <script>
                                        if($('input#username').hasClass("is-invalid")){
                                            $('.form-gp').addClass("focused");
                                            $('.invalid-feedback').css({"display":"block", "position" : "absolute"});
                                        }
                                    </script>
                                @endif
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="focused {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                            <i class="ti-lock"></i>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    <script>
                                        if($('input#password').hasClass("is-invalid")){
                                            $('.form-gp').addClass("focused");
                                            $('.invalid-feedback').css({"display":"block", "position" : "absolute"});
                                        }
                                    </script>
                                @endif
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="rememberme" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="rememberme">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
