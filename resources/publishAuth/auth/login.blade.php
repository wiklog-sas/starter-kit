@extends('layouts.app')

@section('content')
  <div class="container-fluid px-0 bg-gray">
    <div class="row gx-0 min-vh-100">
      <div class="col-md-9 col-lg-6 col-xl-4 px-5 d-flex align-items-center shadow">
        <div class="w-100 py-5">

          <h1 class="h2 text-primary text-center">Laravel Template</h1>

          <div class="text-center"><img class="img-fluid mb-4" src="{{ asset('logo.png') }}" alt="Logo">
          </div>

          <form action="{{ route('login') }}" method="post">
            @csrf

            <x-inputs.input-text property="email" label="<i class='fa-regular fa-at me-2'></i>{{ __('Email') }}" required="true" autofocus="true" />

            <x-inputs.input-password property="password" label="<i class='fa-solid fa-lock me-2'></i>{{ __('Password') }}" :entity="null" required="true" />

            <div class="form-check mb-4">
              <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label class="custom-control-label" for="remember">{{ __('Remember me') }}</label>
            </div>

            <div class="d-grid mb-5">
              <button class="btn btn-primary text-uppercase">{{ __('Login') }}</button>
            </div>

            <div class="row">
              <div class="col-12 col-md-6 mb-3">
                <a class="small" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
              </div>
              <div class="col-12 col-md-6">
                <a class="small" href="{{ route('register') }}">{{ __('Create your account') }}</a>
              </div>
            </div>

          </form>
        </div>
      </div>
      <div class="col-md-3 col-lg-6 col-xl-8 d-none d-md-block">
        <div class="bg-login h-100"></div>
      </div>
    </div>
  </div>
@endsection
