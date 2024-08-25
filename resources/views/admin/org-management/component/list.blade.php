<?php /**@var \App\Livewire\Admin\Manage\Organization\Table $this */?>

<div>
    <table class="table align-items-center mb-0">
        <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                ID
            </th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Name
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Status
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Created
            </th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        @forelse ($organizations as $org)
            <tr wire:key="org-{{$org->id}}">
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">{{$org->id}}</p>
                </td>
                <td>
                    <div>
                        <img src="{{$this->getImage($org->id, 'logo')}}" class="avatar avatar-sm me-3 rounded-circle">
                    </div>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$org->name}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0"></p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0 text-uppercase">{{$org->status}}</p>
                </td>
                <td class="text-center">
                    <p class="text-xs font-weight-bold mb-0">{{$org->created_at}}</p>
                </td>
                <td class="text-center">
                    <a href="{{route('edit-organization', $org->id)}}"
                       class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Organization" wire:navigate.hover>
                        <i class="fas fa-user-edit text-secondary"></i>
                        Edit
                    </a>
                    <span><i class="cursor-pointer fas fa-trash text-secondary"></i></span>
                </td>
            </tr>
        @empty
            No Organization
        @endforelse
        </tbody>
    </table>

   <div class="card-footer pb-0">
       {{$organizations->links()}}
   </div>
</div>
