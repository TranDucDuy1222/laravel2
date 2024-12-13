@extends('user.layout')
@section('title')
Trang Chủ - TrendyU
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

<!-- Header -->
    <header class="shadow-none">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000" >
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>
            <div class="carousel-inner img-header">
                <div class="carousel-item active">
                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_bieu_ngu_1) }}"
                        onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" class="d-block w-100 img-header" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h2 style="color: {{$home_page->mau_tieu_de_chinh_1}};" >{{$home_page->tieu_de_chinh_1}}</h2>
                        <h3>{{$home_page->tieu_de_phu_1}}</h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_bieu_ngu_2) }}"
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
            
        <!-- End slogan -->
    </header>
<!-- End header -->

<!-- Home -->
    <section class="container-fluid section text-black">
        <!-- Sản phẩm mới -->
        <div class="pt-lg-4">
            <div class="section__intro mb-3">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap ">
                                <h2 class="section__heading u-c-secondary mb-2 underline-animations">{{$home_page->tieu_de_gioi_thieu_san_pham}}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="container">
                    <div class="">
                        <div class="row" >
                            <div class="col-lg-6 col-md-12">
                            <a class="i3-banner">
                                <div class="aspect aspect--bg-grey-fb aspect--square" >
                                    <img class="aspect__img i3-banner__img" src="{{ asset('/uploads/banner/' . $home_page->anh_chinh_gioi_thieu_san_pham) }}"
                                        onerror="this.src='{{ asset('/uploads/banner/bannerspnew.png') }}'" alt="">
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="row">
                                    @foreach ($sanphamhome as $item)
                                        @php
                                            $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                                            $gia = number_format($gianew, 0, '', '.'); 
                                        @endphp
                                        <div class="col-lg-6 col-md-6 col-sm-6 dt">
                                            <div class="product-short">
                                                <div class="product-short__container">
                                                    <div class="card">
                                                        @if ($item->trang_thai != 3)
                                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                    onerror="this.src='{{ asset('/uploads') }}'"
                                                                    style="max-height: 295px;" alt="" class=" img-fluid">
                                                                @if ($item->gia_km > 0)
                                                                    <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                                @endif
                                                            </a>
                                                        @elseif ($item->trang_thai == 3)
                                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container d-flex justify-content-center align-content-center">
                                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                    onerror="this.src='{{ asset('/uploads') }}'"
                                                                    style="max-height: 295px;" alt="" class="img-fluid">
                                                                <img src="{{ asset('/uploads/logo/') }}" onerror="this.src='{{ asset('/uploads/logo/logocs1.png') }}'" class="overlay-image" alt="">
                                                            </a>
                                                        @endif
                                                        <div class="card-body text-center">
                                                            <a href="">
                                                                <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                            </a>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                    <div class="col-7 text-start">
                                                                        <div class="d-flex align-items-center">
                                                                            @if ($item->trang_thai != 3)
                                                                                <strong id="color-gia">{{ $gia }}đ</strong>
                                                                                @if ($item->gia_km >= 1) 
                                                                                    @php 
                                                                                        $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                    @endphp 
                                                                                    @if ($discountPercentage > 1) 
                                                                                        <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                        -{{ number_format($discountPercentage, 0) }}% 
                                                                                        </div> 
                                                                                    @endif                                
                                                                                @endif
                                                                            @else
                                                                                <a href="{{ route('user.contact') }}" id="hover-sp">
                                                                                    <strong id="color-gia">Liên hệ</strong>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-5 text-end">
                                                                        <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                        <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-start">
                                                                    {{$item->ten_dm}}
                                                                </div>
                                                                <div class="col-12 text-truncate">
                                                                    <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                        {{ $item->mo_ta_ngan }}
                                                                    </span>
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
                                                    src="{{ asset('/uploads/banner/' . $home_page->anh_phu_gioi_thieu_san_pham) }}"
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
        
        <!-- Sản phẩm xu hướng -->
        <div class="pt-lg-4">
            <div class="section__intro mb-2">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary mb-2 underline-animations">{{$home_page->tieu_de_chinh_xu_huong}}</h1>
                                <span class="section__span u-c-silver mb-2">{{$home_page->tieu_de_phu_xu_huong}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 custom-rounded-col p-0">
                            <div class="filter-category-container dm_xh">
                                <ul class="nav flex-column w-100" id="pills-tab" role="tablist">
                                    @foreach ($loai_arr as $loai)
                                        <div class="filter__category-wrapper custom-xh">
                                            <button class="nav-link custom-btn w-100 {{ $loop->first ? 'active' : '' }}" id="tab-{{$loai->id}}" data-bs-toggle="tab" data-bs-target="#pane-{{$loai->id}}" type="button" role="tab" aria-controls="pane-{{$loai->id}}" aria-selected="{{ $loop->first ? 'true' : 'false' }}" data-loai="{{$loai->slug}}">{{$loai->ten_loai}}</button>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="filter__grid-wrapper">
                                <div class="row tab-content" id="myTabContent">
                                    <!-- Sản phẩm theo loại -->
                                    @foreach ($loai_arr as $loai)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="pane-{{$loai->id}}" role="tabpanel"
                                    aria-labelledby="tab-{{$loai->id}}">
                                            <div class="row">
                                                @foreach ($sanpham[$loai->slug] as $index => $item)
                                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 filter__item outwear">
                                                        @php 
                                                            $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                                                            $gia = number_format($gianew, 0, '', '.'); 
                                                        @endphp
                                                        @if ($item->trang_thai === 1)
                                                            <div class="product-short ">
                                                                <div class="product-short__container out-stock">
                                                                    <div class="card p-0">
                                                                        <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                                onerror="this.src='{{ asset('/uploads') }}'"
                                                                                style="max-height: 295px;" alt="" class="img-fluid ">
                                                                            @if ($item->gia_km > 0)
                                                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                                            @endif
                                                                        </a>
                                                                        <div class="card-body text-center">
                                                                            <a href="">
                                                                                <h5 id="hover-sp" class="text-truncate">{{$item->ten_sp}}</h5>
                                                                            </a>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                    <div class="col-sm-6 col-12 text-start">
                                                                                        <div class="d-flex align-items-center">
                                                                                            <strong id="color-gia">{{ $gia }}đ</strong>
                                                                                            @if ($item->gia_km >= 1) 
                                                                                                @php 
                                                                                                    $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                                @endphp 
                                                                                                @if ($discountPercentage > 1) 
                                                                                                    <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                                    -{{ number_format($discountPercentage, 0) }}% 
                                                                                                    </div> 
                                                                                                @endif                                
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-12 text-start text-sm-end">
                                                                                        <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                                        <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 text-start">
                                                                                    {{$item->ten_dm}}
                                                                                </div>
                                                                                <div class="col-12 text-truncate">
                                                                                    <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                                        {{ $item->mo_ta_ngan }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="product-short">
                                                                <div class="product-short__container">
                                                                    <div class="card">
                                                                        <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                                onerror="this.src='{{ asset('/uploads') }}'"
                                                                                style="max-height: 295px;" alt="" class="img-fluid ">
                                                                            @if ($item->gia_km > 0)
                                                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                                            @endif
                                                                        </a>
                                                                        <div class="card-body text-center">
                                                                            <a href="">
                                                                                <h5 id="hover-sp" class="text-truncate">{{$item->ten_sp}}</h5>
                                                                            </a>
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="row">
                                                                                    <div class="col-sm-6 col-12 text-start">
                                                                                        <div class="d-flex align-items-center">
                                                                                            <strong id="color-gia">{{ $gia }}đ</strong>
                                                                                            @if ($item->gia_km >= 1) 
                                                                                                @php 
                                                                                                    $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                                @endphp 
                                                                                                @if ($discountPercentage > 1) 
                                                                                                    <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                                    -{{ number_format($discountPercentage, 0) }}% 
                                                                                                    </div> 
                                                                                                @endif                                
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-sm-6 col-12 text-start text-sm-end">
                                                                                        <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                                        <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-12 text-start">
                                                                                    {{$item->ten_dm}}
                                                                                </div>
                                                                                <div class="col-12 text-truncate">
                                                                                    <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                                        {{ $item->mo_ta_ngan }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                    <!-- End sản phẩm theo loại -->
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('loai-san-pham', 'ao') }}" class="" id="see-all-link">
                                    <button class="custom-button mt-2">Xem tất cả →</button>
                                </a>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- End xu hướng -->
        <br>
        <!-- Danh mục sản phẩm -->
        <div class="pt-lg-4">
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-3 d-flex align-items-stretch">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey">
                                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_danh_muc_1) }}"
                                        onerror="this.src='{{ asset('/uploads/banner/dmnike1.jpg') }}'"
                                        alt="" class="w-100 h-100">
                                </div>
                                <div class="promotion-o__content">
                                    <a class="promotion-o__link btn--e-white-brand" href="">{{$home_page->tieu_de_danh_muc_1}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-3 d-flex align-items-stretch">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey ">
                                <img src="{{ asset('/uploads/banner/' . $home_page->anh_danh_muc_2) }}"
                                        onerror="this.src='{{ asset('/uploads/banner/dmnike2.png') }}'"
                                        alt="" class="w-100 h-100">
                                </div>
                                <div class="promotion-o__content">
                                    <a class="promotion-o__link btn--e-white-brand" href="">{{$home_page->tieu_de_danh_muc_2}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mb-3 d-flex align-items-stretch">
                            <div class="promotion-o">
                                <div class="aspect aspect--bg-grey">
                                <img src="{{ asset('/uploads/banner/' . $home_page->anh_danh_muc_3) }}"
                                        onerror="this.src='{{ asset('/uploads/banner/dmnike3.jpeg') }}'"
                                        alt="" class="w-100 h-100">
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
        <!-- End danh mục sản phẩm -->

        <!-- Sản phẩm sale -->
        <div class="pt-lg-4">
            <div class="section__intro ">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary mb-2 underline-animations">{{$home_page->tieu_de_khuyen_mai_chinh}}</h1>
                                <span class="section__span u-c-silver">{{$home_page->tieu_de_khuyen_mai_phu}}</span>
                            </div>
                        </div>
                        <div class="col-lg-4 position-relative p-0">
                            <a href="{{ route('loai-san-pham' ,'giam-gia') }}" class="i3-banner rounded-5">
                                <div class="aspect aspect--bg-grey-fb aspect--square ">
                                    <img src="{{ asset('/uploads/logo/' . optional($settings)->banner_dung_sale) }}" alt="" class="aspect__img i3-banner__img w-100 h-100">
                                </div>
                            </a>
                            <div class="position-absolute bottom-0 start-50 translate-middle">
                                <a href="" class="d-flex justify-content-center">
                                    <button class="custom-button-sale mt-2" style="color: red; background-color: white;">Xem tất cả →</button>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="section__content">
                                <div class="container">
                                    <div class="row">
                                        @foreach ($sanphamsale as $item)
                                            @php 
                                                $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                                                $gia = number_format($gianew, 0, '', '.'); 
                                            @endphp
                                            <div class="col-lg-4 col-md-6 col-sm-6 mt-1">
                                                <div class="product-short">
                                                    <div class="product-short__container">
                                                        <div class="card">
                                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                    onerror="this.src='{{ asset('/uploads') }}'"
                                                                    style="max-height: 295px;" alt="" class="img-fluid">
                                                                    <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                            </a>
                                                            <div class="card-body text-center">
                                                                <a href="">
                                                                    <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                                </a>
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="row">
                                                                        <div class="col-6 text-start">
                                                                            <div class="d-flex align-items-center">
                                                                                <strong id="color-gia">{{ $gia }}đ</strong>
                                                                                @if ($item->gia_km >= 1) 
                                                                                    @php 
                                                                                        $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                    @endphp 
                                                                                    @if ($discountPercentage > 1) 
                                                                                        <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                        -{{ number_format($discountPercentage, 0) }}% 
                                                                                        </div> 
                                                                                    @endif                                
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6 text-end">
                                                                            <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                            <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 text-start">
                                                                        {{$item->ten_dm}}
                                                                    </div>
                                                                    <div class="col-12 text-truncate">
                                                                        <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                            {{ $item->mo_ta_ngan }}
                                                                        </span>
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
                        <a href="{{ route('loai-san-pham' ,'giam-gia') }}" class="d-flex justify-content-center">
                            <button class="custom-button mt-2">Xem tất cả →</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End sản phẩm sale -->  

        <!-- Sản phẩm bán chạy -->
        <div class="pt-lg-4">
            <div class="section__intro mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary mb-2 underline-animations">{{$home_page->tieu_de_san_pham_moi_chinh}}</h1>
                                <span class="section__span u-c-silver">{{$home_page->tieu_de_san_pham_moi_phu}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 card p-0 ">
                            <div class="parent-div text-start">
                                @foreach ($top_sanpham as $index => $item)
                                    @php
                                        $index += 1; // Tăng chỉ số lên 1 vì $index bắt đầu từ 0
                                    @endphp
                                    @if ($index == 1)
                                        <div class="p-2 child-div top">
                                            <i class="fa-solid fa-medal" style="color: #d5a90b;"></i>
                                            <strong class="text-danger mx-2">{{$index}}</strong>
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}" class="" alt="">
                                            <a href="{{route('product.detail' , $item->id)}}" class="hover-title text-dark fz ms-1">
                                                {{$item->ten_sp}}
                                            </a>
                                        </div>
                                    @elseif ($index == 2)
                                        <div class="p-2 child-div top">
                                            <strong class="text-warning mx-2">{{$index}}</strong>
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}" class="" alt="">
                                            <a href="{{route('product.detail' , $item->id)}}" class="hover-title text-dark fz ms-1">
                                                {{$item->ten_sp}}
                                            </a>
                                        </div>
                                    @elseif ($index == 3)
                                        <div class="p-2 child-div top">
                                            <strong class="text-secondary mx-2">{{$index}}</strong>
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}" class="" alt="">
                                            <a href="{{route('product.detail' , $item->id)}}" class="hover-title text-dark fz ms-1">
                                                {{$item->ten_sp}}
                                            </a>
                                        </div>
                                    @else
                                        <div class="p-2 child-div top">
                                            <p class="text-dark mx-2">{{$index}}</p>
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}" class="" alt="">
                                            <a href="{{route('product.detail' , $item->id)}}" class="hover-title text-dark fz ms-1">
                                                {{$item->ten_sp}}
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-9 ">
                            <div class="row ">
                                @foreach ($sanphamnew as $item)
                                    @php 
                                        $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                                        $gia = number_format($gianew, 0, '', '.'); 
                                    @endphp
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-2">
                                        @if ($item->trang_thai === 1)
                                            <div class="product-short ">
                                                <div class="product-short__container out-stock">
                                                    <div class="card">
                                                        <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                onerror="this.src='{{ asset('/uploads') }}'"
                                                                style="max-height: 295px;" alt="" class="img-fluid">
                                                            @if ($item->gia_km > 0)
                                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                            @endif
                                                        </a>
                                                        <div class="card-body text-center">
                                                            <a href="">
                                                                <h5 id="hover-sp" class="text-truncate">{{$item->ten_sp}}</h5>
                                                            </a>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                    <div class="col-sm-6 col-12 text-start">
                                                                        <div class="d-flex align-items-center">
                                                                            <strong id="color-gia">{{ $gia }}đ</strong>
                                                                            @if ($item->gia_km >= 1) 
                                                                                @php 
                                                                                    $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                @endphp 
                                                                                @if ($discountPercentage > 1) 
                                                                                    <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                    -{{ number_format($discountPercentage, 0) }}% 
                                                                                    </div> 
                                                                                @endif                                
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-12 text-start text-sm-end">
                                                                        <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                        <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-start">
                                                                    {{$item->ten_dm}}
                                                                </div>
                                                                <div class="col-12 text-truncate">
                                                                    <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                        {{ $item->mo_ta_ngan }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <div class="product-short">
                                                <div class="product-short__container">
                                                    <div class="card">
                                                        <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                onerror="this.src='{{ asset('/uploads') }}'"
                                                                style="max-height: 295px;" alt="" class="img-fluid">
                                                            @if ($item->gia_km > 0)
                                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                                            @endif
                                                        </a>
                                                        <div class="card-body text-center">
                                                            <a href="">
                                                                <h5 id="hover-sp" class="text-truncate">{{$item->ten_sp}}</h5>
                                                            </a>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                    <div class="col-sm-6 col-12 text-start">
                                                                        <div class="d-flex align-items-center">
                                                                            <strong id="color-gia">{{ $gia }}đ</strong>
                                                                            @if ($item->gia_km >= 1) 
                                                                                @php 
                                                                                    $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                                @endphp 
                                                                                @if ($discountPercentage > 1) 
                                                                                    <div class="bg-text-success text-danger ms-2" style="font-size: 10px;"> 
                                                                                    -{{ number_format($discountPercentage, 0) }}% 
                                                                                    </div> 
                                                                                @endif                                
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-12 text-start text-sm-end">
                                                                        <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                        <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 text-start">
                                                                    {{$item->ten_dm}}
                                                                </div>
                                                                <div class="col-12 text-truncate">
                                                                    <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                        {{ $item->mo_ta_ngan }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a href="{{ route('loai-san-pham' ,'tat-ca-san-pham') }}" class="d-flex justify-content-center">
                <button class="custom-button mt-2">Xem tất cả →</button>
            </a> -->
        </div>
        <br>
        <!-- End sản phẩm bán chạy -->
    </section>

    <!-- Banner phụ -->
    <div class="banner-bg banner-bg-phu w-100" style="background-image: url({{ asset('/uploads/banner/' . $home_page->anh_bieu_ngu_phu) }});">
        <div class="section__content content-bg-phu">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-bg__wrap">
                            <div class="banner-bg__text-1">
                                <span style="color: {{ $home_page->mau_tieu_de_chinh_bieu_ngu_phu }};">{{ $home_page->tieu_de_chinh_bieu_ngu_phu }}</span>
                            </div>
                            <div class="banner-bg__text-2">
                                <span class="u-c-white">{{ $home_page->tieu_de_phu_bieu_ngu_phu }}</span>
                            </div>
                            <span class="banner-bg__text-block u-c-white banner-bg__text-3">{{ $home_page->mo_ta_bieu_ngu_phu }}</span>
                            <a href="{{ route('loai-san-pham', 'giam-gia') }}" class="d-flex justify-content-center">
                                <button class="custom-button mt-2">Xem tất cả →</button>
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
            <div class="pt-lg-4">
                <div class="section__intro mb-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-lg-4">
                                <div class="section__text-wrap">
                                    <h1 class="section__heading u-c-secondary mb-2 underline-animations">{{$home_page->tieu_de_san_pham_sap_ve}}</h1>
                                    <span class="section__span u-c-silver">{{$home_page->tieu_de_phu_san_pham_sap_ve}}</span>
                                </div>
                            </div>
                            <div class="col-lg-3 position-relative p-0">
                                <a class="i3-banner rounded-5">
                                    <div class="aspect aspect--bg-grey-fb aspect--square ">
                                        <img src="{{ asset('/uploads/logo/' . optional($settings)->banner_dung_cms) }}" alt="" class="aspect__img i3-banner__img w-100 h-100">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-9">
                                <div class="section__content">
                                    <div class="container">
                                        <div class="row">
                                            @foreach ($sanphamcs as $item)
                                            @php 
                                                $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                                                $gia = number_format($gianew, 0, '', '.'); 
                                            @endphp
                                                <div class=" col-lg-4 col-md-6 col-sm-6">
                                                    <div class="product-short">
                                                        <div class="product-short__container">
                                                            <div class="card">
                                                                <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container d-flex justify-content-center align-content-center">
                                                                    <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                                        onerror="this.src='{{ asset('/uploads') }}'"
                                                                        style="max-height: 295px;" alt="" class="img-fluid">
                                                                        <img src="{{ asset('/uploads/logo/logocs1.png') }}" class="overlay-image" alt="">
                                                                </a>
                                                                <div class="card-body text-center">
                                                                    <a href="">
                                                                        <h5 id="hover-sp">{{$item->ten_sp}}</h5>
                                                                    </a>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="row">
                                                                            <div class="col-7 text-start">
                                                                                <div class="d-flex align-items-center">
                                                                                    <a href="{{ route('user.contact') }}" id="hover-sp">
                                                                                        <strong id="color-gia">Liên hệ</strong>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-5 text-end">
                                                                                <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                                                                <span class="pd-detail__click-count">Đã Bán ({{$item->luot_mua ?? 0}})</span>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12 text-start">
                                                                            {{$item->ten_dm}}
                                                                        </div>
                                                                        <div class="col-12 text-truncate">
                                                                            <span class="pd-detail__click-count" style="font-size: 12px;">
                                                                                {{ $item->mo_ta_ngan }}
                                                                            </span>
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
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- End sản phẩm sắp về hàng -->
            <!-- Lợi ích thành viên -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="section__text-wrap">
                        <h2 class="section__heading u-c-secondary underline-animations">{{$home_page->tieu_de_thanh_vien}}</h2><br/>
                        <span class="">{{$home_page->tieu_de_phu_thanh_vien}}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 ht-titile" >
                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_loi_ich_thanh_vien_1) }}"
                            onerror="this.src='{{ asset('/imgnew/litv1.png') }}'"
                            alt="" class="img-fluid custom-img">
                    <div class="">
                        <h5 class="text-light">{{$home_page->tieu_de_loi_ich_thanh_vien_1}}</h5>
                        <a href="#" class="d-flex justify-content-center">
                            <button class="btn btn-light mt-1">{{$home_page->noi_dung_nut_1}}</button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 ht-titile" >
                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_loi_ich_thanh_vien_2) }}"
                            onerror="this.src='{{ asset('/imgnew/litv2.png') }}'"
                            alt="" class="img-fluid custom-img">
                    <div class="">
                        <h5 class="text-light">{{$home_page->tieu_de_loi_ich_thanh_vien_2}}</h5>
                        <a href="/allproduct" class="d-flex justify-content-center">
                            <button class="btn btn-light mt-1">{{$home_page->noi_dung_nut_2}}</button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 ht-titile" >
                    <img src="{{ asset('/uploads/banner/' . $home_page->anh_loi_ich_thanh_vien_3) }}"
                            onerror="this.src='{{ asset('/imgnew/litv3.jpg') }}'"
                            alt="" class="img-fluid custom-img">
                    <div class="">
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
 <script>
    // Active button loại sản phẩm
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link');
        var seeAllLink = document.getElementById('see-all-link');

        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Xóa lớp 'active' từ tất cả các nút
                navLinks.forEach(function(nav) {
                    nav.classList.remove('active');
                });
                // Thêm lớp 'active' vào nút được click
                link.classList.add('active');

                // Lấy giá trị loại sản phẩm từ thuộc tính data-loai
                var loaiSanPham = link.getAttribute('data-loai');

                // Cập nhật href của liên kết Xem tất cả
                seeAllLink.href = '{{ route("loai-san-pham", ":loai") }}'.replace(':loai', loaiSanPham);
            });
        });
    });

    // Active button
    document.addEventListener('DOMContentLoaded', function() {
    var navLinks = document.querySelectorAll('.custom-btn');

    navLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Xóa lớp 'active' từ tất cả các nút
            navLinks.forEach(function(nav) {
                nav.classList.remove('active');
            });
            // Thêm lớp 'active' vào nút được click
            link.classList.add('active');
        });
    });
});

 </script>
@endsection