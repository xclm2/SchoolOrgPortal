<?php /**@var \App\Livewire\Admin\Manage\User $this */?>
<div>
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <td colspan="9">
                    <form wire:submit="search">
                        <div class="form-group px-3">
                            <div class="input-group mb-4 w-md-30 float-end">
                                <span class="input-group-text"><i class="fa fa-magnifying-glass"></i></span>
                                <input wire:model="searchTerm" class="form-control form-control-sm" placeholder="Search" type="text" wire:keydown.enter="search">
                                <button class="btn btn-sm btn-outline-primary mb-0" type="button">Search</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
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
