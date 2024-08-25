<div>
    <h1 class="display-2">{{ $post->title }}</h1>
    <ul class="list-inline">
        <li class="list-inline-item">Begins: {{$post->start_date}}</li>
        <li class="list-inline-item">Ends: {{$post->end_date ?? $post->start_date}}</li>
    </ul>
    <div class="post-body">
        {!! $post->post !!}
    </div>
</div>
