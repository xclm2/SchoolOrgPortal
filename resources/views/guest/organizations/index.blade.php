@extends('layouts.user_type.guest')

@section('content')
    <main class="main-content mt-8 organization-category">
        <section>
            <div class="container">
                <div class="row">
                    @forelse($organizations as $organization)
                        <div class="col-md-6 mb-3">
                            <div class="card">
                                <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
                                    <div class="banner d-block" style="background-image: url('{{$organization->getBanner()}}')"></div>
                                </div>

                                <div class="card-body pt-2">
                                    <a href="javascript:;" class="card-title h5 d-block text-darker">
                                        {{$organization->name}}
                                    </a>
                                    <p class="card-description mb-4">
                                        {{substr($organization->description, 0, 200)}}
                                        @if(strlen($organization->description) > 200)
                                            ... <a href="organization/{{$organization->id}}">see more</a>
                                        @endif
                                    </p>
                                    <div class="author align-items-center">
                                        <img src="./assets/img/kit/pro/team-2.jpg" alt="..." class="avatar shadow">
                                        <div class="name ps-3">
                                            <span>Mathew Glock</span>
                                            <div class="stats">
                                                <small>Posted on 28 February</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="lead">No Organizations Found.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
@endsection
