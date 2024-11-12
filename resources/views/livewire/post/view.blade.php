<?php $isLoggedIn = \Illuminate\Support\Facades\Auth::check() ?>
<div class="@if($isLoggedIn) container-fluid @else container @endif">
    <style>
        .comment-event:focus-visible {
            outline: none;
        }
    </style>
    <div class="@if(! $isLoggedIn) mt-5 @endif">
        <h1 class="display-3 font-weight-bold">{{ $post->title }}</h1>
        <ul class="list-inline text-sm">
            <li class="list-inline-item">Begins: {{$post->start_date}}</li>
            <li class="list-inline-item">Ends: {{$post->end_date ?? $post->start_date}}</li>
        </ul>
        <div class="post-body">
            {!! $post->post !!}
        </div>

        <div class="comments mt-4">
            <div class="card">
                <div class="card-body p-3">
                    <p class="font-weight-bolder"><small>Comments:</small></p>
                    <livewire:member.events.comments :$post/>
                    @if($isLoggedIn)
                        @if ($member_id != 0)
                        <div class="write-comment p-1 border-1 border-radius-lg border w-lg-50 w-md-60 w-100 ">
                            <form id="send-comment">
                                @csrf
                                <textarea id="comment" class="w-100 border-0 comment-event" placeholder="Write a comment."></textarea>
                                <div class="comment-control text-end">
                                    <button class="mb-0 btn btn-sm btn-secondary">Cancel</button>
                                    <button class="mb-0 btn btn-sm btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                        @script
                        <script>
                            const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
                            const channel = pusher.subscribe('{{$broadcast_on}}');
                            const commentsContainer = document.getElementById('comments_container');
                            channel.bind('comment', function (data) {
                                $.post('/comments/receive', {
                                    _token: '{{csrf_token()}}',
                                    message: data
                                }).done( function (res) {
                                    $('#comments_container').append(res);
                                    commentsContainer.lastElementChild.scrollIntoView(false);
                                })
                            });

                            let sending = false;
                            $('#send-comment').on('submit', function (e) {
                                e.preventDefault();
                                const comment = $('form#send-comment #comment').val();
                                if (sending === true) {
                                    return;
                                }

                                if (comment.trim() === '') {
                                    return;
                                }

                                sending = true;

                                $('button .send-icon').addClass('d-none');
                                $('button .send-spinner').removeClass('d-none');
                                $.post({
                                    url: '/comments/send',
                                    method: 'POST',
                                    headers: {
                                        'X-Socket-Id': pusher.connection.socket_id
                                    },
                                    data: {
                                        _token: '{{csrf_token()}}',
                                        comment: comment,
                                        post_id: {{$post_id}},
                                        member_id: '{{$member_id}}',
                                        broadcast_on: '{{$broadcast_on}}'
                                    }
                                }).done(function (res) {
                                    sending = false;
                                    $('#comments_container').append(res);
                                    $('form#send-comment #comment').val('');
                                    $('button .send-icon').removeClass('d-none');
                                    $('button .send-spinner').addClass('d-none');
                                    commentsContainer.lastElementChild.scrollIntoView(false);
                                });
                            });
                        </script>
                        @endscript
                        @endif
                    @else
                        <p><small>Please login to comment.</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
