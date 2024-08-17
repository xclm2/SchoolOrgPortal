<div class="container registration">
    asdfasdf
    <div class="organizations js-organization p-4" @if($isSubmitted) style="display: none" @endif >
        <div class="row justify-content-center text-center">
            <div class="col-12">
                <h4 class="text-center my-3">Choose the school organization you'd like to be part of.</h4>
            </div>
            @forelse($organizations as $organization)

                <div class="col-lg-3 col-4">
                    <img src="{{asset('storage/banner/images.png')}}" data-name="{{$organization->name}}" data-id="{{$organization->id}}" class="organization-item js-select-org" alt="org-logo"/>
                    <p class="text-uppercase pt-1">{{$organization->name}}</p>
                </div>
            @empty:
            <div class="col-12">
                <h4>No Organizations yet.</h4>
            </div>
            @endforelse
        </div>
    </div>
    <br class="clear" />
    <div class="registration__form js-registration-form" @if(! $isSubmitted) style="display: none" @endif>
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Profile Information') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <p class="organization-selected p-2 rounded">
                    <span class="js-organization-name"></span>
                </p>
                <form wire:submit="save" action="/register" method="POST" role="form text-left">
                    @csrf
                    <input wire:model="organization_id" type="hidden" name="organization_id" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <input wire:model="email" class="form-control" value="" type="email" placeholder="@example.com" id="user-email" name="email">
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="year" class="form-control-label">{{ __('Year') }}</label>
                                <input class="form-control" value="" type="text" placeholder="1" id="year" name="year" min="1" max="4">
                                @error('year')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="course" class="form-control-label">{{ __('Course') }}</label>
                                <select name="course" id="course" class="form-select">
                                    <option>Select</option>
                                    <option value="bsit">BS-IT</option>
                                    <option value="bsit">BEED</option>
                                    <option value="bsit">BSED</option>
                                    <option value="bsit">BSCRIM</option>
                                </select>
                                @error('course')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Firstname') }}</label>
                                <input wire:model="name" class="form-control" value="" type="text" placeholder="Name" id="user-name" name="name">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname" class="form-control-label">{{ __('Lastname') }}</label>
                                <input wire:model="lastname" class="form-control" value="" type="text" placeholder="Lastname" id="lastname" name="lastname">
                                @error('name')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                <input wire:model="phone" class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="">
                                @error('phone')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="password" class="form-control-label">{{ __('Password') }}</label>
                            <input wire:model="password" type="password" class="form-control" autocomplete="off" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                            @error('password')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-1">
                        <button class="btn btn-md mt-4 mb-4 btn-outline-secondary js-organization-remove" type="button">Back</button>
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        (function () {
            document.addEventListener('livewire:navigated', () => {
                let organization = document.querySelector('.js-organization-name');
                document.querySelectorAll('.js-select-org').forEach(btn => {
                    btn.addEventListener('click', function () {
                        Livewire.find('{{$this->id()}}').set('organization_id', this.getAttribute('data-id'), false);
                        organization.innerHTML = this.getAttribute('data-name');
                        organization.parentElement.style.display = 'block';
                        $('.js-registration-form').fadeIn();
                        $('.js-organization').hide();
                    });
                });

                document.querySelector('.js-organization-remove').addEventListener('click', function () {
                    organization.innerHTML = '';
                    organization.parentElement.style.display = 'none';
                    $('.js-organization').fadeIn();
                    $('.js-registration-form').hide();
                });
            }, {once: true})
        })();
    </script>
</div>
