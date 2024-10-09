@extends('user.layout')
@section('title')
Trang Chủ - TrendyU
@endsection

@section('category')
@foreach ($loai as $category)
    <li class="nav-item dropdown">
        <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="{{ url('/category/' . $category->slug) }}">
            {{$category->ten_loai}}
        </a>
        <ul class="dropdown-menu" id="userDropdown">
            @foreach ($danh_muc as $dm)
                @if ($dm->id_loai == $category->id)
                    <li class="hover-dm" ><a class="dropdown-item" href="{{$dm->slug}}">{{$dm->ten_dm}}</a></li>
                @endif
            @endforeach
        </ul>
    </li>
@endforeach
@endsection

@section('content')
<!-- Header -->
<header class="shadow-none">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/imgnew/banner1.png" class="d-block w-100 img-header" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>NIKE AIR MAX DN</h3>
                    <p><strong>Thế hệ tiếp theo của công nghệ Air sắp ra mắt vào ngày 26/03.</strong></p>
                </div>
            </div>
            <div class="carousel-item active">
                <img src="/imgnew/banner3.jpg" class="d-block w-100 img-header" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h3>MUA SẮM NGAY</h3>
                    <p><strong>Trở thành thành viên của chúng tôi để có những mã giảm giá.</strong> </p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- slogan -->
    <div class="text-center text-black">
        <h2>Giao hàng miễn phí</h2>
        <h3 class="">Áp dụng cho đơn hàng từ 5.000.000₫ trở lên.</h3>
    </div>
    <!-- End slogan -->
</header>
<!-- End header -->

