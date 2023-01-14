@extends('layouts.form')

@section('title', 'Login ')

@section('css')
<style>
    .leftside {
      background-color: #241243 !important;
      height: 100vh;
    }
    /*.rightside{

    }*/
    .login-box{  margin: 0;
      position: absolute;
      top: 50%;
      left: 30%;
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
    }

</style>
@endsection

@section('content')
<div>
  <div class="row">
    <div class="col-6 leftside">
      
    </div>
    <div class="col-6 rightside">
      <div class="login-box">
        <div class="card ">
          <div class="card-header text-center">
            <h2><b>SEKODING LOGIN USER</b></h2>
          </div>
          <div class="card-body">
            <form action="{{url('/dologin')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              
            </form>

            <div class="social-auth-links text-center mt-2 mb-3">
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
              </a>
            </div>
          </div>
        </div>
      </div>
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