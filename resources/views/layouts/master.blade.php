<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Rota Creator') }}</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
<body class="hold-transition sidebar-mini">

<div class="wrapper" id="app">
    @yield('menus')

    <div class="content-wrapper">
    <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              @yield('content')
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div><!-- /.content -->
    </div><!-- /.content-wrapper -->


  <!-- Main Footer -->

  @yield('welcome')
  @auth
    @include('layouts.footer')
  @endauth
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>
</body>
</html>
