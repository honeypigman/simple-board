@extends('layout/header')

@section('content')
<div class="alert alert-danger" role="alert" style="width:100%">
  <h1 class="alert-heading"> 408. That’s an error :(</h1>
  <p>요청 대기가 시간을 초과하였다.</p>
  <hr>
  <p class="mb-0">Copyright@CHACHA. All rights reserved</p>
</div>
@endsection
<script> setInterval(function(){ location.href="/"; }, 3000);</script>
<!-- 참고.https://ko.wikipedia.org/wiki/HTTP_%EC%83%81%ED%83%9C_%EC%BD%94%EB%93%9C -->