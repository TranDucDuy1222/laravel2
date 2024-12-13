@extends('user.layout')
@section('title')
Kết Quả Tìm Kiếm
@endsection

@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ route('loai-san-pham',$category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham' , $dm->slug)}}">{{$dm->ten_dm}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endsection

@section('content')
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="2000">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner img-header-all">
        <div class="carousel-item active">
        <img src="{{ asset('/imgnew/allpro.jpg') }}" class="d-block w-100 img-header-all" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h5>First slide label</h5>
            <p>Some representative placeholder content for the first slide.</p>
        </div>
        </div>
        <div class="carousel-item" >
        <img src="{{ asset('/imgnew/allpro2.png') }}" class="d-block w-100 img-header-all" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h5>Second slide label</h5>
            <p>Some representative placeholder content for the second slide.</p>
        </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>
    <div class="container">
        <div class="d-flex text-center justify-content-center align-content-center " style="font-size: 24px;">
            Tìm thấy 
            <p class="text-dark p-0 mx-2 justify-content-center align-content-center" style="font-size: 24px;">{{ $sanphamsCount }}</p> 
            sản phẩm cho từ khoá :
            <p class="text-dark p-0 mx-2 justify-content-center align-content-center" style="font-size: 24px;"> {{ request('tim-kiem') }} </p> 
        </div>
        <h2 class=""></h2>
        @if($sanphams->isEmpty())
            <p>Không tìm thấy sản phẩm nào.</p>
        @else
            <div class="row mx-xl-5">
                @foreach($sanphams as $item)
                    @php 
                        $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia; 
                        $gia = number_format($gianew, 0, '', '.'); 
                    @endphp
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-2">
                        @if ($item->trang_thai === 1 )
                            <div class="product-short ">
                                <div class="product-short__container out-stock">
                                    <div class="card">
                                        <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                onerror="this.src='{{ asset('/uploads') }}'"
                                                style="max-height: 295px;" alt="" class="img-fluid">
                                            @if ($item->gia_km > 0)
                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" alt="" class="img-sale">
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
                                            @if ($item->gia_km > 0 && $item->trang_thai != 2)
                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_sale ) }}" style="" alt="" class="img-sale">
                                            @elseif($item->gia_km > 0 && $item->trang_thai === 2)
                                                <img src="{{ asset('/uploads/logo/'. optional($settings)->logo_cms ) }}" style="" alt="" class="img-sale">
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
        @endif
    </div>
@endsection
