@extends('layouts.auth')

@section('title')
Login
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6
                offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/school.svg') }}" alt="Logo Sekolah" width="100"
                        class="shadow-light rounded-circle" style="padding: 10px; background: white">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>Login</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('login') }}" method="post" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control
                                    @error('email') is-invalid @enderror" placeholder="Your Email"
                                    value="{{ old('email') }}" tabindex="1" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password"
                                        class="control-label @error('password') is-invalid @enderror">Password</label>
                                </div>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" tabindex="2" required>

                                @error('password')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" id="remember-me" class="custom-control-input"
                                        tabindex="3">
                                    <label for="remember-me" class="custom-control-label">
                                        Remember Me
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
