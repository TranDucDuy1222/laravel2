@extends('user.layout')
@section('title')
Liên hệ
@endsection

@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
              href="{{ url('/category'.'/' . $category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{$dm->slug}}">{{$dm->ten_dm}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endsection

@section('content')
@if(session()->has('thongbao'))
            <div class="toast show align-items-center text-bg-success border-0 position-fixed top-3 end-0 p-3" role="alert"
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
<div class="app-content">
    <div class="pt-5">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ url('lien-he') }}">Liên hệ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pb-5">
        <div class="section__intro mb-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                        <!-- @if(session('thongbao'))
                          <div class="alert alert-warning">{{ session('thongbao') }}</div>
                        @endif -->
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">Liên hệ</h1>
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
                                <form class="l-f-o__form" action="/gui-lien-he" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="gl-label" for="login-email">Tên</label>
                                        <input class="input-text input-text--primary-style" type="text" name="name" id="name" placeholder="Nhập Tên" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="gl-label" for="login-password">Email</label>
                                        <input class="input-text input-text--primary-style" type="text" name="email" id="email" placeholder="Nhập Email" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="gl-label" for="login-password">Nội dung</label>
                                        <textarea class="form-control" name="noidung" id="noidung"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="l-f-o__create-link btn btn--e-brand-b-2">Gửi</button>
                                    </div>  
                                    <!-- <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="section__text-wrap">
                                                <h6 class="gl-link">Hoặc</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gl-s-api">
                                        <div class="mb-2">
                                            <a href="{{ route('login.google') }}" class="gl-s-api__btn gl-s-api__btn--gplus">
                                                <i class="fab fa-google"></i>
                                                <span>Đăng nhập bằng Google</span>
                                            </a>
                                        </div>
                                    </div> -->
                                   <div class="row my-3">
                                        <div class="col-lg-12">
                                            <div class="section__text-wrap">
                                            <p class="gl-link">Bạn chưa có tài khoản? <a href="{{ url('register') }}" class="text-danger">Đăng ký</a> ngay!</p>
                                            </div>
                                        </div>
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