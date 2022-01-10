@extends('attendee/partials/app1')

@section('content')
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="POST"  action="{{ route('register') }}">
        @csrf
        <h3>Sign Up</h3>
        <p> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Name</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix @error('name') is-invalid @enderror" type="text" autocomplete="name" placeholder="Name" id="name" name="name"  value="{{ old('name') }}"/>
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix @error('email') is-invalid @enderror" type="email" autocomplete="email" placeholder="Email" id="email" name="email"  value="{{ old('email') }}" />
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Phone</label>
            <div class="input-icon">
                <i class="fa fa-phone"></i>
                <input class="form-control placeholder-no-fix @error('phone') is-invalid @enderror" type="number" autocomplete="phone" placeholder="Phone" id="phone" name="phone"  value="{{ old('phone') }}" />
                @error('phone')
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
                <input class="form-control placeholder-no-fix @error('password') is-invalid @enderror" type="password" autocomplete="password" placeholder="Password" id="password" name="password" />
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Password</label>
            <div class="input-icon">
                <i class="fa fa-check"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="new-password" placeholder="Re-type Password" id="password-confirm" name="password_confirmation" />
            </div>
        </div>
        <br>
        <div class="form-actions">
            <button id="register-back-btn" href="{{ url()->previous() }}" type="button" class="btn grey-salsa btn-outline"> Back </button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up </button>
        </div>
    </form>

    <div>
        <p> Already have an account?&nbsp;
            <a href="/login" id="register-btn"> Login here </a>
        </p>
    </div>
    <div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="googleplus" data-original-title="Goole Plus" href="redirect"> </a>
            </li>
        </ul>
    </div>
    <!-- END LOGIN FORM -->
</div>
@endsection
