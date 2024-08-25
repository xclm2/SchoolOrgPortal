<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Profile') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form wire:submit="save" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                <span class="alert-text text-white">
                {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                <span class="alert-text text-white">
                {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profilePicture" class="form-control-label">Profile Picture</label>
                                <div class="user-profile-picture" style="background-image: url('{{! is_string($profilePicture) ? $profilePicture->temporaryUrl() : $profilePicture}}')">
                                    <span class="user-profile-picture__change" id="imgFileUpload">CHANGE</span>
                                </div>
                                <input wire:model="profilePicture" class="@error('logo')border border-danger rounded-3 @enderror form-control d-none js-update-profile-pic" type="file" placeholder="Name" id="logo"/>

                                @error('profilePicture')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input readonly wire:model="email" class="form-control" value="{{ $user->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="firstname" class="form-control-label">{{ __('Firstname') }}</label>
                                <div class="@error('firstname')border border-danger rounded-3 @enderror">
                                    <input wire:model="name" class="form-control" value="{{ $user->name }}" type="text" placeholder="Name" id="firstname" name="name">
                                    @error('firstname')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lastname" class="form-control-label">{{ __('Lastname') }}</label>
                                <div class="@error('lastname')border border-danger rounded-3 @enderror">
                                    <input wire:model="lastname" class="form-control" value="{{ $user->lastname }}" type="text" placeholder="Lastname" id="lastname" name="name">
                                    @error('lastname')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                                <div class="@error('phone')border border-danger rounded-3 @enderror">
                                    <input wire:model="phone" class="form-control" type="tel" placeholder="40770888444" id="phone" name="phone" value="{{ $user->phone }}">
                                    @error('phone')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>
            </div>
            @script
            <script>
                $(function () {
                    var fileupload = $(".js-update-profile-pic");
                    var image = $("#imgFileUpload");
                    image.click(function () {
                        fileupload.click();
                        // alert('sdf');
                    });
                    fileupload.change(function () {
                        let imageFilePath = $(this).val().split('\\')[$(this).val().split('\\').length - 1];
                        $wire.set('profilePicture', imageFilePath)
                    });

                    Livewire.on('profile-saved', () => {
                        Swal.fire({
                            title: 'Profile Updated!',
                            icon: 'success',
                            timer: 1000
                        });
                    });
                });
            </script>
            @endscript
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-frame">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Change Password') }}</h6>
            </div>
            <div class="card-body">
                <form wire:save="changePassword">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input wire:model="current_password" wire:keydown="checkCurrentPassword" type="password" class="form-control" id="current_password" placeholder="Current Password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="New Password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
