@extends('user.layout')
@section('title')
Trang Chủ - TrendyU
@endsection

@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ url('/category/' . $category->slug) }}">
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
                        <img src="{{ asset('/uploads/banner/'.$home_page->anh_bieu_ngu_1) }}"
                            onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" class="d-block w-100 img-header" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 style="color: {{$home_page->mau_tieu_de_chinh_1}};" >{{$home_page->tieu_de_chinh_1}}</h2>
                            <h3>{{$home_page->tieu_de_phu_1}}</h3>
                        </div>
                    </div>
                    <div class="carousel-item active">
                        <img src="{{ asset('/uploads/banner/'.$home_page->anh_bieu_ngu_2) }}"
                            onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" class="d-block w-100 img-header" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h2 style="color: {{$home_page->mau_tieu_de_chinh_2}};" >{{$home_page->tieu_de_chinh_2}}</h2>
                            <h3>{{$home_page->tieu_de_phu_2}}</h3>
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
                <h2>{{$home_page->slogan_chinh}}</h2>
                <h3 class="">{{$home_page->slogan_phu}}</h3>
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
                                    <h2 class="section__heading u-c-secondary mb-2">{{$home_page->tieu_de_gioi_thieu_san_pham}}</h2>
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
                                        <img class="aspect__img i3-banner__img" src="{{ asset('/uploads/banner/'.$home_page->anh_chinh_gioi_thieu_san_pham) }}"
                                            onerror="this.src='{{ asset('/uploads/banner/bannerspnew.png') }}'" alt="" class="w-100" height="100%">
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
                                            <div class="col-lg-6 col-md-6 col-sm-6 dt">
                                                <div class="product-short">
                                                    <div class="product-short__container">
                                                        <div class="card">
                                                            @if ($item->trang_thai != 3)
                                                                <a href="/detail/{{$item->id}}" id="hover-img-home">
                                                                    <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                        onerror="this.src='{{ asset('/uploads') }}'"
                                                                        style="max-height: 295px;" alt="" class="w-100">
                                                                </a>
                                                            @elseif ($item->trang_thai == 3)
                                                                <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container">
                                                                    <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                        onerror="this.src='{{ asset('/uploads') }}'"
                                                                        style="max-height: 295px;" alt="" class="w-100">
                                                                    <img src="{{ asset('/uploads/logo/') }}" onerror="this.src='{{ asset('/uploads/logo/logocs1.png') }}'" class="overlay-image" alt="">
                                                                </a>
                                                            @endif
                                                            <div class="card-body text-center">
                                                                <a href="">
                                                                    <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                                </a>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        {{$item->ten_dm}}
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        @if ($item->trang_thai != 3)
                                                                            <strong id="color-gia"> {{$giachinh}}đ </strong>
                                                                        @elseif ($item->trang_thai == 3)
                                                                            Giá dự kiến<br>
                                                                            <strong id="color-gia" class="fa-solid fa-fade">{{$giachinh}} <i class="fa-dong-sign "></i></strong>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-lg-12 pt-3">
                                            <a class="i3-banner" href="">
                                                <div class="aspect aspect--1048-334">
                                                    <img class="aspect__img i3-banner__img"
                                                        src="{{ asset('/uploads/banner/'. $home_page->anh_phu_gioi_thieu_san_pham) }}"
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
                                    <h1 class="section__heading u-c-secondary mb-2">{{$home_page->tieu_de_chinh_xu_huong}}</h1>
                                    <span class="section__span u-c-silver mb-2">{{$home_page->tieu_de_phu_xu_huong}}</span>
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
                                        @foreach ($loai_arr as $loai)
                                            <div class="filter__category-wrapper">
                                                <button class="nav-link btn filter__btn filter__btn--style-2 {{ $loop->first ? 'active' : '' }}" id="tab-{{$loai->id}}"
                                                    data-bs-toggle="tab" data-bs-target="#pane-{{$loai->id}}" type="button"
                                                    role="tab" aria-controls="pane-{{$loai->id}}"
                                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{$loai->ten_loai}}</button>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="filter__grid-wrapper mt-3">
                                    <div class="row tab-content" id="myTabContent">
                                        <!-- Sản phẩm theo loại -->
                                        @foreach ($loai_arr as $loai)
                                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{$loai->id}}" role="tabpanel"
                                        aria-labelledby="tab-{{$loai->id}}">
                                                <div class="row">
                                                    @foreach ($sanpham[$loai->slug] as $item)
                                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 filter__item outwear">
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
                                                            <div class="product-short">
                                                                <div class="product-short__container">
                                                                    <div class="card">
                                                                        @if ($item->trang_thai != 3)
                                                                            <a href="/detail/{{$item->id}}" id="hover-img-home">
                                                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                                    onerror="this.src='{{ asset('/uploads') }}'"
                                                                                    style="max-height: 295px;" alt="" class="w-100">
                                                                            </a>
                                                                        @elseif ($item->trang_thai == 3)
                                                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container">
                                                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                                    onerror="this.src='{{ asset('/uploads') }}'"
                                                                                    style="max-height: 295px;" alt="" class="w-100">
                                                                                <img src="{{ asset('/uploads/logo/') }}" onerror="this.src='{{ asset('/uploads/logo/logocs1.png') }}'" class="overlay-image" alt="">
                                                                            </a>
                                                                        @endif
                                                                        <div class="card-body text-center">
                                                                            <a href="">
                                                                                <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                                            </a>
                                                                            <div class="row">
                                                                                <div class="col-sm-6">
                                                                                    {{$item->ten_dm}}
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    @if ($item->trang_thai != 3)
                                                                                        <strong id="color-gia"> {{$giachinh}}đ </strong>
                                                                                    @elseif ($item->trang_thai == 3)
                                                                                        Giá dự kiến<br>
                                                                                        <strong id="color-gia" class="fa-solid fa-fade">{{$giachinh}} <i class="fa-dong-sign "></i></strong>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                        <!-- End sản phẩm theo loại -->
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
            <!-- Danh mục sản phẩm -->
            <div class="pt-5">
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                                <div class="promotion-o">
                                    <div class="aspect aspect--bg-grey">
                                        <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_1) }}"
                                            onerror="this.src='{{ asset('/uploads/banner/dmnike1.jpg') }}'"
                                            alt="" class="w-100">
                                    </div>
                                    <div class="promotion-o__content">
                                        <a class="promotion-o__link btn--e-white-brand" href="">{{$home_page->tieu_de_danh_muc_1}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                                <div class="promotion-o">
                                    <div class="aspect aspect--bg-grey ">
                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_2) }}"
                                            onerror="this.src='{{ asset('/uploads/banner/dmnike2.png') }}'"
                                            alt="" class="w-100">
                                    </div>
                                    <div class="promotion-o__content">
                                        <a class="promotion-o__link btn--e-white-brand" href="">{{$home_page->tieu_de_danh_muc_2}}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 mb-3">
                                <div class="promotion-o">
                                    <div class="aspect aspect--bg-grey">
                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_3) }}"
                                            onerror="this.src='{{ asset('/uploads/banner/dmnike3.jpeg') }}'"
                                            alt="" class="w-100">
                                    </div>
                                    <div class="promotion-o__content">
                                        <a class="promotion-o__link btn--e-white-brand" href="">{{$home_page->tieu_de_danh_muc_3}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <!-- End danh mục sản phẩm -->

            <!-- Sản phẩm sale -->
            <div class="pt-5">
                <div class="section__intro mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary mb-2">{{$home_page->tieu_de_khuyen_mai_chinh}}</h1>
                                    <span class="section__span u-c-silver">{{$home_page->tieu_de_khuyen_mai_phu}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            @foreach ($sanphamsale as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 ">
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
                                                            <strong id="color-gia"> {{number_format($item->gia_km, 0, '', '.')}}đ </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <a href="/allproduct" class="d-flex justify-content-center">
                    <button class="btn btn-outline-dark mt-2">Cửa Hàng</button>
                </a>
            </div>
            <br>
            <!-- End sản phẩm sale -->  
            <!-- Sản phẩm mới -->
            <div class="pt-5">
                <div class="section__intro mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary mb-2">{{$home_page->tieu_de_san_pham_moi_chinh}}</h1>
                                    <span class="section__span u-c-silver">{{$home_page->tieu_de_san_pham_moi_phu}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="section__content">
                    <div class="container">
                        <div class="row">
                            @foreach ($sanphamnew as $item)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 ">
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
                                                            <strong id="color-gia"> {{$giachinh}}đ </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
        <div class="banner-bg w-100" style="background-image: url({{ asset('/uploads/banner/'.$home_page->anh_bieu_ngu_phu) }});">
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-bg__wrap" >
                                <div class="banner-bg__text-1">
                                    <span style="color: {{$home_page->mau_tieu_de_chinh_bieu_ngu_phu}};">{{$home_page->tieu_de_chinh_bieu_ngu_phu}}</span>
                                </div>
                                <div class="banner-bg__text-2">
                                    <span class="u-c-white">{{$home_page->tieu_de_phu_bieu_ngu_phu}}</span>
                                </div>
                                <span class="banner-bg__text-block banner-bg__text-3 ">{{$home_page->mo_ta_bieu_ngu_phu}}</span>
                                <a href="/allproduct" class="d-flex justify-content-center">
                                    <button class="btn btn-outline-light mt-2">Cửa Hàng</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end banner phụ -->

        <section class="container-fluid section text-black">
            <div class="container">
                <!-- Sản phẩm sắp về hàng -->
                <div class="pt-5">
                    <div class="section__intro mb-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="section__text-wrap">
                                        <h1 class="section__heading u-c-secondary mb-2">{{$home_page->tieu_de_san_pham_sap_ve}}</h1>
                                        <span class="section__span u-c-silver">{{$home_page->tieu_de_phu_san_pham_sap_ve}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section__content">
                        <div class="container">
                            <div class="row">
                                @foreach ($sanphamcs as $item)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-5 ">
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
                                        <div class="product-short">
                                            <div class="product-short__container">
                                                <div class="card">
                                                    <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container">
                                                        <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                            onerror="this.src='{{ asset('/uploads') }}'"
                                                            style="max-height: 295px;" alt="" class="w-100">
                                                            <img src="{{ asset('/uploads/logo/logocs1.png') }}" class="overlay-image" alt="">
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
                                                                Giá dự kiến<br>
                                                                <strong id="color-gia" class="fa-solid fa-fade">{{$giachinh}} <i class="fa-dong-sign "></i></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End sản phẩm sắp về hàng -->
                <!-- Lợi ích thành viên -->
                <div class="row mb-4">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h2 class="section__heading u-c-secondary">{{$home_page->tieu_de_thanh_vien}}</h2>
                            <span class="">{{$home_page->tieu_de_phu_thanh_vien}}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 ht-titile">
                        <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_1) }}"
                                onerror="this.src='{{ asset('/imgnew/litv1.png') }}'"
                                alt="" class="w-100">
                        <div class="titile">
                            <h5 class="text-light">{{$home_page->tieu_de_loi_ich_thanh_vien_1}}</h5>
                            <a href="#" class="d-flex justify-content-center">
                                <button class="btn btn-light mt-1">{{$home_page->noi_dung_nut_1}}</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 ht-titile">
                        <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_2) }}"
                                onerror="this.src='{{ asset('/imgnew/litv2.png') }}'"
                                alt="" class="w-100">
                        <div class="titile">
                            <h5 class="text-light">{{$home_page->tieu_de_loi_ich_thanh_vien_2}}</h5>
                            <a href="/allproduct" class="d-flex justify-content-center">
                                <button class="btn btn-light mt-1">{{$home_page->noi_dung_nut_2}}</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4 ht-titile">
                        <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_3) }}"
                                onerror="this.src='{{ asset('/imgnew/litv3.jpg') }}'"
                                alt="" class="w-100">
                        <div class="titile">
                            <h5 class="text-light">{{$home_page->tieu_de_loi_ich_thanh_vien_3}}</h5>
                            <a href="/allproduct" class="d-flex justify-content-center">
                                <button class="btn btn-light mt-1">{{$home_page->noi_dung_nut_3}}</button>
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