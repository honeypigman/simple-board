<!--
    Title : Section Login
    Date : 2020.12.30
//-->
<form id="loginFrm" method="POST">
  @csrf
  <input type="hidden" name="email" id="email">
  <input type="hidden" name="password" id="password">
</form>

<div class="row">
<div class=”col-12 align-center”>
  <main class="form-signin">
        <h1 class="h3 mb-3 fw-normal">{{ env('APP_NAME') }} </h1>
        <label for="inputEmail" class="visually-hidden">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" autofocus @if($errors->get('email')) autofocus @endif @if(Session::get('login_id')) value="{{ Session::get('login_id') }}" @endif required>
        <label for="inputPassword" class="visually-hidden">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" @if($errors->get('password')) autofocus @endif required>
        @foreach($errors->all() as $message)
          <div class="alert alert-danger" role="alert" id="inputAlert" style="text-align:left;font-size:8pt; padding:10px;">{{ $message }}</div>
          @break
        @endforeach
        <button class="w-100 btn btn-lg btn-primary" type="submit" id="signin">Sign in</button>
        <div class="checkbox mb-3">
        <!-- 
          
        -->
        </div>
  </main>
</div>
</div>


<script>
  $( document ).ready(function() {
    
    // 로그인
    $("#signin").click(function(){
      submit();      
    });

    $('input').keypress(function(){
      inputAlert('RESET');
    })

    $("#inputPassword").keydown(function(key){
      if (key.keyCode == 13) {
        submit();
      }
    });

    var inputAlert = function(div,msg=null){
      $("#inputAlert").empty();
      if( div == 'RESET'){
        $("#inputAlert").text('');
        $("#inputAlert").css({'display':'none'});
      }else{
        $("#inputAlert").text(msg);
        $("#inputAlert").css({'display':'block'});
      }
    }

    var submit = function(){
      var id = $("#inputEmail").val();
      var pw = $("#inputPassword").val();
      
      $("#email").val(id);
      $("#password").val(pw);
      $("#loginFrm").attr("action", "/auth/signin");
      $("#loginFrm").submit();
    }


  });
</script>