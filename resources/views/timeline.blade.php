@extends('layouts.user_type.auth')

@section('content')
    <div class="page-header min-height-300 border-radius-xl justify-content-center" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
        <h2 class="text-center z-index-1" style="color:black;">Code Crusaders</h2>
    </div>
    @for($x = 1; $x <= 10; $x++)
        <div class="card mt-3">
            <div class="card-body pt-2">
                <div class="author align-items-center">
                    <img src="../assets/img/team-2.jpg" alt="..." class="avatar shadow">
                    <div class="name ps-3">
                        <span>Mathew Glock</span>
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
                <a href="/post/{{$x}}/" class="text-info icon-move-right">Read More
                    <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    @endfor
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
@endsection
