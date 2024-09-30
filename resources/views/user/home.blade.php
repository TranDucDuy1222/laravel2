@extends('user.layout')
@section('title')
Trang Chủ - Nike
@endsection

@section('category')
@foreach ($loai as $category)
  <li class="nav-item">
  <a class="nav-link fz" href="/category/{{$category->id}}">
    {{$category->ten_loai}}
  </a>
  </li>
@endforeach
@endsection


@section('content')

<!-- Header -->
<header class="container-fluid">
  <div id="carouselExampleCaptions" class="carousel slide mx-xl-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner">
      <div class="text-center">

        <h5>Giao hàng miễn phí</h5>
        <p class="m-1">Áp dụng cho đơn hàng từ 5.000.000₫ trở lên.</p>
      </div>
      <div class="carousel-item active">
        <img src="/imgnew/banner1.png" class="d-block w-100 img-header" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>NIKE AIR MAX DN</h5>
          <p>Thế hệ tiếp theo của công nghệ Air sắp ra mắt vào ngày 26/03.</p>
        </div>
      </div>

      <div class="carousel-item active">
        <img src="/imgnew/banner3.jpg" class="d-block w-100 img-header" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <h5>MUA SẮM NGAY</h5>
          <p>Trở thành thành viên của chúng tôi để có những mã giảm giá.</p>
        </div>
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</header>
<!-- End header -->

<!-- Home -->

<section class="container-fluid section">
  <div class="mx-xl-5">
    <a href="/allproduct" class="d-flex justify-content-center">
      <button class="btn btn-outline-dark mt-2">Cửa Hàng</button>
    </a>
    
    <br>
    <!-- Sản phẩm mới -->
    <h3>Sản Phẩm Mới</h3>
    <div class="row">
      <!-- Hiển thị 4 sản phẩm -->
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
      <div class="col-sm-6 col-lg-3 my-sm-2">
        <div class="card">
        <a href="/detail/{{$item->id}}" id="hover-img-home">
          <img src="/img/{{$item->hinh}}" alt="" class="w-100">
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
  @endforeach
      <!-- End hiển thị sản phẩm -->
    </div>
    <!-- End sản phẩm mới -->
    <br>
    <!-- Xu hướng -->
    <h3>Xu Hướng</h3>
    <div class="text-center">
      <img src="/imgnew/xuhuong.jpg" alt="" class="w-100">
      <h1 class="mt-2 fs-h1">AJ1 HIGHT OG 'BLACK OR WHITE'</h1>
      <p class="fs-5">Hãy diện đồ và xuất hiện theo phong cách màu sắc mang tính biểu tượng theo phong cách của bạn.</p>
      <a href="/allproduct" class="d-flex justify-content-center">
        <button class="btn btn-outline-dark mt-1">Cửa Hàng</button>
      </a>
    </div>
    <!-- End xu hướng -->
    <br>
    <!-- Đặc sắc -->
    <h3>Đặc Sắc</h3>
    <div class="row">
      <div class="col-sm-4 ht-titile">
        <img src="/imgnew/dacsac3.png" alt="" class="w-100">
        <div class="titile">
          <h5 class="text-light">Bộ Sưu Tập Air Jordan 1</h5>
          <a href="allproduct" class="d-flex justify-content-center">
            <button class="btn btn-light mt-1">Cửa Hàng</button>
          </a>
        </div>
      </div>
      <div class="col-sm-4 ht-titile">
        <img src="/imgnew/dacsac1.png" alt="" class="w-100">
        <div class="titile">
          <h5 class="text-light">Bộ Sưu Tập Giày Cổ Điển</h5>
          <a href="/allproduct" class="d-flex justify-content-center">
            <button class="btn btn-light mt-1">Cửa Hàng</button>
          </a>
        </div>
      </div>
      <div class="col-sm-4 ht-titile">
        <img src="/imgnew/dacsac2.png" alt="" class="w-100">
        <div class="titile">
          <h5 class="text-light">Bộ Sưu Tập Nike Zenvy</h5>
          <a href="/allproduct" class="d-flex justify-content-center">
            <button class="btn btn-light mt-1">Cửa Hàng</button>
          </a>
        </div>
      </div>
    </div>
    <!-- End Đặc sắc -->
    <br>
    <!-- Mua sắm theo thể thao -->
    <h3>Mua Sắm Theo Thể Thao</h3>
    <div class="row">
      <div class="col-sm-4">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/imgnew/thethao1.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Bóng Rổ</h5>
                <p>Phong cách thể thao của bạn.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>

              </div>
            </div>
            <div class="carousel-item">
              <img src="/imgnew/thethao2.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Golf</h5>
                <p>Cùng bạn chinh phục.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/imgnew/thethao3.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Chạy Bộ</h5>
                <p>Đồng Hành Cùng Bạn Trên Mọi Đoạn Đường.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>

              </div>
            </div>
            <div class="carousel-item">
              <img src="/imgnew/thethao4.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Quần Vợt</h5>
                <p>Cùng bạn chinh phục.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/imgnew/thethao5.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Bóng Đá</h5>
                <p>Chiến Thắng Cùng Bạn.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>

              </div>
            </div>
            <div class="carousel-item">
              <img src="/imgnew/thethao4.jpg" class="d-block w-100" alt="...">
              <div class="carousel-caption d-none d-md-block">
                <h5>Nike Cầu Lông</h5>
                <p>Cùng bạn chinh phục.</p>
                <a href="/allproduct" class="d-flex justify-content-center">
                  <button class="btn btn-light mt-1">Cửa Hàng</button>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End mua sắm theo thể thao -->
    <br>
    <h3>Lợi Ích Thành Viên</h3>
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