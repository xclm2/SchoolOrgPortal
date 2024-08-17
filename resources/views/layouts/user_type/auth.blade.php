<?php $user = \Illuminate\Support\Facades\Auth::user(); ?>

@section('auth')
    @switch($user?->getAttribute('role'))
        @case('admin')
            <?php $sideBar = 'layouts.navbars.auth.sidebar'; ?>
            <?php $navBar  = 'layouts.navbars.auth.nav'; ?>
            @break;
        @case('adviser')
            <?php $sideBar = 'layouts.navbars.auth.adviser-sidebar'; ?>
            <?php $navBar  = 'layouts.navbars.auth.nav'; ?>
            @break;
        @default
            <?php $sideBar = 'layouts.navbars.auth.student-sidebar'; ?>
            <?php $navBar  = 'layouts.navbars.auth.nav-student'; ?>
           @break;
    @endswitch


    @if(\Request::is('static-sign-up'))
        @include('layouts.navbars.guest.nav')
        @include('layouts.footers.guest.footer')

    @elseif (\Request::is('static-sign-in'))
        @include('layouts.navbars.guest.nav')
            @yield('content')
        @include('layouts.footers.guest.footer')
    @else
        @include($sideBar)
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
            @include($navBar)
            <div class="container-fluid py-4">
                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        </main>

        @include('components.fixed-plugin')
    @endif



@endsection