<!-- Home -->
<section class="container-fluid section text-black">
    <!-- <div class="mx-xl-5"> -->
    <a href="/allproduct" class="d-flex justify-content-center">
        <button class="btn btn-outline-dark mt-2">Cửa Hàng</button>
    </a>
    <br>
    <!-- Sản phẩm mới -->
    <div class="pt-5 ">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h2 class="section__heading u-c-secondary mb-2">SẢN PHẨM MỚI</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <a class="i3-banner">
                                <div class="aspect aspect--bg-grey-fb aspect--square">
                                    <img class="aspect__img i3-banner__img" src="{{ asset('/uploads/banner/') }}"
                                        onerror="this.src='{{ asset('/uploads/banner/bannerspnew.png') }}'" alt="">
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="row">
                                @foreach ($sanphamhome as $item)
                                                                @php
                                                                    if ($item->gia_km > 0) {
                                                                        $gianew = $item->gia_km;
                                                                        //   $giaold = '<del>' . $gia . '</del>';
                                                                    } else {
                                                                        $gianew = $item->gia;
                                                                    }
                                                                    $num = $gianew;
                                                                    $giachinh = number_format($num, 0, '', '.');
                                                                @endphp
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                                    <div class="product-short">
                                                                        <div class="product-short__container">
                                                                            <div class="card">
                                                                                <a href="/detail/{{$item->id}}" id="hover-img-home">
                                                                                    <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                                        onerror="this.src='{{ asset('/uploads') }}'"
                                                                                        style="max-height: 295px;" alt="" class="w-100">
                                                                                </a>
                                                                                <div class="card-body text-center">
                                                                                    <a href="">
                                                                                        <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                                                    </a>
                                                                                    <div class="row">
                                                                                        <div class="col-sm-6">
                                                                                            {{$item->ten_dm}}
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <strong> {{$giachinh}}đ </strong>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                @endforeach
                                <div class="col-lg-12 mt-4 pt-3">
                                    <a class="i3-banner" href="">
                                        <div class="aspect aspect--1048-334">
                                            <img class="aspect__img i3-banner__img"
                                                src="{{ asset('/uploads/banner/') }}"
                                                onerror="this.src='{{ asset('/uploads/banner/bannerphu.png') }}'"
                                                alt="">
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End sản phẩm mới -->
    <br>
    <!-- Sản phẩm xu hướng -->
    <div class="pt-5">
        <div class="section__intro mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary mb-2">SẢN PHẨM XU HƯỚNG</h1>
                            <span class="section__span u-c-silver mb-2">CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="filter-category-container">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <div class="filter__category-wrapper">
                                    <button class="nav-link btn filter__btn filter__btn--style-2 active" id="mnj-tab"
                                        data-bs-toggle="pill" data-bs-target="#pills-mnj" type="button" role="tab"
                                        aria-controls="pills-mnj" aria-selected="true">Sản phẩm mới</button>
                                </div>
                                @foreach ($loai_arr as $loai )
                                    <div class="filter__category-wrapper">
                                        <button class="nav-link btn filter__btn filter__btn--style-2" id="{{$loai->id}}"
                                            data-bs-toggle="tab" data-bs-target="#{{$loai->id}}-pane" type="button" role="tab"
                                            aria-controls="{{$loai->id}}-pane" aria-selected="false">{{$loai->ten_loai}}</button>
                                    </div>
                                @endforeach
                                <div class="filter__category-wrapper">
                                    <button class="nav-link btn filter__btn filter__btn--style-2" id="giamgia"
                                        data-bs-toggle="tab" data-bs-target="#giamgia-pane" type="button" role="tab"
                                        aria-controls="giamgia-pane" aria-selected="false">Giảm giá</button>
                                </div>
                            </ul>
                        </div>
                        <div class="filter__grid-wrapper mt-3">
                            <div class="row tab-content" id="myTabContent">
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade show active"
                                    id="pills-mnj" role="tabpanel" aria-labelledby="mnj-tab" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Danh mục</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Áo -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="1-pane" role="tabpanel" aria-labelledby="1" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Danh mục</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp áo</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End áo -->
                                <!-- Giày -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="2-pane" role="tabpanel" aria-labelledby="2" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Danh mục</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp giày</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End giày -->
                                <!-- Quần -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="3-pane" role="tabpanel" aria-labelledby="3" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Danh mục</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp quần</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End quần -->
                                 <!-- Nam -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="4-pane" role="tabpanel" aria-labelledby="4" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Danh mục</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp nam</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End nam -->
                                 <!-- Nữ -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="5-pane" role="tabpanel" aria-labelledby="5" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Giảm giá</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp nữ</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End nữ -->
                                <!-- Trẻ em -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="6-pane" role="tabpanel" aria-labelledby="6" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Giảm giá</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp trẻ em</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End trẻ em -->
                                 <!-- Phụ kiện -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="7-pane" role="tabpanel" aria-labelledby="7" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Giảm giá</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp phu kien</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End phụ kiện -->
                                 <!-- Giảm giá -->
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear tab-pane fade"
                                    id="giamgia-pane" role="tabpanel" aria-labelledby="giamgia" tabindex="0">
                                    <div class="product-bs">
                                        <div class="product-bs__container">
                                            <div class="product-bs__wrap">
                                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                                    <img class="aspect__img" src="" alt="">
                                                </a>
                                                <div class="product-bs__action-wrap">
                                                    <ul class="product-bs__action-list">
                                                        <li>
                                                            <a href=""><i class="fas fa-search-plus"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-shopping-bag"></i></a>
                                                        </li>
                                                        <li>
                                                            <a href=""><i class="fas fa-heart"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="product-bs__category">
                                                <a href="">Giảm giá</a>
                                            </span>
                                            <span class="product-bs__name">
                                                <a href="">tensp giảm giá</a>
                                            </span>
                                            <div class="product-bs__rating gl-rating-style">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <span class="product-bs__review">số đánh giá</span>
                                            </div>
                                            <span class="product-bs__price">giá_km
                                                <span class="product-bs__discount">gia 000</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Giảm giá -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="/allproduct" class="d-flex justify-content-center">
                            <button class="btn btn-outline-dark mt-2">Cửa Hàng</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End xu hướng -->
    <br>
    <!-- Bộ sưu tập -->
    <div class="pt-5">
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="promotion-o">
                            <div class="aspect aspect--bg-grey aspect--square">
                                <img class="aspect__img" src="" alt="">
                            </div>
                            <div class="promotion-o__content">
                                <a class="promotion-o__link btn--e-white-brand" href="">BST</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="promotion-o">
                            <div class="aspect aspect--bg-grey aspect--square">
                                <img class="aspect__img" src="" alt="">
                            </div>
                            <div class="promotion-o__content">
                                <a class="promotion-o__link btn--e-white-brand" href="">BST</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                        <div class="promotion-o">
                            <div class="aspect aspect--bg-grey aspect--square">
                                <img class="aspect__img" src="" alt="">
                            </div>
                            <div class="promotion-o__content">
                                <a class="promotion-o__link btn--e-white-brand" href="">BST</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End bộ sưu tập -->
    <br>
    <!-- Sản phẩm mới -->
    <div class="pt-5">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary mb-2">SẢN PHẨM MỚI</h1>
                            <span class="section__span u-c-silver">ÁDFGHJK</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                        <div class="product-r" style="height: 100%;">
                            <div class="product-r__container">
                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                    <img class="aspect__img" src="" alt="">
                                </a>
                                <div class="product-r__action-wrap">
                                    <ul class="product-r__action-list">
                                        <li>
                                            <a href=""><i class="fas fa-search-plus text-secondary"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fas fa-shopping-bag text-secondary"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fas fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-r__info-wrap">
                                <span class="product-r__category">
                                    <a href="">Danh mục</a>
                                </span>
                                <div class="product-r__n-p-wrap">
                                    <span class="product-r__name">
                                        <a href="">TenSp</a>
                                    </span>
                                    <span class="product-r__price">123 VN</span>
                                </div>
                                <span class="product-r__description">Mô tả àdgdhkjjk.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                        <div class="product-r" style="height: 100%;">
                            <div class="product-r__container">
                                <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                    <img class="aspect__img" src="" alt="">
                                </a>
                                <div class="product-r__action-wrap">
                                    <ul class="product-r__action-list">
                                        <li>
                                            <a href=""><i class="fas fa-search-plus text-secondary"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fas fa-shopping-bag text-secondary"></i></a>
                                        </li>
                                        <li>
                                            <a href=""><i class="fas fa-heart"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-r__info-wrap">
                                <span class="product-r__category">
                                    <a href="">Danh mục</a>
                                </span>
                                <div class="product-r__n-p-wrap">
                                    <span class="product-r__name">
                                        <a href="">TenSp</a>
                                    </span>
                                    <span class="product-r__price">123 VN</span>
                                </div>
                                <span class="product-r__description">Mô tả àdgdhkjjk.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="/allproduct" class="d-flex justify-content-center">
            <button class="btn btn-outline-dark mt-2">Cửa Hàng</button>
        </a>
    </div>
    <br>
    <!-- End sản phẩm mới -->
