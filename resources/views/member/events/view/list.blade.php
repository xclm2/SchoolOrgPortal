<div>
    <div class="row justify-content-end mt-3">
        <div class="col-12">
            <div class="dropdown">
                <a href="javascript:;" class="btn btn-sm btn-secondary dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                    <span class="fa-regular fa-eye"></span>&nbsp;Show
                </a>
                @if($is_adviser)
                    <button class="btn btn-sm" wire:click="download"> <span class="fa-solid fa-cloud-arrow-down"></span>&nbsp;Download</button>
                @endif
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                    <li class="{{$show == 'all' ? 'bg-gradient-primary' : ''}}">
                        <a class="dropdown-item" href="javascript:;" wire:click="setFilter('all')">All</a>
                    </li>
                    <li class="{{$show == 'completed' ? 'bg-gradient-primary' : ''}}">
                        <a class="dropdown-item" href="javascript:;" wire:click="setFilter('completed')">Completed</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if($posts->isEmpty())
        <div class="card card-frame mt-3">
            <div class="card-body">
                <h4 class="text-center m-3">No Events</h4>
            </div>
        </div>
    @else
        @foreach($posts as $post)
            <div wire:key="{{$post->id}}" class="card mt-3">
                <div class="card-body pt-2 position-relative">
                    @if(in_array($post->id, $new_posts))
                        <span class="badge badge-info bg-info position-absolute top-0" style="right: 0;">New</span>
                    @endif
                    <div class="author align-items-center">
                        <img src="{{$this->getAvatar($post->user_id)}}" alt="..." class="avatar shadow rounded-circle">
                        <div class="name ps-3">
                            <span>{{$post->name}} {{$post->lastname}}</span>
                            <div class="stats">
                                <small>Posted on {{date('F d, Y', strtotime($post->created_at))}}</small>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;" class="card-title h5 d-block text-darker mt-3">
                        {{$post->title}}
                    </a>
                    <div class="card-description mb-4">
                        {!! $this->trimString($post->post) !!}
                    </div>
                    {{-- if has image then usee carousel--}}
                    <a href="/event/{{$post->id}}/" class="text-info icon-move-right">Read More
                        <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        @endforeach
            <div class="my-3">
                {{$posts->links()}}
            </div>
    @endif

        @script
        <script>
            Livewire.on('event-created', () => {
                $wire.$refresh();
                let alert = '<div class="alert alert-success alert-dismissible fade show position-fixed bottom-0 z-index-1" style="right: 0;" role="alert">';
                alert += '<strong>Holy guacamole!</strong> You should check in on some of those fields below.'
                alert += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                document.getElementById('createPostAccordion').innerHtml += alert;
            })
        </script>
        @endscript
</div>
