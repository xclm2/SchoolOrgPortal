<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <a class="btn bg-gradient-primary btn-sm mb-0" type="button" href="/admin/user/create" wire:navigate.hover>+&nbsp; New Adviser</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @livewire('member.table')
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
