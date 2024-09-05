<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Users</h5>
                        </div>
                        <a class="btn bg-gradient-primary btn-sm mb-0" type="button" href="/admin/user/create" wire:navigate.hover>+&nbsp; Add</a>
                    </div>
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
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
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
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient">Create Adviser</h3>
                        </div>
                        <div class="card-body pb-3">
                            <form role="form text-left">
                                <label>Firstname</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="name-addon">
                                </div>
                                <label>Lastname</label>
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                                </div>
                                <label>Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                <div class="text-left">
                                    <button type="button" class="btn bg-gradient-primary btn-lg w-md-30 w-100 mt-4 mb-0">Create</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-sm-4 px-1">
                            <p class="mb-4 mx-auto">
                                Already have an account?
                                <a href="javascrpt:;" class="text-primary text-gradient font-weight-bold">Sign in</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
