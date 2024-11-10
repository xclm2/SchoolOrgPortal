<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <h5 class="mb-0">Organizations
                        <a href="javascript:;" wire:click="download" class="font-weight-lighter float-end text-sm"><span class="fa-solid fa-cloud-arrow-down"></span> Download</a>
                        <a class="mb-0 font-weight-lighter text-sm float-end" href="organization/create" wire:navigate><span class="fa-solid fa-plus"></span> New Organization &nbsp; | &nbsp; </a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Name
                                </th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    Course
                                </th>
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
                            @foreach ($organizations as $org)

                                <tr wire:key="org-{{$org->id}}" class="@if(in_array($org->id, $new_organizations)) shadow-lg @endif;">
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
                                        <p class="text-xs font-weight-bold mb-0">{{$org->course_name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0 text-uppercase">{{$org->status}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{$org->created_at}}</p>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('edit-organization', $org->id)}}"
                                           class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit Organization">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <a wire:confirm="Are you sure you want to delete this Organization?" wire:click="deleteOrg({{$org->id}})" href="javascript:;">
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
                            {{$organizations->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
    <script>
        document.addEventListener('livewire:navigated', () => {
            $wire.$refesh;
        });

        Livewire.on('organization-deleted', () => {
            Swal.fire({
                title: 'Organization Deleted!',
                icon: 'success',
                timer: 1000
            });
        });
    </script>
@endscript
