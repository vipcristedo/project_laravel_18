@extends('backend.layouts.loginMaster')
@section('title')
Đăng ký
@endsection
@section('login-box-msg')
Sign in to start your session
@endsection
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="input-group mb-3">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Full name" autofocus>
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-user"></span>
        </div>
      </div>
      @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="input-group mb-3">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-envelope"></span>
        </div>
      </div>
      @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="input-group mb-3">
      <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required placeholder="Address">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fa fa-address-card" aria-hidden="true"></span>
        </div>
      </div>
      @error('address')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>
    
    <div class="input-group mb-3">
      <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required placeholder="Phone">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fa fa-phone" aria-hidden="true"></span>
        </div>
      </div>
      @error('phone')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="input-group mb-3">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
      @error('password')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
      @enderror
    </div>

    <div class="input-group mb-3">
      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Retype password">
      <div class="input-group-append">
        <div class="input-group-text">
          <span class="fas fa-lock"></span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-8">
        <div class="icheck-primary">
          <input type="checkbox" id="agreeTerms" name="terms" value="agree">
          <label for="agreeTerms">
           I agree to the <a href="#">terms</a>
          </label>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
        <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
      </div>
      <!-- /.col -->
    </div>
</form>
@endsection
@section('or')
<p class="mb-1">
    <a href="#">I forgot my password</a>
</p>
<p class="mb-0">
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
</p>
@endsection
