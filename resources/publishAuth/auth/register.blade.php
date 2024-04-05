@extends('layouts.app')

@section('extraHead')
  {{-- {!! HCaptcha::renderJs() !!} --}}
@endsection

@section('content')
  <div class="container-fluid px-0 bg-gray">
    <div class="row gx-0 min-vh-100">
      <div class="col-12 col-md-9 col-lg-6 col-xl-4 px-3 px-md-5 d-flex align-items-center shadow">
        <div class="w-100 py-5">

          <h1 class="h2 text-primary text-center">Laravel Template</h1>

          <div class="text-center"><img class="img-fluid mb-4" src="{{ asset('logo.png') }}" alt="Logo"></div>

          <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
            @csrf

            <x-inputs.input-text property="email" label="<i class='fa-regular fa-at me-2'></i>{{ __('Email') }}" required="true" autofocus="true" />

            <x-inputs.input-text property="name" label="<i class='fa-regular fa-user me-2'></i>{{ __('First name') }}" required="true" />

            <x-inputs.input-password property="password" label="<i class='fa-solid fa-lock me-2'></i>{{ __('Password') }}" :entity="null" required="true" />

            <x-inputs.input-password property="password_confirmation" label="<i class='fa-solid fa-lock me-2'></i>{{ __('Confirm Password') }}" :entity="null" required="true" />

            {{-- <x-inputs.input-checkbox property="cg" :entity="null"
              label="J’ai pris connaissance et j’accepte les <a href='#' target='_blank'>conditions générales d’utilisation</a>" required="true" />

            <x-inputs.input-checkbox property="rgpd" :entity="null" label="J’ai pris connaissance et j’accepte notre <a href='#' target='_blank'>politique de confidentialité</a>"
              required="true" /> --}}

            {{-- {!! HCaptcha::display() !!}
            @if ($errors->has('h-captcha-response'))
              <span class="alert alert-danger small" role="alert">
                <strong class="small">{{ $errors->first('h-captcha-response') }}</strong>
              </span>
            @endif --}}

            <div class="d-grid mb-5">
              <button class="btn btn-primary text-uppercase">{{ __('Register') }}</button>
            </div>

            <div class="flex items-center justify-end mt-4">
              <a class="small" href="{{ route('login') }}">{{ __('Already registered?') }}</a>
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
