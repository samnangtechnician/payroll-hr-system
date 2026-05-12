<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="app-locale" content="{{ app()->getLocale() }}">
  <title>@yield('pageTitle', __('auth.login')) — {{ config('app.name') }}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="preload" href="{{ asset('assets/backend/assets/fonts/NotoSansKhmer.ttf') }}" as="font" type="font/ttf" crossorigin>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
<div id="app">
  <div class="container py-5" style="max-width: 480px;">
    @yield('content')
  </div>
</div>
<x-flasher />
</body>
</html>
