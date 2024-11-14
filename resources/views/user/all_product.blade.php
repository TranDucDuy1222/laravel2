@extends('user.layout')
@section('title')
  {{ $title }} - Trendy U
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
    <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a>
    </li>
  @endif
  @endforeach
    </ul>
  </li>
@endforeach
@endsection

@section('content')

<!-- all product -->
<div class="container-fluid">
  <div class="mx-xl-5 mt-2 row">
  <h3 class="text-black">Bộ Lọc Sản Phẩm</h3>
    <div class="col-12 overflow-x-auto d-flex" id="box-menu-ngang">
      <!-- Danh mục -->
      <div class="menu-ngang">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Danh mục
        </p>
        <ul class="dropdown-menu">
          @foreach ($danh_muc as $dm)
            <li class="d-flex align-items-center">
                <a class="w-100 d-flex align-items-center" href="#">
                    <input type="checkbox" name="selected_products[]" class="form-check-input small-checkbox ms-3 me-2" >
                    <p class="text-start mb-0">{{ $dm->ten_dm }}</p>
                </a>
            </li>
          @endforeach        
        </ul>
      </div>
      <!-- Màu sắc -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Màu Sắc
        </p>
        <div class="dropdown-menu">
          <div class="row p-1 justify-content-center">
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-danger bg-danger" style="height: 40px; width: 40px;"></button>
              <p>Đỏ</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-primary bg-primary" style="height: 40px; width: 40px;"></button>
              <p>Xanh</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-warning bg-warning" style="height: 40px; width: 40px;"></button>
              <p>Vàng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle bg-dark" style="height: 40px; width: 40px;"></button>
              <p>Đen</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border bg-light" style="height: 40px; width: 40px;"></button>
              <p>Trắng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-secondary bg-secondary" style="height: 40px; width: 40px;"></button>
              <p>Xám</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border bgpink" style="height: 40px; width: 40px;"></button>
              <p>Hồng</p>
            </div>
            <div class="col-6 col-md-4 col-lg-3 mb-3 text-center">
              <button class="rounded-circle border border-success bg-success" style="height: 40px; width: 40px;"></button>
              <p>Xanh Lá</p>
            </div>
          </div>
        </div>
        
      </div>
      <!-- Kích cở giày -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Kích cở giày
        </p>
        <ul class="dropdown-menu"> 
          <div class="row p-1 justify-content-start g-1"> 
            <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37.5 </button> </div> <div class="col-4 col-md-3 col-lg-2 text-center"> <button class="border w-100"> 37 </button> </div> 
          </div> 
        </ul>
      </div>
      <!-- Kích cở quần áo -->
      <div class="ms-1">
        <p class="border p-1 rounded-1 text-black dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Kích cở quần áo
        </p>
        <ul class="dropdown-menu ">
            <li class="dropdown-item" id="moi_nhat" name="moi_nhat" onclick="sortProducts('moi_nhat')">Mới Nhất</li>
        </ul>
      </div>
    </div>
    <div class="col-12">
      <!-- Sắp xếp -->
      <div class="d-flex justify-content-end">
        <div class="">
          <button class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Sắp xếp
          </button>
          <ul class="dropdown-menu">
              <li class="dropdown-item" id="moi_nhat" name="moi_nhat" onclick="sortProducts('moi_nhat')">Mới Nhất</li>
              <li class="dropdown-item" id="tang_dan" name="tang_dan" onclick="sortProducts('tang_dan')">Giá tăng dần</li>
              <li class="dropdown-item" id="giam_dan" name="giam_dan" onclick="sortProducts('giam_dan')">Giá giảm dần</li>
          </ul>
        </div>
      </div>
      <br>
      <!-- show sản phẩm -->
      <div class="row">
        @foreach($products as $product) 
        @php 
          $gianew = $product->gia_km > 0 ? $product->gia_km : $product->gia; 
          $gia = number_format($gianew, 0, '', '.'); 
        @endphp
          <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <div class="product-short">
              <div class="product-short__container">
                <div class="card">
                  @if ($product->trang_thai != 3)
                      <a href="{{ route('product.detail',$product->id)}}" id="hover-img-home">
                          <img src="{{ asset('/uploads/product/' . $product->hinh) }}"
                              onerror="this.src='{{ asset('/uploads') }}'"
                              style="max-height: 295px;" alt="" class="w-100">
                      </a>
                  @elseif ($product->trang_thai == 3)
                      <a href="{{ route('product.detail',$product->id)}}" id="hover-img-home" class="image-container">
                          <img src="{{ asset('/uploads/product/' . $product->hinh) }}"
                              onerror="this.src='{{ asset('/uploads') }}'"
                              style="max-height: 295px;" alt="" class="w-100">
                          <img src="{{ asset('/uploads/logo/logocs1.png') }}" onerror="this.src='{{ asset('/uploads/logo/logocs1.png') }}'" class="overlay-image" alt="">
                      </a>
                  @endif
                  <div class="card-body">
                    <a href="" class="text-center">
                      <h5 id="hover-sp">{{$product->ten_sp}}</h5>
                    </a>
                    <div class="row">
                      <div class="col-12">
                        <div class="row">
                          <div class="col-7 text-start">
                            <div class="d-flex align-items-center">
                                @if ($product->trang_thai != 3)
                                    <strong id="color-gia">{{ $gia }}đ</strong>
                                    @if ($product->gia_km >= 1) 
                                        @php 
                                            $discountPercentage = (($product->gia - $product->gia_km) / $product->gia) * 100; 
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
                            <span class="pd-detail__click-count">Đã Bán ({{$product->luot_mua ?? 0}})</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-12">
                        {{$product->danhMuc->ten_dm}}
                      </div>
                      <div class="col-12 text-truncate">
                          <span class="pd-detail__click-count" style="font-size: 12px;">
                            {{ $product->mo_ta_ngan }}
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
      <!-- Phân trang -->
      <div class="text-center p-2 d-flex justify-content-center">{{$products->links('pagination::bootstrap-5')}}</div>
      <!-- End phân trang -->
    </div>
  </div>
</div>
<script> 
  function sortProducts(sortType) 
    { var url = new URL(window.location.href); 
    url.searchParams.set('sort', sortType); 
    window.location.href = url.toString(); } 
</script>
<!-- end all product -->
@endsection