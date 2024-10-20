@extends('user.layout')
@section('title')
    Quên mật khẩu
@endsection
@section('content')
<div class="app-content">
    <div class="py-5">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">ĐẶT LẠI MẬT KHẨU</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 mb-3">
                        <div class="l-f-o">
                            <div class="l-f-o__pad-box">
                                <form class="l-f-o__form" action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-3">
                                        <label class="gl-label" for="login-email">EMAIL *</label>
                                        <input class="input-text input-text--primary-style" type="email" name="email" id="login-email" value="{{ old('email', $email) }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="gl-label" for="password">MẬT KHẨU MỚI *</label>
                                        <input class="input-text input-text--primary-style" type="password" name="password" id="password" required>
                                        @error('password')
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap">
                                                    <a class="text-danger">{{ $message }}</a>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="gl-label" for="password-confirm">XÁC NHẬN MẬT KHẨU *</label>
                                        <input class="input-text input-text--primary-style" type="password" name="password_confirmation" id="password-confirm" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="l-f-o__create-link btn btn--e-brand-b-2">ĐẶT LẠI MẬT KHẨU</button>
                                    </div>
                                    <div class="mb-3">
                                        <a class="gl-link" href="{{ route('login') }}">Quay lại trang đăng nhập</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
