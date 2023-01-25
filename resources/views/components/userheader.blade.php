  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.html">SEKODING<span>.</span></a></h1>
    
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="{{url('/')}}">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li class="dropdown"><a href="#"><span>User</span> <i class="bi bi-chevron-down"></i></a>
            @auth
            <ul style="margin-right: 10px;">
              <li><img src="{{Auth::user()->photo}}" width="50">{{Auth::user()->name}}</li>
              <li><a href="{{url('/camps/my_dashboard')}}" width="50">My Dashboard</a></li>
              <li><a href="{{url('/logout')}}">Logout</a></li>
            </ul>
            @else
            <ul style="margin-right: 10px;">
              <li><a href="{{url('/login')}}">Login</a></li>
            </ul>
            @endauth
          </li>
          <li> </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header><!-- End Header -->