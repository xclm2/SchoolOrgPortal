<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        @if (env('IS_DEMO'))
            <x-demo-metas></x-demo-metas>
        @endif

        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <title>BCC Organization Portal</title>
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <!-- Nucleo Icons -->
        <link href="{{ URL::asset('/assets/css/nucleo-icons.css') }} " rel="stylesheet" />
        <link href="{{ URL::asset('/assets/css/nucleo-svg.css') }} " rel="stylesheet" />

        <!-- Font Awesome Icons -->
        <link href="{{ URL::asset('/assets/css/nucleo-svg.css') }} " rel="stylesheet" />

        <!-- CSS Files -->
        <link id="pagestyle" href="{{URL::asset('/assets/css/soft-ui-dashboard.css')}}" rel="stylesheet" />
        <link id="pagestyle" href="{{URL::asset('/css/app.css')}}" rel="stylesheet" />
        <script src="{{ URL::asset('/assets/js/jQuery.js') }}" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <x-head.tinymce-config/>
        @livewireStyles
    </head>
    <body class="g-sidenav-show  bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
    <?php $user = \Illuminate\Support\Facades\Auth::user(); ?>
    <?php $navBar  = 'layouts.navbars.auth.nav'; ?>

    @switch($user?->getAttribute('role'))
        @case('admin')
                <?php $sideBar = 'layouts.navbars.auth.sidebar'; ?>
            @break;
        @case('adviser')
                <?php $sideBar = 'layouts.navbars.auth.adviser-sidebar'; ?>
            @break;
        @case('student')
                <?php $sideBar = 'layouts.navbars.auth.student-sidebar'; ?>
            @break;
        @default
                <?php $navBar  = 'layouts.navbars.guest.nav' ?>
                <?php $sideBar = '' ?>
            @break;
    @endswitch

    @if(! empty($sideBar)) @include($sideBar) @endif
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg {{ (Request::is('rtl') ? 'overflow-hidden' : '') }}">
        <div class="container-fluid" style="min-height: 90vh;">
            @include($navBar)
            @if(session()->has('success'))
                <div x-data="{ show: true}"
                     x-init="setTimeout(() => show = false, 4000)"
                     x-show="show"
                     class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
                    <p class="m-0">{{ session('success')}}</p>
                </div>
            @endif
            {{$slot}}
        </div>
    </main>
    @include('layouts.footers.auth.footer')

    @livewireScripts

        <!--   Core JS Files   -->
        <script src="{{ URL::asset('/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/core/bootstrap.min.js') }}" data-navigate-once></script>
        <script src="{{ URL::asset('/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/plugins/fullcalendar.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/plugins/chartjs.min.js') }}"></script>
        <script src="{{ URL::asset('/assets/js/plugins/flatpickr.min.js') }}"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>

        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ URL::asset('/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}" data-navigate-track data-navigate-once></script>
    </body>
</html>
