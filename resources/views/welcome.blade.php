<div class="homepage">
    <div class="container-fluid py-5 px-xl-8 px-md-6 px-sm-4">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h3 class="display-5">Welcome to <strong>Buenavista Community College</strong> Organization Portal.</h3>
                <p class="lead">Your gateway to staying connected and engaged with school activities, events, and opportunities.</p>
                <a class="btn btn-primary" href="register">Sign Up Now</a>
                <button class="btn btn-dark">Explore Organizations</button>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <img src="/images/hero1.png" alt="teeest" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="bg-gradient-faded-primary-vertical">
        <div class="d-flex flex-wrap features justify-content-center mt-5 px-5 py-4">
            <div class="col-12">
                <h3 class="text-center text-white">Features</h3>
            </div>
            <div class="feature-item col-md-4 col-lg-3 shadow-lg">
                <h5><i class="fa-regular fa-calendar-check text-primary"></i> Event Management and Calendar</h5>
                <p>A comprehensive event management system where admins can create, edit, and manage events. The calendar displays all upcoming school events, meetings, and deadlines in an organized view.</p>
            </div>
            <div class="feature-item col-md-4 col-lg-3 shadow-lg">
                <h5><i class="fa-regular fa-bell text-warning"></i> SMS Notifications & Reminders</h5>
                <p> Automatic SMS notifications when new events are posted, along with reminder alerts sent a day before an event begins.</p>
            </div>
            <div class="feature-item col-md-4 col-lg-3 shadow-lg">
                <h5><i class="fa-solid fa-tv text-dark"></i> Student and Adviser Dashboard</h5>
                <p>A personalized dashboard for students and advisers where they can view upcoming events, register for activities, and manage their SMS notification preferences.</p>
            </div>
        </div>
    </div>
    <div class="container-fluid px-xl-8 px-md-6 px-sm-4">
        <h3 class="text-center mt-4">Upcoming Events</h3>
        <div class="d-flex flex-grow-1 justify-content-center flex-wrap gap-2  mt-4">
            @forelse($upcomingEvents as $event)
                <div class="organization-event">
                    <div class="card card-frame">
                        <div class="card-body">
                            <p class="font-weight-bolder text-uppercase">{{date('F', strtotime($event->start_date))}}<br/>
                                <span class="display-6 event-date">{{date('d', strtotime($event->start_date))}}</span>
                                @if($event->end_date)
                                    <span class="display-6 event-date"> -{{date('d', strtotime($event->end_date))}}</span>
                                @endif
                            </p>
                            <p class="font-weight-bold">{{$event->name}}</p>
                            <p>{{$event->title}}</p>
                        </div>
                        <div class="card-footer">
                            <a href="organization/{{$event->organization_id}}/event/{{$event->id}}" class="link-info">Read more &nbsp;<i class="fa-solid fa-arrow-right-long"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="display-5">No Events</p>
            @endforelse
        </div>
    </div>
</div>
