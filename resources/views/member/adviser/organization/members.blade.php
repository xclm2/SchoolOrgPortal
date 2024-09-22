<?php /**@var \App\Livewire\Member\Adviser\Organization\Members $this */ ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <h6>Active Members</h6>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Member</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Joined</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($members as $member)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{$this->getAvatar($member->id)}}" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$member->name}} {{$member->lastname}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$member->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{date('Y/m/d', strtotime($member->joined_at))}}</span>
                                    </td>
                                    @if($this->isAllowEdit())
                                        <td class="align-middle">
                                            <a href="javascript:;" wire:click="deleteMember({{$member->member_id}})"
                                               wire:confirm="Are you sure you want to delete this member?"
                                               class="text-danger font-weight-bold text-xs cursor-pointer" data-toggle="tooltip" data-original-title="Remove from Organization">
                                                Remove
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr><td colspan="4"><p class="text-center m-0">No Active Members</p></td></tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="px-3">
                            {{$members->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($this->isAllowEdit())
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <h6>Pending Members</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Members</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Requested</th>
                                    <th class="text-secondary opacity-7"></th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($pending as $pendingMember)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{$this->getAvatar($pendingMember->id)}}" class="avatar avatar-sm me-3" alt="user1">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$pendingMember->name}} {{$pendingMember->lastname}}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{$pendingMember->email}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-secondary">{{$pendingMember->status}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{date('Y/m/d', strtotime($pendingMember->date_requested))}}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span wire:click="approve({{$pendingMember->member_id}})" class="badge badge-sm bg-gradient-success cursor-pointer">Approve</span>
                                        </td>
                                        <td class="align-middle">
                                            <a wire:click="deleteMember({{$pendingMember->member_id}})"
                                               wire:confirm="Are you sure you want to delete this member?"
                                                class="text-danger font-weight-bold text-xs cursor-pointer" data-toggle="tooltip" data-original-title="Remove from Organization">
                                                Remove
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <p class="text-center m-0">No Pending Members</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            <div class="px-3">
                                {{$pending->links()}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            @if($this->isAllowEdit())
                @script
                <script>
                    Livewire.on('member-approved', () => {
                        Swal.fire({
                            title: 'Approved!',
                            icon: 'success',
                            timer: 1000
                        });
                    });
                    Livewire.on('member-removed', () => {
                        Swal.fire({
                            title: 'Removed!',
                            icon: 'success',
                            timer: 1000
                        });
                    });
                </script>
                @endscript
            @endif
        @endif
    </div>

</div>
