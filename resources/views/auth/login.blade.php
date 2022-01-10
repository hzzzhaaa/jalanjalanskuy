@extends('attendee/partials/app1')

@section('content')
    <!-- BEGIN LOGIN -->
    <div class="content">
        <!-- BEGIN LOGIN FORM -->
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Enter any username and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix @error('email') is-invalid @enderror" id="email" type="email" autocomplete="email" placeholder="Email" value="{{ old('email') }}" name="email" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix @error('password') is-invalid @enderror" id="password" type="password" autocomplete="current-password" placeholder="Password" name="password" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }} /> Remember me
                    <span></span>
                </label>
                <button type="submit" class="btn green pull-right"> {{ __('Login') }}</button>
                {{-- <a href="redirect" class="btn green pull-right"> Login with Google</a> --}}
            </div>
            <div class="login-options">
                <h4>Or login with</h4>
                <ul class="social-icons">
                    <li>
                        <a class="googleplus" data-original-title="Goole Plus" href="redirect"> </a>
                    </li>
                </ul>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click
                    <a href=" " id="forget-password"> here </a> to reset your password. </p>
            </div>
            <div class="create-account">
                <p> Don't have an account yet ?&nbsp;
                    <a href="/register" id="register-btn"> Create an account </a>
                </p>
            </div>
        </form>
        <!-- END LOGIN FORM -->
    </div>
    <!-- END LOGIN -->

@endsection
