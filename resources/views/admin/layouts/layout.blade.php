<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Layout &rsaquo; Default &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('stisla/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{asset('stisla/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{asset('stisla/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>



</head>
<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
  <div id="app">
    <div class="main-wrapper">
      <!-- Include Header -->
      @include('admin.layouts.header')

      <!-- Include Sidebar -->
      @include('admin.layouts.sidebar')

      <!-- Main Content -->
        @yield('content')
      </div>

      <!-- Include Footer -->
      @include('admin.layouts.footer')
    </div>
  </div>

  <script src="{{ asset('assets/js/scripts.js') }}"></script>
</body>
</html>
