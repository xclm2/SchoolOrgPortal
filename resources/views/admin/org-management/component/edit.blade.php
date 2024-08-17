<div class="card">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">Organization Information</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form wire:submit="save" method="POST" role="form text-left">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="logo" class="form-control-label">Logo</label>
                        <div class="">
                            @if ($logo)
                                <img src="{{! is_string($logo) ? $logo->temporaryUrl() : $logo}}" alt="logo" class="organization__logo-preview"/>
                            @endif
                                <input wire:model="logo" class="@error('logo')border border-danger rounded-3 @enderror form-control" type="file" placeholder="Name" id="logo"/>
                            @error('logo')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @if ($banner)
                <img src="{{(is_string($banner)) ? $banner : $banner->temporaryUrl()}}" alt="banner" class="organization__banner-preview"/>
            @endif

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
                        <label for="slogan" class="form-control-label">Slogan</label>
                        <div class="">
                            <input class="@error('slogan')border border-danger rounded-3 @enderror form-control" value="" type="text" placeholder="Slogan" id="slogan" name="slogan" onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('slogan')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="adviser" class="form-control-label">Adviser</label>
                        <div class="input-group mb-3">
                            <input type="text" class="@error('adviser_id')border border-danger rounded-3 @enderror form-control" name="adviser" id="adviser" placeholder="Adviser" aria-label="Adviser">
                            <input wire:model="adviser_id" type="hidden">
                            <button class="btn btn-outline-primary mb-0" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#adviserList">Find</button>
                        </div>
                        @error('adviser_id')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="about">Description</label>
                <div class="">
                    <textarea wire:model="description" class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="description"></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Save Changes</button>
            </div>
        </form>
    </div>
</div>
