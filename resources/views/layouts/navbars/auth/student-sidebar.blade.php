
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('/') }}">
            <img src="/images/logo.png" alt="img-blur-shadow" class="img-fluid">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('/') ? 'active' : '') }}" href="{{ url('/') }}">
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-clock ps-2 pe-2 text-center text-dark {{ (Request::is('user-management') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Timeline</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('profile') ? 'active' : '') }}" href="{{ url('profile') }}">
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-user ps-2 pe-2 text-center text-dark {{ (Request::is('profile') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
        <div class="card card-background shadow-none card-background-mask-secondary" id="sidenavCard">
            <div class="full-background" style="background-image: url('../assets/img/curved-images/white-curved.jpeg')"></div>
            <div class="card-body text-start p-3 w-100">
                <div class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                    <i class="ni ni-diamond text-dark text-gradient text-lg top-0" aria-hidden="true" id="sidenavCardIcon"></i>
                </div>
                <div class="docs-info">
                    <h6 class="text-white up mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold">Please check our docs</p>
                    <a href="/documentation/getting-started/overview.html" target="_blank" class="btn btn-white btn-sm w-100 mb-0">Documentation</a>
                </div>
            </div>
        </div>
    </div>
</aside>
