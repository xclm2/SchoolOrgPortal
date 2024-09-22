<div class="container">
    <div class="organization__banner-preview border-radius-lg d-flex justify-content-center align-items-center flex-column"
         style="background: url('{{$this->getBanner($this->organization->id)}}') no-repeat center / cover; background-color: lightgray; box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.3); ">
        <h3 class="display-4 text-center text-white font-weight-bold">{{$this->organization->name}}</h3>
    </div>
    <div class="about">
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-body">
                    <p class="font-weight-bold">{{$this->organization->name}}</p>
                    <p>{{$this->organization->description}}</p>
                    <ul class="list-unstyled">
                        @if(! is_null($this->adviser))
                            <li><small><b>Adviser:</b> {{$this->adviser->name}} {{$this->adviser->lastname}}</small></li>
                        @endif
                        <li><small><b>Members:</b> {{$members}}</small></li>

                        <li><small><b>Created:</b> {{date('F d, Y', strtotime($this->organization->created_at))}}</small></li>
                    </ul>

                    @if(\Illuminate\Support\Facades\Auth::check())
                        <a class="text-success" href="javascript:;" wire:click="join({{$this->organization}})"><i class="fa-solid text-md fa-arrow-right-to-bracket"></i> &nbsp; Join</a>
                    @else
                        <a class="text-success" href="/register/organization/{{$this->organization->id}}"><i class="fa-solid text-md fa-arrow-right-to-bracket"></i> &nbsp; Join</a>
                    @endif
                </div>
            </div>

            <div class="accordion-1 card mt-3 d-none">
                <div class="accordion" id="accordionRental">
                    <div class="accordion-item">
                        <h5 class="accordion-header" id="headingOne">
                            <button class="accordion-button font-weight-bold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Gallery
                                <i class="collapse-close fa-solid fa-chevron-right text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                                <i class="collapse-open fa-solid fa-chevron-down text-xs pt-1 position-absolute end-0 me-3" aria-hidden="true"></i>
                            </button>
                        </h5>

                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionRental" style="">
                            <div class="accordion-body text-sm opacity-8">
                                We’re not always in the position that we want to be at. We’re constantly growing. We’re constantly making mistakes. We’re constantly trying to express ourselves and actualize our dreams. If you have the opportunity to play this game
                                of life you need to appreciate every moment. A lot of people don’t appreciate the moment until it’s passed.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <livewire:member.events.view.listView :$organization :lazy/>
        </div>
    </div>
</div>
