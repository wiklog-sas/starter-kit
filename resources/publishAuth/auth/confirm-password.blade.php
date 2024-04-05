@extends('layouts.app')

@section('content')
  <div class="container-fluid px-0">
    <div class="row gx-0 min-vh-100">
      <div class="col-md-9 col-lg-6 col-xl-4 px-5 d-flex align-items-center shadow bg-couleur1">
        <div class="w-100 py-5">
          <div class="text-center"><img class="img-fluid mb-4" src="{{ asset('logo.png') }}" alt="Logo">
            <h1 class="h4 text-uppercase mb-5"></h1>
          </div>

          <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-inputs.input-password property="password" label="{{ __('Password') }}" placeholder="{{ __('Password') }}" required="true" />

            <div class="flex justify-end mt-4">
              <button class="btn btn-primary text-uppercase">{{ __('Confirm') }}</button>
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
