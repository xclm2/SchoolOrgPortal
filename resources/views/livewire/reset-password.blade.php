<div class="container-fluid">
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                    <h4 class="mb-0">Change password</h4>
                </div>
                <div class="card-body">
                    <form wire:submit="changePassword">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div>
                            <label for="email">Email</label>
                            <div class="">
                                <input wire:model="email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password">New Password</label>
                            <div class="">
                                <input wire:model="password" id="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="">
                                <input wire:model="confirm_password" id="password-confirmation" type="password" class="form-control" placeholder="Password-confirmation" aria-label="Password-confirmation" aria-describedby="Password-addon">
                                @error('password')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Recover your password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    Livewire.on('password-reset-success', () => {
        Swal.fire({
            title: 'Success',
            icon: 'success',
            timer: 1000,
            willClose: function () {
                window.location.href = '/login'
            }
        });
    });
</script>
@endscript
