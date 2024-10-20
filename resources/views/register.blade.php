@extends('user.layout')
@section('title')
Đăng ký
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
<div class="app-content">
    <div class="pt-5">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="index.html">Trang chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="register.html">Đăng ký</a>
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
                        @if(session('success'))
                          <div class="alert alert-warning">{{ session('success') }}</div>
                        @endif
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
                            <h1 class="section__heading u-c-secondary">ĐĂNG KÝ TÀI KHOẢN MỚI</h1>
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
                                <form class="l-f-o__form" action="{{ route('register_form') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="gl-label" for="name">TÊN *</label>
                                        <input class="input-text input-text--primary-style" type="text" id="name" name="name" placeholder="Nhập tên" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap">
                                                    <a class="text-danger">{{ $message }}</a>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="gl-label" for="email">EMAIL *</label>
                                        <input class="input-text input-text--primary-style" type="email" id="email" name="email" placeholder="Nhập Email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap">
                                                    <a class="text-danger">{{ $message }}</a>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="gl-label" for="password">PASSWORD *</label>
                                        <input class="input-text input-text--primary-style" type="password" id="password" name="password" placeholder="Nhập Password" required>
                                        @error('password')
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap">
                                                    <a class="text-danger">{{ $message }}</a>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="gl-label" for="password_confirmation">NHẬP LẠI PASSWORD *</label>
                                        <input class="input-text input-text--primary-style" type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại Password" required>
                                        @error('password_confirmation')
                                            <div class="pd-detail__inline">
                                                <span class="pd-detail__click-wrap">
                                                    <a class="text-danger">{{ $message }}</a>
                                                </span>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="l-f-o__create-link btn btn--e-brand-b-2">ĐĂNG KÝ</button>
                                    </div> 
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="section__text-wrap">
                                                <h6 class="gl-link">Hoặc</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="gl-s-api">
                                        <div class="mb-2">
                                            <a href="{{ route('login.google') }}" class="gl-s-api__btn gl-s-api__btn--gplus"><i class="fab fa-google"></i>
                                                <span>Đăng ký bằng Google</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row my-3">
                                        <div class="col-lg-12">
                                            <div class="section__text-wrap">
                                            <p class="gl-link">Bạn đã có tài khoản? <a href="{{ url('login') }}" class="text-danger">Đăng nhập</a> ngay!</p>
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