<!--
    Title : Header Layout 
    Date : 2020.12.30
//-->
<!doctype html>
<html lang="ko">
  <head>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>{{ env('APP_NAME') }}</title>
    <script src="/js/jquery.min.js"></script>
    <link href="{{ mix('/css/common.css') }}" rel="stylesheet">
  </head>

  @if( Request::segment(1) == 'admin' )
    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="/admin">{{ env('APP_NAME') }}</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <input class="form-control left w-100" type="text" value="{{ Session::get('login_id') }} / {{ Session::get('login_time') }}" disabled>
      <ul class="navbar-nav px-3">
          <li class="nav-item text-nowrap">
          <a class="nav-link" href="/auth/signout">Sign out</a>
          </li>
      </ul>
    </header>
    @include('layout/nav')
  @endif

  <body class="text-center">


  <div class="container-fluid">
  <div class="row">
  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    @yield('content')
  </main>
  
  @include('layout.bottom')