<div class="registration my-5 px-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-8 {{$this->role == \App\Models\User::ROLE_ADVISER ? 'd-none' : ''}}">
            <div class="organizations js-organization p-4 pt-0">
                <div class="row justify-content-center text-center">
                    <div class="col-12 mb-3">
                        <h4 class="text-center mb-3">Choose the school organization you'd like to be part of.</h4>
                    </div>
                    @forelse($organizations as $organization)
                        @if($organization->course_id == $course_id || $organization->course_id === null)
                            <div wire:key="{{$organization->id}}" class="col-lg-3 col-4">
                                <img wire:click="selectOrg({{$organization->id}},'{{$organization->name}}')" src="{{$this->getLogo($organization->id)}}" data-name="{{$organization->name}}" data-id="{{$organization->id}}" class="organization-item js-select-org" alt="org-logo"/>
                                <p class="text-uppercase pt-1">{{$organization->name}}</p>
                            </div>
                        @endif
                    @empty:
                    <div class="col-12">
                        <h4>No Organizations yet.</h4>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-5 col-lg-4">
            <div class="registration__form js-registration-form">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                    </div>
                    <div class="card-body">
                        <p class="organization-selected rounded text-uppercase {{$this->role == \App\Models\User::ROLE_ADVISER ? 'd-none' : ''}}">
                            <span class="font-weight-bold">{{$selected_org}}</span>
                        </p>
                        @error('organization_id')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                        <form wire:submit="save" role="form text-left">
                            @csrf
                            <input wire:model="organization_id" type="hidden" name="organization_id" value="">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                        <input wire:model="email" class="form-control" value="" type="email" placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">{{ __('Firstname') }}</label>
                                        <input wire:model="name" class="form-control" value="" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="lastname" class="form-control-label">{{ __('Lastname') }}</label>
                                        <input wire:model="lastname" class="form-control" value="" type="text" placeholder="Lastname" id="lastname" name="lastname">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="course" class="form-control-label">{{ __('Course') }}</label>
                                        <div class="@error('course_id')border border-danger rounded-3 @enderror">
                                            <select wire:model.change="course_id" id="course_id" class="form-select">
                                                <option value=""></option>
                                                @foreach($courses as $course)
                                                    <option value="{{$course->id}}">{{$course->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('course_id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="role" class="form-control-label">{{ __('Choose Account Type') }}</label>
                                        <div class="@error('role') border border-danger rounded-3 @enderror">
                                            <select wire:model.change="role" id="role" class="form-select text-capitalize">
                                                <option value="{{\App\Models\User::ROLE_STUDENT}}">{{\App\Models\User::ROLE_STUDENT}}</option>
                                                <option value="{{\App\Models\User::ROLE_ADVISER}}">{{\App\Models\User::ROLE_ADVISER}}</option>

                                            </select>
                                            @error('role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                                        <div class="@error('phone')border border-danger rounded-3 @enderror input-group">
                                            <span class="input-group-text" id="phone_number">+63</span>
                                            <input wire:model="phone" class="form-control" aria-describedby="phone_number" type="number" placeholder="9077088844">
                                        </div>
                                    </div>
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                    <input wire:model="password" type="password" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center gap-1 flex-lg-row flex-md-column flex-sm-row flex-wrap">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Register</button>
                                <a href="{{ url('login') }}">Already have an account ?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
