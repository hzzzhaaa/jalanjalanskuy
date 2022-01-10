@extends('attendee/partials/app1')

@section('content')
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="POST"  action="{{ route('register.google') }}">
        @csrf
        <input type="hidden" name="google_id" value="{{$user->id}}">
        <h3>Sign Up Your Google Account</h3>
        <p> Enter your personal details below: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Name</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix @error('name') is-invalid @enderror" type="text" autocomplete="name" placeholder="Name" id="name" name="name"  value="{{ $user->name }}"/>
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
                <input class="form-control placeholder-no-fix @error('email') is-invalid @enderror" type="email" autocomplete="email" placeholder="Email" id="email" name="email"  value="{{ $user->email}}" />
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
        <br>
        <div class="form-actions">
            <button id="register-back-btn" type="button" href="{{ url()->previous() }}" class="btn grey-salsa btn-outline"> Back </button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right"> Sign Up </button>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
@endsection
