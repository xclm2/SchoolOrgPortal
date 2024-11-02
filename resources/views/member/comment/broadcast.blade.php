<li class="mb-1 p-2">
    <span class="w-100 font-weight-bold">
        <small>{{$data['user_name']}}</small>
        <small class="font-weight-lighter" style="font-size: 11px;">
            @if(date('Y') == date('Y', strtotime($data['sent_at'])))
                <i>{{date('M d h:i A', strtotime($data['sent_at']))}}</i>
            @else
                <i>{{date('M d, Y h:i A', strtotime($data['sent_at']))}}</i>
            @endif

        </small>
    </span>
    <p class="m-0">{{$data['comment']}}</p>
</li>
