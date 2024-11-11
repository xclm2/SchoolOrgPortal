<!-- Navbar -->
<nav wire:ignore class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    {{$user->name}} {{$user->lastname}}
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @if($user->role == 'student')
        <script data-navigate-once>
            const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
            const channel = pusher.subscribe('{{$broadcast}}');

            channel.bind('new_event', function (data) {
                let post = JSON.parse(data.message);
                Push.create('BCC Organization Portal ', {
                    body: 'New Event Posted! ' + post.title,
                    timeout: 5000
                })
            });
        </script>
    @elseif($user->role == 'adviser')
        <script data-navigate-once>
            const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
            const channel = pusher.subscribe('{{$new_member_broadcast}}');

            channel.bind('new_member', function (data) {
                Push.create('BCC Organization Portal ', {
                    body: 'New Member Request!',
                    timeout: 5000
                })
            });
        </script>
    @endif
</nav>
<!-- End Navbar -->
