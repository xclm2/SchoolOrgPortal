@extends('layouts.user_type.guest')

@section('content')
<main class="main-content mt-3">
  <section>
    <div class="container">
        <div class="logo-container text-center">
            <img src="/images/logo.png" alt="img-blur-shadow" class="img-fluid" width="550">
        </div>
        <div>
            <div class="container-fluid py-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <form action="/register" method="POST" role="form text-left">
                            @csrf
                            @if($errors->any())
                                <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            @if(session('success'))
                                <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="id-no" class="form-control-label">{{ __('ID NO.') }}</label>
                                        <div class="@error('id_no')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="text" placeholder="12345" id="id-no" name="id_no">
                                            @error('id_no')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="year" class="form-control-label">{{ __('Year') }}</label>
                                        <div class="@error('year')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="text" placeholder="1" id="year" name="year" min="1" max="4">
                                            @error('year')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="course" class="form-control-label">{{ __('Course') }}</label>
                                        <div class="@error('course')border border-danger rounded-3 @enderror">
                                            <select name="course" id="course" class="form-select">
                                                <option>Select</option>
                                                <option value="bsit">BS-IT</option>
                                                <option value="bsit">BEED</option>
                                                <option value="bsit">BSED</option>
                                                <option value="bsit">BSCRIM</option>
                                            </select>
                                            @error('course')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                        <div class="@error('email')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="email" placeholder="@example.com" id="user-email" name="email">
                                            @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">{{ __('Firstname') }}</label>
                                        <div class="@error('name')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="text" placeholder="Name" id="user-name" name="name">
                                            @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname" class="form-control-label">{{ __('Lastname') }}</label>
                                        <div class="@error('name')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="text" placeholder="Lastname" id="lastname" name="lastname">
                                            @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                        <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                            <input class="form-control" type="tel" placeholder="40770888444" id="number" name="phone" value="">
                                            @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="password" class="form-control-label">{{ __('Password') }}</label>
                                    <div class="@error('password')border border-danger rounded-3 @enderror">
                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-label="Password" aria-describedby="password-addon">
                                        @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="about">{{ 'About Me' }}</label>
                                <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me"></textarea>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Register' }}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
</main>
@endsection

