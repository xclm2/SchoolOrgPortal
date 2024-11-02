<div>
    @if($totalComments > $limit)
        <a href="javascript:;" wire:click="loadMore" class="text-sm">Load more</a>
    @endif
    <ul id="comments_container" class="list-unstyled" style="line-height: 1rem; max-height: 500px; overflow-y: auto;">
        @foreach($comments as $comment)
            <li class="mb-1 p-2">
                <span class="w-100 font-weight-bold">
                    <small>{{$comment->name . ' ' . $comment->lastname}}</small>
                    <small class="font-weight-lighter" style="font-size: 11px;">
                        @if(date('Y') == date('Y', strtotime($comment->created_at)))
                            <i>{{date('M d h:i A', strtotime($comment->created_at))}}</i>
                        @else
                            <i>{{date('M d, Y h:i A', strtotime($comment->created_at))}}</i>
                        @endif

                    </small>
                </span>
                <p class="m-0">{{$comment->comment}}</p>
            </li>
        @endforeach
    </ul>
</div>
