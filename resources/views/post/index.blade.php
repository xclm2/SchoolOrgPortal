@extends('layouts.user_type.auth')

@section('content')
    <div class="card mb-3">
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
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Comments</h6>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="avatar me-3">
                                <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Sophie B.</h6>
                                <p class="mb-0 text-xs">Hi! I need more information..</p>
                            </div>
                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="avatar me-3">
                                <img src="../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                            </div>
                            <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">Anne Marie</h6>
                                <p class="mb-0 text-xs">Awesome work, can you..</p>
                            </div>
                            <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                        </li>
                    </ul>
                    {{-- lazy load 5 items--}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Comment" aria-label="Comment">
                            <button class="btn btn-outline-primary mb-0" type="button" id="button-addon2">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
