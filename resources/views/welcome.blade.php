<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name') }}</title>

  <!-- Styles -->
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

  <style>
      a {
          color: white;
          font: 1.3em sans-serif;
          margin: .5em;
      }
      
      a:hover {
          color: #f5ef18;
      }
  </style>
</head>
<body class="app">

    @include('admin.partials.spinner')

    <div class="peers ai-s fxw-nw h-100vh">
      <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-color: #0E166B'>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <ul class="nav justify-content-end">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin') }}">Inicio</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                    @endauth
                </ul>
            @endif
        </div>
        <div class="pos-a centerXY">
          <div class="bdrs-50p pos-r" style='width: 600px;'>
            <img class="pos-a centerXY" src="/images/logo.png" alt="">
          </div>
        </div>
      </div>
    </div>
  
</body>
</html>
