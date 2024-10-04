<div class="message-item d-flex gap-1 w-100 mb-4 justify-content-end">
    <div class="message-container max-width-500">
        <p class="mb-1 px-1 text-end"><small class="font-weight-bold">You</small> <small class="text-muted">{{$data['sent_at'] ?? ''}}</small></p>
        <p class="px-3 py-1 my-auto align-content-center shadow-sm border-radius-lg">{{$data['message'] ?? ''}}</p>
    </div>
    <div class="avatar p-1"><img src="{{$data['user_avatar'] ?? ''}}" alt="{{$data['user_name'] ?? ''}}" class="w-100 rounded-circle shadow-sm"></div>
</div>
