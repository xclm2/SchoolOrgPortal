<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Organizations</h5>
                        </div>
                        <a class="btn bg-gradient-primary btn-sm mb-0" href="organization/create" wire:navigate>+&nbsp; Add</a>
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
                                        <span><i class="cursor-pointer fas fa-trash text-danger"></i></span>
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
    <div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalSignTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h3 class="font-weight-bolder text-primary text-gradient">New User</h3>
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
                                <div class="form-check form-check-info text-left">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree the <a href="javascrpt:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn bg-gradient-primary btn-lg btn-rounded w-100 mt-4 mb-0">Sign up</button>
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
@script
    <script>
        document.addEventListener('livewire:navigated', () => {
            $wire.$refesh;
        })
    </script>
@endscript
