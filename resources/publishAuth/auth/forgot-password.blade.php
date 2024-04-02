@extends('layouts.app')

@section('content')
  <div class="container-fluid px-0">
    <div class="row gx-0 min-vh-100">
      <div class="col-md-9 col-lg-6 col-xl-4 px-5 d-flex align-items-center shadow">
        <div class="w-100 py-5">
          <div class="text-center"><img class="img-fluid mb-4" src="{{ asset('logo.png') }}" alt="Logo">
            <h1 class="h4 text-uppercase mb-5"></h1>
          </div>
          <div class="mb-4 text-sm">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
          </div>
          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <x-inputs.input-text property="email" label="{{ __('Email') }}" required="true" autofocus="true" classLabel="text-dark" />

            <div class="d-grid mb-5">
              <button class="btn btn-primary text-uppercase">{{ __('Email Password Reset Link') }}</button>
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
