<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Users

                        <a href="javascript:;" wire:click="download" class="font-weight-lighter float-end text-sm"><span class="fa-solid fa-cloud-arrow-down"></span> Download</a>
                        <a class="mb-0 font-weight-lighter text-sm float-end" href="/admin/user/create" wire:navigate><span class="fa-solid fa-plus"></span> New User &nbsp; | &nbsp; </a>
                    </h5>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
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
                                        Course
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                <tr class="grid-filter">
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="users" wire:model="FILTER_NAME" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="users" wire:model="FILTER_LASTNAME" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"><input wire:keydown.enter="users" wire:model="FILTER_EMAIL" class="form-control form-control-sm" type="text"/></th>
                                    <th class="grid-filter_item"><select wire:change="users" wire:model="FILTER_COURSE" id="course_id" class="form-select form-select-sm">
                                            <option value=""></option>
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" @if($FILTER_COURSE == $course->id) selected @endif>{{$course->name}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th class="grid-filter_item">
                                        <select wire:change="users" wire:model="FILTER_ROLE" name="role" id="role" class="form-select form-select-sm">
                                            <option value=""></option>
                                            <option value="admin">Admin</option>
                                            <option value="adviser">Adviser</option>
                                            <option value="student">Student</option>
                                        </select>
                                    </th>
                                    <th class="grid-filter_item"></th>
                                    <th class="grid-filter_item"><button wire:click="resetFilter" class="btn btn-sm btn-primary m-0">Reset</button></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="{{$this->getImage($user->id, 'user')}}" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->lastname}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-uppercase">{{$user->course_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-uppercase">{{$user->role}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{url('admin/user/view', ['id' => $user->id])}}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a wire:confirm="Are you sure you want to delete this User?" wire:click="deleteUser({{$user->id}})" href="javascript:;">
                                            <span>
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer pb-0">
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    Livewire.on('user-deleted', () => {
        Swal.fire({
            title: 'User Deleted!',
            icon: 'success',
            timer: 1000
        });
    })
</script>
@endscript
