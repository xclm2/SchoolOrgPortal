<div class="container-fluid organization-category">
    <h3 class="text-center">Organizations</h3>
    <div class="row justify-content-center gap-3">
        @forelse($organizations as $organization)
            <div class="col-md-5 col-lg-3 col-12 mb-3 card shadow-sm">
                <div class="card-body pt-3 px-2">
                    <div class="banner d-block border-radius-md" style="background-image: url('{{$organization->getBanner()}}'); background-color: lightgray"></div>
                    <a href="organization/{{$organization->id}}" class="d-block text-darker mt-2">
                        <span class="card-title h5">{{$organization->name}}</span>
                        @if(isset($courses[$organization->course_id]))
                            <span class="text-muted text-secondary"><small>({{$courses[$organization->course_id] ?? ''}})</small></span>
                        @endif
                    </a>

                    <p class="card-description mb-0">
                        {{substr($organization->description, 0, 200)}}
                        @if(strlen($organization->description) > 200)
                            ... <a href="organization/{{$organization->id}}">see more</a>
                        @endif
                    </p>
                </div>
                <div class="card-footer pt-0 px-0 pb-3 text-center">
                    <a href="organization/{{$organization->id}}" class="w-100 text-info">View Organization</a>
                </div>
            </div>
        @empty
            <p class="lead">No Organizations Found.</p>
        @endforelse
    </div>
</div>
