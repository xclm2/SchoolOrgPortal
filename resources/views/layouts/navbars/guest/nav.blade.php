<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg my-3 {{ (Request::is('static-sign-up') ? 'w-100 shadow-none  navbar-transparent mt-4' : 'blur blur-rounded shadow py-2 start-0 end-0 mx4') }}">
        <div class="container-fluid {{ (Request::is('static-sign-up') ? 'container' : 'container-fluid') }}">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 p-0 {{ (Request::is('static-sign-up') ? 'text-white' : '') }}" href="{{ url('/') }}">
                <img src="/images/logo.png" alt="img-blur-shadow" class="img-fluid" width="150">
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a wire:navigate class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ url('/') }}">
                            <i class="fa-solid fa-house opacity-6 me-1 {{ (Request::is('/') ? '' : 'text-dark') }}"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a wire:navigate class="nav-link me-2" href="{{ url('organizations') }}">
                            <i class="fas fa-lg fa-people-group opacity-6 me-1 {{ (Request::is('organizations') ? '' : 'text-dark') }}"></i>
                            Organizations
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="{{url('login')}}" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-success">Sign In</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

</div>
