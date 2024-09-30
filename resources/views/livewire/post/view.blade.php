<style>
    .comment-event:focus-visible {
        outline: none;
    }
</style>
<?php $isLoggedIn = \Illuminate\Support\Facades\Auth::check() ?>
<div class="@if($isLoggedIn) container-fluid @else container @endif">
    <div class="@if(! $isLoggedIn) mt-5 @endif">
        <h1 class="display-3 font-weight-bold">{{ $post->title }}</h1>
        <ul class="list-inline text-sm">
            <li class="list-inline-item">Begins: {{$post->start_date}}</li>
            <li class="list-inline-item">Ends: {{$post->end_date ?? $post->start_date}}</li>
        </ul>
        <div class="post-body">
            {!! $post->post !!}
        </div>

        <div class="comments">
            <div class="card">
                <div class="card-body p-3">
                    <p class="font-weight-bolder"><small>Comments</small></p>
                    @if($isLoggedIn)
                        <div class="write-comment p-1 border-1 border-radius-lg border w-lg-50 w-md-60 w-100 ">
                            <textarea class="w-100 border-0 comment-event" placeholder="Write a comment."></textarea>
                            <div class="comment-control text-end">
                                <button class="mb-0 btn btn-sm btn-secondary">Cancel</button>
                                <button class="mb-0 btn btn-sm btn-primary">Submit</button>
                            </div>
                        </div>
                    @else
                        <p><small>Please login to comment.</small></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
