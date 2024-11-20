<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="/FE/css/cssHome.css">
@extends('admin.admin_head')
@section('title')
    Đăng nhập quản trị
@endsection
<div class="container-login100">
    <div class="justify-content-center">
        @if(session()->has('thongbao'))
            <div class="toast show align-items-center text-bg-danger border-0 position-fixed top-0 mt-5 end-0 p-3" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {!! session('thongbao') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>
    <div class="wrap-login100 shadow">
        <div class="login100-pic">
            <span class="login100-form-title">
                <b>Đăng nhập quản trị</b>
            </span>
            <img src="{{ asset('/uploads/logo/logolight.png') }}" class="img-fluid" alt="" />
        </div>
        <div class="l-f-o border-start">
            <div class="login-box">
                <form class="login100-form validate-form" action="{{route('login_admin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="gl-label" for="login-email">EMAIL *</label>
                        <input class="input-text input-text--primary-style" type="email" name="email" id="login-email" placeholder="Nhập Email" required>
                    </div>
                    <div class="mb-4">
                        <label class="gl-label" for="login-password">PASSWORD *</label>
                        <input class="input-text input-text--primary-style" type="password" name="password" id="login-password" placeholder="Nhập Password" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="ms-auto pd-detail__inline">
                                <span class="pd-detail__click-wrap">
                                    <a class="gl-link" href="{{ route('password.request') }}">Quên mật khẩu?</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="l-f-o__create-link btn btn btn-primary">ĐĂNG NHẬP</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>