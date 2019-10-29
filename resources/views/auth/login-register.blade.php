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
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link bg-transparent active" href="#login" data-toggle="tab" role="tab" aria-selected="true">
                                        <h5 class="card-title text-center"><span>Đăng nhập</span></h5>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link bg-transparent" href="#register" data-toggle="tab" role="tab" aria-selected="false">
                                        <h5 class="card-title text-center"><span>Đăng ký</span></h5>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" role="tabpanel" id="login">
                                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                                            <label for="email">Địa chỉ email</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-label-group">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            <label for="password">Mật khẩu</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="remember">Ghi nhớ mật khẩu</label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <div class="mb-3" style="cursor: pointer;" data-toggle="modal" data-target="#modal-forgotPwd">
                                                    Quên mật khẩu? Nhấn vào đây
                                            </div>
                                        @endif
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đăng nhập</button>

{{--                                        <hr class="my-4">--}}
{{--                                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>--}}
{{--                                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>--}}
                                    </form>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="register">
                                    <form class="form-signin" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="User name">
                                            <label for="name">Họ tên</label>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-label-group">
                                            <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email address">
                                            <label for="email2">Địa chỉ email</label>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>


                                        <div class="form-label-group">
                                            <input id="password2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                            <label for="password2">Mật khẩu</label>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-label-group">
                                            <input id="password-confirm2" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Password">
                                            <label for="password-confirm2">Nhập lại mật khẩu</label>
                                        </div>

                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đăng ký</button>
{{--                                        <hr class="my-4">--}}
{{--                                        <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>--}}
{{--                                        <button class="btn btn-lg btn-facebook btn-block text-uppercase" type="submit"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button>--}}
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="modal" id="modal-forgotPwd">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">{{ __('QUÊN MẬT KHẨU?') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <p>Vui lòng cung cấp email đăng nhập để lấy lại mật khẩu.</p>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Địa chỉ Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Gửi') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {


        });
    </script>
@endsection
