
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card">
                <div class="card-body">
                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="text-danger text-center">:message</div>')) !!}
                    @endif
                  <form wire:submit="login" role="form">
                    @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input wire:model="email" type="email" class="form-control @error('email') border-danger @enderror" name="email" id="email" placeholder="Email" value="admin@softui.com" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input wire:model="password" type="password" class="form-control @error('email') border-danger @enderror" name="password" id="password" placeholder="Password" value="secret" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                <small class="text-muted">Forgot you password? Reset you password
                  <a href="/login/forgot-password" class="text-info text-gradient font-weight-bold">here</a>
                </small>
                  <p class="mb-4 text-sm mx-auto">
                    Don't have an account?
                    <a href="/register" class="text-info text-gradient font-weight-bold" wire:navigate>Sign up</a>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
