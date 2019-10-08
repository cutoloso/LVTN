@extends('layouts.master')
@section('header.title','Giỏ hàng')
@section('header.css')
@endsection

@section('body.content')
    <section class="login">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link bg-transparent active" href="#login" data-toggle="tab" role="tab" aria-selected="true">
                                        <h5 class="card-title text-center"><span>Sign In</span></h5>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-transparent" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                                        <h5 class="card-title text-center"><span>Register</span></h5>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" role="tabpanel" id="login">
                                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                                            <label for="email">Email address</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-label-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            <label for="password">Password</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Remember password</label>
                                        </div>
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
                                        <hr class="my-4">
                                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="register">
                                    <form class="form-signin" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="User name">
                                            <label for="name">User name</label>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-label-group">
                                            <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                                            <label for="email2">Email address</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-label-group">
                                            <input id="password2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            <label for="password2">Password</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-label-group">
                                            <input id="password-confirm2" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Password">
                                            <label for="password-confirm2">Confirm password</label>
                                        </div>

                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign Up</button>
                                        <hr class="my-4">
                                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>
                                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        $(document).ready(function () {


        });
    </script>
@endsection
