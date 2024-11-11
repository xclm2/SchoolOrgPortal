<div class="group-message">
    <div class="card card-frame">
        <div class="card-header p-3 position-relative z-index-1" style="background-color: #fbfbfb;">
            <p class="font-weight-bold m-0">Group Message</p>
        </div>
        @if($user->role == \App\Models\User::ROLE_ADVISER || $user->role == \App\Models\User::ROLE_STUDENT && $member->status == \App\Models\Organization\Member::STATUS_ACTIVE)
        <div class="card-body">
            <div class="message-list height-600 p-2" style="overflow-y: scroll;" id="message-list">
                <?php $currentDate = null;?>
                @foreach($messages as $message)
                    <?php $messageDate = date('Y-m-d', strtotime($message->created_at))?>
                    @if ($messageDate == date('Y-m-d') && $messageDate != $currentDate)
                        <p class="my-2 text-center text-secondary"><small>Today</small></p>
                    @elseif($currentDate != $messageDate)
                        <p class="my-2 text-center text-secondary"><small>{{$messageDate}}</small></p>
                    @endif
                    <?php $currentDate = $messageDate ?>

                    {{$this->loadMessage($message, $user->id !== $message->user_id)}}
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <form method="POST" id="send-message">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" autocomplete="off" placeholder="Aa" aria-label="Aa" aria-describedby="chat_input" id="chat_input">
                    <button class="btn btn-primary mb-0" type="submit" id="chat_input">
                        Send
                        <i style="font-size: 1rem;" class="fa-regular fa-paper-plane ps-2 pe-2 text-center text-dark send-icon"></i>
                        <span class="mx-2 spinner-border spinner-border-sm d-none send-spinner" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
        @else
            <div class="card-body">
                <p>This group message is only accessible to approved members.</p>
            </div>
        @endif

    </div>
</div>
@script
<script>
    const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'ap1'});
    const channel = pusher.subscribe('{{$broadcast_on}}');
    const messageContainer = document.getElementById('message-list');

    channel.bind('chat', function (data) {
        $.post('/message/receive', {
            _token: '{{csrf_token()}}',
            message: data.message
        }).done( function (res) {
            $('.message-list').append(res);
            messageContainer.lastElementChild.scrollIntoView(false);
        })
    });

    let sending = false;
    $('#send-message').on('submit', function (e) {
        e.preventDefault();
        const message = $('form#send-message #chat_input').val();
        if (sending === true) {
            return;
        }

        if (message.trim() === '') {
            return;
        }

        sending = true;

        $('button .send-icon').addClass('d-none');
        $('button .send-spinner').removeClass('d-none');

        $.post({
           url: '/message/send',
           method: 'POST',
           headers: {
               'X-Socket-Id': pusher.connection.socket_id
           },
           data: {
               _token: '{{csrf_token()}}',
               message: message,
               org_id: {{$organization_id}},
               broadcast_on: '{{$broadcast_on}}',
           }
        }).done(function (res) {
            sending = false;
            $('.message-list').append(res);
            $('form#send-message #chat_input').val('');
            $('button .send-icon').removeClass('d-none');
            $('button .send-spinner').addClass('d-none');
            messageContainer.lastElementChild.scrollIntoView(false);
        });
    });
</script>
@endscript
