 <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-primary">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="{{url('home')}}"><img src=" {{ asset('images/Flexydial-logo.png') }}" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{url('home')}}"><img src="{{ asset('images/Flexydial-logo.png') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="fas fa-bars"></span>
        </button>

       <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
             <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   @if(isset(Auth::user()->name)) {{ Auth::user()->name }}@endif <span class="caret"></span>
                                </a>

            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              @if(isset(Auth::user()->admin_status) && Auth::user()->admin_status == '1')
               <a class="dropdown-item" href="{{url('registration')}}">
                <i class="fas fa-cog text-primary"></i>
                New Registeration
              </a>
              @else
              <a class="dropdown-item" href="{{url('centralclient')}}">
                <i class="fas fa-cog text-primary"></i>
                Switch to Central Users
              </a>
              @endif
              <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="{{ url('userprofile') }}">
               <i class="fa fa-user-circle text-primary"></i>
               User Profile
            </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ url('/logout') }}">
               <i class="fas fa-power-off text-primary"></i>
               Logout
            </a>

            </div>
          </li>
        <!--   <li class="nav-item nav-settings d-none d-lg-block">
            <a class="nav-link" href="#">
              <i class="fas fa-ellipsis-h"></i>
            </a>
          </li> -->
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="fas fa-bars"></span>
        </button>
      </div>
    </nav>
