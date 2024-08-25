<div class="row">
    <div class="col-md-12">
        <div class="card card-calendar">
            <div class="card-body p-3">
                <div class="calendar" data-bs-toggle="calendar" id="calendar"></div>
            </div>
        </div>

        @script
        <script>
            setTimeout(function () {
                const events = JSON.parse('{!! $this->events !!}');
                let calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
                    initialView: "dayGridMonth",
                    headerToolbar: {
                        start: 'title', // will normally be on the left. if RTL, will be on the right
                        center: '',
                        end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
                    },
                    selectable: true,
                    editable: true,
                    initialDate: '{{date('Y-m-d')}}',
                    events: events,
                    views: {
                        month: {
                            titleFormat: {
                                month: "long",
                                year: "numeric"
                            }
                        },
                        agendaWeek: {
                            titleFormat: {
                                month: "long",
                                year: "numeric",
                                day: "numeric"
                            }
                        },
                        agendaDay: {
                            titleFormat: {
                                month: "short",
                                year: "numeric",
                                day: "numeric"
                            }
                        }
                    },
                });

                calendar.render();
            }, 200)

        </script>
        @endscript
    </div>

</div>
