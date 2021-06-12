<div class="container">
  <nav class="row navbar navbar-expand-lg navbar-light bg-light">
    <a href="{{ url('/') }}" class="navbar-brand" data-aos="zoom-in">
      <img src="{{ url('frontend/images/logo.png') }}" alt="Logo GODREAM">
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" 
    data-toggle="collapse" data-target="#navb">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navb">
      <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item mx-md-2">
          <a href="{{ url('/') }}" class="nav-link active">Home</a>
        </li>
        <li class="nav-item mx-md-2">
          <a href="{{ url('paket') }}" class="nav-link">Paket Travel</a>
        </li>
        <li class="nav-item mx-md-2 dropdown">
          <a href="#" class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
            Services
          </a>
          <div class="dropdown-menu">
            <a href="#" class="dropdown-item">Contack</a>
            <a href="#" class="dropdown-item">Passport</a>
            <a href="#" class="dropdown-item">Visa</a>
          </div>
        </li>
        <li class="nav-item mx-md-2">
          <a href="#testimonialContent" class="nav-link">Testimonial</a>
        </li>
      </ul>
      @guest
            <!-- mobile button -->
        <form class="form-inline d-sm-block d-md-none">
          <button class="btn btn-login my-2 my-sm-0" type="button" 
          onclick="event.preventDefault(); location.href='{{ url('login') }}';">
            Masuk
          </button>
        </form>
        <!-- Desktop button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block">
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="button" 
          onclick="event.preventDefault(); location.href='{{ url('login') }}';">
            Masuk
          </button>
        </form>
      @endguest

      @auth
          <!-- mobile button -->
        <form class="form-inline d-sm-block d-md-none" action="{{ url('logout') }}"
        method="POST">
        @csrf
          <button class="btn btn-login my-2 my-sm-0" type="submit">
            Keluar
          </button>
        </form>
        <!-- Desktop button -->
        <form class="form-inline my-2 my-lg-0 d-none d-md-block" action="{{ url('logout') }}"
        method="POST">
        @csrf
          <button class="btn btn-login btn-navbar-right my-2 my-sm-0 px-4" type="submit">
            Keluar
          </button>
        </form>
      @endauth
    </div>
  </nav>
</div>