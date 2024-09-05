<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('User Information') }}</h6>
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
                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                        <div class="@error('email')border border-danger rounded-3 @enderror">
                            <input wire:model="email" class="form-control" value="{{ auth()->user()->email }}" type="email" placeholder="@example.com" id="user-email" name="email">
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
                            <input wire:model="name" class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="firstname" name="name">
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
                            <input wire:model="lastname" class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Lastname" id="lastname" name="name">
                            @error('lastname')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="course" class="form-control-label">{{ __('Course') }}</label>
                        <div class="@error('course_id')border border-danger rounded-3 @enderror">
                            <select wire:model="course_id" id="course_id" class="form-select">
                                <option value=""></option>
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}" @if($course_id == $course->id) selected @endif>{{$course->name}}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="phone" class="form-control-label">{{ __('Phone') }}</label>
                        <div class="@error('phone')border border-danger rounded-3 @enderror input-group">
                            <span class="input-group-text" id="phone_number">+63</span>

                            <input wire:model="phone" class="form-control" aria-describedby="phone_number" maxlength="10" type="number" placeholder="40770888444" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                        </div>
                        @error('phone')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="role" class="form-control-label">{{ __('Role') }}</label>
                        <div class="@error('type')border border-danger rounded-3 @enderror">
                            <select wire:model="role" name="role" id="role" class="form-select">
                                <option disabled value="">Select a role...</option>
                                <option value="admin">Admin</option>
                                <option value="adviser">Adviser</option>
                                <option value="student">Student</option>
                            </select>
                            @error('type')
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
        Livewire.on('admin-created-user', () => {
            Swal.fire({
                title: 'Added!',
                icon: 'success',
                timer: 1000,
                willClose: () => {
                    Livewire.navigate('/admin/user')
                }
            });
        });
    </script>
    @endscript
</div>
