<div>
    <?php /** @var \App\Models\Organization $organization */ ?>
    <div class="page-header min-height-300 border-radius-xl justify-content-center"
         style="background-image: url('{{$organization->getBanner()}}'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
        <h2 class="text-center z-index-1 text-uppercase" style="color:black;">{{$organization->name}}</h2>
    </div>
    <div class="timeline">
        @forelse($posts as $post)
            <livewire:post.item :$post :key="$post->id"/>
            @livewire(\App\Livewire\Post\Item::class, ['post' => $post], key($post->id))
        @empty
            <h1>No posts yet.</h1>
        @endforelse
        <div class="my-3">
            {{$posts->links()}}
        </div>
    </div>

    <div class="modal fade" id="comments" tabindex="-1" role="dialog" aria-labelledby="comments" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Post title</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
