  <?php 
  if (!isset($PARENTTAG)) { //pasang kondisi jika variable parenntag belum disetting controller
    $PARENTTAG = '';
  }

  if (!isset($CHILDTAG)) { //pasang kondisi jika variable parenntag belum disetting controller
    $CHILDTAG = '';
  }

   ?>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{asset('/')}}dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SEKODING</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
        <div class="info">
          <a href="{{url('/logout/1')}}" class="d-block">Logout</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item <?= $PARENTTAG=='camps'?'menu-open':'' ?>">
            <a href="{{url('/camps')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Camp
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='camp_benefits'?'menu-open':'' ?>">
            <a href="{{url('/camp_benefits')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Camp's Benefit
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='mentor'?'menu-open':'' ?>">
            <a href="{{url('/mentor')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Master Mentor
              </p>
            </a>
          </li>
          <li class="nav-item <?= $PARENTTAG=='checkout'?'menu-open':'' ?>">
            <a href="{{url('/checkout')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Checkout List
              </p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>