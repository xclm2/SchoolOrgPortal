<div class="courses">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Courses') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td><h6 class="mb-0 text-xs">{{$course->name}}</h6></td>
                                        <td class="align-middle">
                                            <a wire:click="edit({{$course->id}},'{{$course->name}}')" href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Add/Edit Course') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form wire:submit="save">
                        <div class="form-group">
                            <label for="course">Course</label>
                            <input wire:model="name" type="text" class="form-control" id="course">
                            @error('name')
                                <p class="text-danger text-sm">{{$message}}</p>
                            @enderror
                        </div>
                        <button class="btn btn-sm btn-outline-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
