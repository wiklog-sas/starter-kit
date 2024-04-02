<!DOCTYPE html>
<html>

<head lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  {{-- title --}}
  <title>@yield('title', env('APP_NAME'))</title>

  {{-- Meta --}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="refresh" content="{{ config('session.lifetime') * 59 }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex">
  <meta name="theme-color" content="#464646" />
  <meta name="description" content="@yield('description', 'Site web de Laravel Template')" />
  <meta name="author" content="Site web de Laravel Template">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="keywords" content="@yield('keywords', 'intranet')">

  {{-- favicon --}}
  {{-- <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
  <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
  <meta name="msapplication-TileColor" content="#2a737a">
  <meta name="msapplication-TileImage" content="{{ asset('favicon/apple-icon-144x144.png') }}">

  <link rel="icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('favicon/favicon.ico') }}" type="image/x-icon"> --}}

  {{-- Google fonts - Popppins for copy --}}
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&amp;display=swap" rel="stylesheet">

  @vite(['resources/scss/app.scss', 'resources/js/app.js'])

  @yield('extraHead')

</head>

<body>

  @auth
    @include('commun.header')
    @include('commun.toast')
    @include('commun.menu')
  @endauth

  <div class="content">

    @yield('content')

  </div>

  <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-center">
        <div class="mx-2 px-2">
          <p class="mb-2 mb-md-0"><a href="{{ route('accueil') }}">Site web Laravel Template</a></p>
        </div>
        <div class="mx-2 px-2">
          <p class="mb-0">
            Réalisation <a href="https://wiklog.fr">Wiklog</a>
          </p>
        </div>
        <div class="mx-2 px-2">
          <p class="mb-0">
            {{ version('v') }}
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script type="module">
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>

  @yield('endScripts')
</body>

</html>
