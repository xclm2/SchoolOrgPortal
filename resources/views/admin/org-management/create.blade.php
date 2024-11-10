<div class="container-fluid organization-create">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Organization Information</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form wire:submit="save" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo" class="form-control-label">Logo</label>
                                    <div class="user-profile-picture" style="background-image: url('{{! is_string($logo) ? $logo->temporaryUrl() : $logo}}')">
                                        <input wire:model="logo" class="@error('logo')border border-danger rounded-3 @enderror form-control d-none js-update-profile-pic" type="file" placeholder="Name" id="logo"/>
                                        <span id="imgFileUpload">Change</span>
                                    </div>
                                    @error('logo')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="organization__banner-preview rounded-3" style="background-image: url({{(is_string($banner)) ? $banner : $banner->temporaryUrl()}})">

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="banner" class="form-control-label">Banner</label>
                                    <div class="">
                                        <input wire:model="banner" class="@error('banner') border border-danger rounded-3 @enderror form-control" type="file" placeholder="Name" id="banner"/>
                                        @error('banner')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Name</label>
                                    <div class="">
                                        <input wire:model="name" class="@error('name')border border-danger rounded-3 @enderror form-control" value="" type="text" placeholder="Name" id="name" name="name" onfocus="focused(this)" onfocusout="defocused(this)">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="course_id" class="form-control-label">Course</label>
                                    <div class="">
                                        <select wire:model="course_id" id="course_id" class="form-select">
                                            <option value=""></option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" @if($course_id == $course->id) selected @endif>{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('course')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($this->isAdmin)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="adviser" class="form-control-label">Adviser</label>
                                        <div class="input-group mb-3">
                                            <input wire:model="adviser_name" type="text" class="@error('adviser_id')border border-danger rounded-3 @enderror form-control" name="adviser_name" id="adviser" placeholder="Adviser" aria-label="Adviser">
                                            <input wire:model="adviser_id" type="hidden">
                                            <button class="btn btn-outline-primary mb-0" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#adviserList">Find</button>
                                        </div>
                                        @error('adviser_id')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status" class="form-control-label">Status</label>
                                        <div class="">
                                            <select wire:model="status" id="status" class="form-select text-capitalize">
                                                <option value=""></option>
                                                @foreach(\App\Models\Organization::STATUSES as $statusOption)
                                                    <option value="{{$statusOption}}" @if($status == $statusOption) selected @endif>{{$statusOption}}</option>
                                                @endforeach
                                            </select>
                                            @error('status')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="about">Description</label>
                            <div class="">
                                <textarea wire:model="description" class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="description"></textarea>
                            </div>
                            @error('description')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($this->isAdmin)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" id="eventsList">
                    <div class="card-header pb-0">
                        <h6 class="mb-0 w-100">Events
                            <a href="javascript:;" wire:click="downloadEvents" class="font-weight-lighter float-end text-sm"><span class="fa-solid fa-cloud-arrow-down"></span> Download</a>
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap text-sm align-items-center">
                            <span>Show:&nbsp;</span>
                            <a wire:click="filterEvents('all')" href="javascript:;" class="p-1 border-radius-sm {{$showEvent == 'all' ? 'bg-primary' : ''}}">All</a>
                            <a wire:click="filterEvents('completed')" href="javascript:;" class="p-1 border-radius-sm {{$showEvent == 'completed' ? 'bg-primary' : ''}}">Completed</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Title</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Start Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">End Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Date Posted</th>
                                        <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td class="text-center text-xs">{{$event->id}}</td>
                                        <td class="text-center text-xs">{{$event->title}}</td>
                                        <td class="text-center text-xs">{{$event->start_date}}</td>
                                        <td class="text-center text-xs">{{$event->end_date ?: $event->start_date}}</td>
                                        <td class="text-center text-xs">{{$event->created_at}}</td>
                                        <td class="text-center text-xs"><a class="text-primary" href="{{url('event/'.$event->id)}}" target="_blank">View</a></td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="px-3 mt-3">
                                {{$events->links(data: ['scrollTo' => false])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0 w-100">Members
                            <a href="javascript:;" wire:click="exportCsv" class="font-weight-lighter float-end text-sm"><span class="fa-solid fa-cloud-arrow-down"></span> Download</a>
                        </h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Members</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Requested</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($members as $member)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{$this->getImage($member->id, 'user')}}" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$member->name}} {{$member->lastname}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$member->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">{{$member->status}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{date('Y/m/d', strtotime($member->date_requested))}}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center">No Members</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="px-3">
                                {{$members->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($this->isAdmin)
        <div wire:ignore.self class="modal fade" id="adviserList" tabindex="-1" role="dialog" aria-labelledby="findAdviser" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="findAdviser">Select adviser</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Firstname
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Lastname
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                </tr>
                                <tr class="grid-filter">
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="advisers" wire:model="FILTER_NAME" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="advisers" wire:model="FILTER_LASTNAME" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="advisers" wire:model="FILTER_EMAIL" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($advisers as $adviser)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$adviser->id}}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="{{$this->getImage($adviser->id, 'user')}}" class="avatar avatar-sm me-3" alt="{{$adviser->name}}"/>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$adviser->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$adviser->lastname}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$adviser->email}}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$adviser->created_at}}</span>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm mb-0 js-select-adviser"
                                                    data-id="{{$adviser->id}}"
                                                    data-name="{{$adviser->name}} {{$adviser->lastname}}">Select
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="card-footer pb-0">
                                {{$advisers->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @script
    <script>
        document.addEventListener('livewire:navigated', () => {
            var fileupload = $(".js-update-profile-pic");
            var image = $("#imgFileUpload");
            image.click(function () {
                fileupload.click();
            });

            fileupload.change(function () {
                let imageFilePath = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                $wire.set('logo', imageFilePath)
            });

            document.querySelectorAll('.js-select-adviser').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('adviser').value = this.getAttribute('data-name');
                    $wire.set('adviser_id', this.getAttribute('data-id'));
                    $('#adviserList').modal('hide')
                });
            });

            Livewire.on('organization-saved', () => {
                Swal.fire({
                    title: 'Saved!',
                    icon: 'success',
                    timer: 1000
                });
            });
        })
    </script>
    @endscript
</div>
