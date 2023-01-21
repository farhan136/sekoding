@extends('layouts.form')

@section('title', 'Login')

@section('css')
<style>
    body {background-color: #243763 !important;}
    .login-box{  margin: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }

</style>
@endsection

@section('content')
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <h2><b>SEKODING</b></h2>
    </div>
    <div class="card-body">
      <form action="{{url('/do_login_admin')}}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock" id="hidetransparant"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password (Not Ready)</a>
      </p>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
   $('#hidetransparant').on('click', function(){
    if($('#password').attr('type') == 'password'){
      $('#password').attr('type', 'text')  
    }else{
      $('#password').attr('type', 'password')
    }
   });
</script>
@endsection