</section>

<!-- Banner phụ -->
<div class="banner-bg w-100" style="background-image: url({{ asset('/uploads/banner/bannerp1.jpg') }});">
    <div class="section__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner-bg__wrap">
                        <div class="banner-bg__text-1">
                            <span class="u-c-white">Ưu đãi</span>
                            <span class="u-c-secondary">Vàng</span>
                        </div>
                        <div class="banner-bg__text-2">
                            <span class="u-c-secondary">Chính thức ra mắt</span>
                            <span class="u-c-white">Đừng bỏ lỡ!</span>
                        </div>
                        <span class="banner-bg__text-block banner-bg__text-3 u-c-secondary">Được miễn phí vận chuyển khi
                            mua từ 2 sản phẩm trở lên!</span>
                        <a class="banner-bg__shop-now btn--e-secondary" href="">Mua ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end banner phụ -->

<section class="container-fluid section text-black">
    <div class="container">
        <!-- Sản phẩm sắp ra mắt -->
        <div class="pt-5">
                <div class="section__intro mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary mb-2">SẢN PHẨM SẮP RA MẮT</h1>
                                    <span class="section__span u-c-silver">ÁDFGHJK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                                <div class="product-r" style="height: 100%;">
                                    <div class="product-r__container">
                                        <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                            <img class="aspect__img" src="" alt="">
                                        </a>
                                        <div class="product-r__action-wrap">
                                            <ul class="product-r__action-list">
                                                <li>
                                                    <a href=""><i class="fas fa-search-plus text-secondary"></i></a></li>
                                                <li>
                                                    <a href=""><i class="fas fa-shopping-bag text-secondary"></i></a></li>
                                                <li>
                                                    <a href=""><i class="fas fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-r__info-wrap">
                                        <span class="product-r__category">
                                            <a href="">Danh mục</a>
                                        </span>
                                        <div class="product-r__n-p-wrap">
                                            <span class="product-r__name">
                                                <a href="">TenSp</a>
                                            </span>
                                            <span class="product-r__price">123 VN</span>
                                        </div>
                                        <span class="product-r__description">Mô tả àdgdhkjjk.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-5">   
                                <div class="product-r" style="height: 100%;">
                                    <div class="product-r__container">
                                        <a class="aspect aspect--bg-grey aspect--square d-block" href="">
                                            <img class="aspect__img" src="" alt="">
                                        </a>
                                        <div class="product-r__action-wrap">
                                            <ul class="product-r__action-list">
                                                <li>
                                                    <a href=""><i class="fas fa-search-plus text-secondary"></i></a></li>
                                                <li>
                                                    <a href=""><i class="fas fa-shopping-bag text-secondary"></i></a></li>
                                                <li>
                                                    <a href=""><i class="fas fa-heart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-r__info-wrap">
                                        <span class="product-r__category">
                                            <a href="">Danh mục</a>
                                        </span>
                                        <div class="product-r__n-p-wrap">
                                            <span class="product-r__name">
                                                <a href="">TenSp</a>
                                            </span>
                                            <span class="product-r__price">123 VN</span>
                                        </div>
                                        <span class="product-r__description">Mô tả àdgdhkjjk.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End sản phẩm sắp ra mắt -->
        <!-- Lợi ích thành viên -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section__text-wrap">
                    <h2 class="section__heading u-c-secondary mb-2">LỢI ÍCH THÀNH VIÊN</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 ht-titile">
                <img src="/imgnew/litv1.png" alt="" class="w-100">
                <div class="titile">
                    <h5 class="text-light">Ngày thành viên. Kỉ niệm của bạn</h5>
                    <a href="#" class="d-flex justify-content-center">
                        <button class="btn btn-light mt-1">Tìm Hiểu Thêm</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 ht-titile">
                <img src="/imgnew/litv2.png" alt="" class="w-100">
                <div class="titile">
                    <h5 class="text-light">Dịch vụ cho bạn.</h5>
                    <a href="/allproduct" class="d-flex justify-content-center">
                        <button class="btn btn-light mt-1">Cửa Hàng</button>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 ht-titile">
                <img src="/imgnew/litv3.jpg" alt="" class="w-100">
                <div class="titile">
                    <h5 class="text-light">Cộng đồng sneaker của bạn.</h5>
                    <a href="/allproduct" class="d-flex justify-content-center">
                        <button class="btn btn-light mt-1">Khám Phá</button>
                    </a>
                </div>
            </div>
        </div>
        <!-- End lợi ích thành viên -->
    </div>
</section>
<!-- End Home -->

<!-- Chờ load web -->
<!-- <div class="container">
  <div ng-show="isLoading" class="position-fixed top-0 bottom-0 start-0 end-0 z-3 text-bg-dark d-flex justify-content-center align-items-center">
      <i class="fa-solid fa-spin fa-spinner"></i>
      Đang tải...
  </div>
</div> -->
<!-- End chờ load web -->

@endsection