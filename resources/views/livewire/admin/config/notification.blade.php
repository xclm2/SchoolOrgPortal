<div class="container-fluid">
    <div class="card">
        <div class="card-header pb-0">
            <h6 class="mb-0">{{ __('Notification Settings') }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-5 col-sm-8">
                    <label for="sendVia">Send Via</label>
                    <select wire:model.change="enabled" id="sendVia" class="form-select-sm form-select">
                        @foreach(\App\Models\NotificationConfig::TYPES as $value => $label)
                            <option value="{{$value}}">{{$label}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr/>
            <div class="row">
                <div class="col-md-5 col-sm-8">
                    <form wire:submit="saveConfig">
                    @if($enabled == \App\Models\NotificationConfig::TYPE_EMAIL)
                        <div class="form-group mb-3">
                            <label for="senderEmail">Sender Email</label>
                            <input wire:model="senderEmail" class="form-control form-control-sm" type="email" id="senderEmail" placeholder="support@example.com">
                            @error('senderEmail')
                                <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="senderName">Sender Name</label>
                            <input wire:model="senderName" class="form-control form-control-sm" type="text" id="senderName" placeholder="Support">
                            @error('senderName')
                                <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    @elseif($this->enabled == \App\Models\NotificationConfig::TYPE_ITEXMO)
                        <div class="form-group mb-3">
                            <label for="itexmoApiCode">API Code</label>
                            <input wire:model="itexmoApiCode" class="form-control form-control-sm" type="text" id="itexmoApiCode" placeholder="TR-*****">
                            @error('itexmoApiCode')
                                <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="itexmoEmail">Account Email</label>
                            <input wire:model="itexmoEmail" class="form-control form-control-sm" type="email" id="itexmoEmail" placeholder="itexmoaccount@example.com">
                            @error('itexmoEmail')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="itexmoPassword">Account Password</label>
                            <input wire:model="itexmoPassword" class="form-control form-control-sm" type="password" id="itexmoPassword" placeholder="*******">
                            @error('itexmoPassword')
                            <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    Livewire.on('notification-config-saved', () => {
        Swal.fire({
            title: 'Saved!',
            icon: 'success',
            timer: 1000
        });
    });
</script>
@endscript
