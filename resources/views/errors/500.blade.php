@extends('layout/header')

@section('content')
<div class="alert alert-danger" role="alert" style="width:100%">
  <h1 class="alert-heading"> 500. That’s an error :(</h1>
  <p>오류가 발생하여 요청을 수행할 수 없다.</p>
  <hr>
  <p class="mb-0">Copyright@CHACHA. All rights reserved</p>
</div>
@endsection
<script> setInterval(function(){ location.href="/"; }, 3000);</script>
<!-- 참고.https://ko.wikipedia.org/wiki/HTTP_%EC%83%81%ED%83%9C_%EC%BD%94%EB%93%9C -->