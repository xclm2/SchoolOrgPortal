<div class="card mt-3">
    <div class="card-body pt-2">
        <div class="author align-items-center">
            <img src="../assets/img/team-2.jpg" alt="..." class="avatar shadow">
            <div class="name ps-3">
                <span>Mathew Glock {{$post->id}}</span>
                <div class="stats">
                    <small>Posted on 28 February</small>
                </div>
            </div>
        </div>
        <div class="post-content mt-3">
            <a href="javascript:;" class="card-title h5 d-block text-darker">
                Shared Coworking
            </a>
            <p class="card-description mb-4">
                Use border utilities to quickly style the border and border-radius of an element. Great for images, buttons.
            </p>
        </div>
        {{-- if has image then usee carousel--}}
        <a href="/post/{{$post->id}}/" class="text-info icon-move-right">Read More
            <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
        </a>
    </div>
</div>
