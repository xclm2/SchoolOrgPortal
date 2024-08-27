
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap">
            <img src="/images/logo.png" alt="img-blur-shadow" class="img-fluid">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('member') ? 'active' : '') }}" href="{{ url('/member') }}" wire:navigate.hover>
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="ni ni-bullet-list-67 ps-2 pe-2 text-center text-dark {{ (Request::is('member') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('member/calendar') ? 'active' : '') }}" href="{{ url('/member/calendar') }}" wire:navigate.hover>
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fa-solid fa-calendar-days ps-2 pe-2 text-center text-dark {{ (Request::is('/member/calendar') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Calendar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('member/members') ? 'active' : '') }}" href="{{ url('/member/members') }}" wire:navigate.hover>
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fa-solid fa-users ps-2 pe-2 text-center text-dark {{ (Request::is('/member/members') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Members</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('member/profile') ? 'active' : '') }}" href="{{ url('/member/profile') }}" wire:navigate.hover>
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fa-solid fa-user ps-2 pe-2 text-center text-dark {{ (Request::is('/member/profile') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ (Request::is('member/messages') ? 'active' : '') }}" href="{{ url('/member/messages') }}" wire:navigate.hover>
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fa-solid fa-message ps-2 pe-2 text-center text-dark {{ (Request::is('profile') ? 'text-white' : 'text-dark') }} " aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Group Message</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout')}}">
                    <div class="icon icon-shape icon-sm border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fa-solid fa-arrow-right-from-bracket ps-2 pe-2 text-center text-dark" aria-hidden="true"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
