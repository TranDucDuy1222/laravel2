@extends('user.layout')
@section('title')
    Quên mật khẩu - TrendyU
@endsection
@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ route('loai-san-pham', $category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a></li>
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
                                <a href="{{ url('/') }}">Trang chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ route('password.request') }}">Quên mật khẩu</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-5">
        <!-- <div class="section__intro mb-1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div> -->
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">QUÊN MẬT KHẨU</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row row--center">
                    <div class="col-lg-6 col-md-8 mb-3">
                        <div class="l-f-o border">
                            <div class="l-f-o__pad-box">
                                <h1 class="gl-h1">LẤY LẠI MẬT KHẨU</h1>
                                <span class="gl-text mb-3">Nhập email của bạn và chúng tôi sẽ gửi cho bạn liên kết để đặt lại mật khẩu.</span>
                                <form class="l-f-o__form" method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="gl-label" for="login-email">EMAIL *</label>
                                        <input class="input-text input-text--primary-style" type="email" name="email" id="login-email" placeholder="Nhập Email" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="l-f-o__create-link btn btn--e-brand-b-2">Gửi</button>
                                    </div>
                                    <div class="mb-3">
                                        <a class="gl-link" href="{{ url('/') }}">Quay lại trang chủ</a>
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