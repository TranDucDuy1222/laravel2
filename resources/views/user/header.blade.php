<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Preconnect để tối ưu tải font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

  <!-- Logo -->
  <link rel="shortcut icon" href="{{asset('/uploads/logo/iconlogo.png')}}" type="image/x-icon">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/FE/fontawesome-free-6.5.1-web/css/all.min.css">

  <!-- CSS -->
  <link rel="stylesheet" href="/FE/bootstrap-5/css/bootstrap.min.css">
  <link rel="stylesheet" href="/FE/css/nav.css">
  <link rel="stylesheet" href="/FE/css/header.css">
  <link rel="stylesheet" href="/FE/css/footer.css">
  <link rel="stylesheet" href="/FE/css/home.css">
  <link rel="stylesheet" href="/FE/css/allproduct.css">
  <link rel="stylesheet" href="/FE/css/cart.css">
  <link rel="stylesheet" href="/FE/css/detail.css">
  <link rel="stylesheet" href="/FE/css/login.css">
  <link rel="stylesheet" href="/FE/css/order.css">
  <link rel="stylesheet" href="/FE/css/order-detail.css">
  <link rel="stylesheet" href="/FE/css/cssHome.css">
  <link rel="stylesheet" href="/FE/css/buy.css">
  <link rel="stylesheet" href="/FE/css/profile.css">


  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <!-- Liên kết tới jQuery --> 
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Liên kết tới Popper.js, yêu cầu cho Bootstrap 4 --> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>



<body>

  <!-- Nav   -->
  <nav class="header--style">
    <nav class="primary-nav primary-nav-wrapper--border">
      <div class="container">
        <div class="primary-nav">
          <a class="main-logo" href="/">
            <img src="{{ asset('uploads/logo/logolight.png') }}" width="140" height="60" alt="" />
          </a>
          <form class=" ms-xl-5 main-form border rounded-4 border-dark-subtle">
            <div class="d-flex align-items-center ms-2">
              <i class="fa-solid fa-magnifying-glass fa-beat-fade" style="color: #080808;"></i>
              <input class="custom-input border-0 ms-2" type="search" name="keyw" placeholder="Nhập...">
            </div>
          </form>
          <div class="menu-init">
            <div class="ah-lg-mode">
              <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                <li>
                  <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a>
                </li>
                <li>
                  <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a>
                </li>
                <li>
                  <a class="s-youtube--color-hover" href="#"><i class="fab fa-youtube"></i></a>
                </li>
                <li>
                  <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a>
                </li>
                <li>
                  <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <nav class="navbar navbar-expand-lg bg-body secondary-nav-wrapper shadow ">
      @if(session()->has('thongbao'))
      <div class="z-1 toast show align-items-center text-bg-danger border-0 position-fixed top-3 end-0 p-3" role="alert"
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
      <div class="container">
        <div class="menu-init">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
            aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <ul class="navbar-nav ms-auto ah-list--design2 ah-list--link-color-secondary">
              <li class="nav-item">
                <a class="nav-link fz " href="{{ url('loai-san-pham/tat-ca-san-pham') }}">
                  <p class="hover-title fz">
                    Mới và Nổi Bật
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link fz" href="{{ url('loai-san-pham/giam-gia') }}">
                  <p class="hover-title fz">
                    Giảm Giá
                  </p>
                </a>
              </li>
              @yield('category')

            </ul>
          </div>
        </div>
        <div class="menu-init">
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample3"
            aria-controls="offcanvasExample3">
            <i class="fas fa-shopping-bag"></i>
          </button>
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample3"
            aria-labelledby="offcanvasExampleLabel3">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasExampleLabel3"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <ul class="navbar-nav ms-auto me-lg-3">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu" id="userDropdown">
                  @if (Auth::check())
            <li class="dropdown-item">{{Auth::user()->name}}!</li>
            <hr>
            <li><a class="dropdown-item" href="{{ route('user.profile', [Auth::user()->id]) }}">Quản Lý Tài
              Khoản</a></li>
            <hr>
            <li><a class="dropdown-item" href="{{ route('user.purchase', [Auth::user()->id]) }}">Đơn Hàng Đã
              Mua</a></li>
            <hr>
            <li><a class="dropdown-item" href="/logout">Đăng Xuất</a></li>
          @else
        <li><a class="dropdown-item" href="/login">Đăng Nhập</a></li>
        <li><a class="dropdown-item" href="/signup">Đăng Ký</a></li>
        <li><a class="dropdown-item" href="">Quên Mật Khẩu</a></li>
      @endif
                </ul>

              </li>
              <li class="nav-item dropdown">
                <a class="nav-link fz dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Hỗ Trợ
                </a>
                <ul class="dropdown-menu" id="userDropdown">
                  <li><a class="dropdown-item" href="#">Địa Chỉ Cửa Hàng</a></li>
                  <li><a class="dropdown-item" href="/lien-he">Liên Hệ Chúng Tôi</a></li>
                  <li><a class="dropdown-item" href="#">Giới Thiệu</a></li>
                  <li><a class="dropdown-item" href="#">Gửi Phản Hồi</a></li>
                  <li><a class="dropdown-item" href="#">Chính Sách Bán Hàng</a></li>
                </ul>
              </li>
              <li class="nav-item position-relative" style="width: 35px;">
                <a class="nav-link" href="{{url('/gio-hang')}}">
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ session('totalProducts', 0) }}
                  </span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </nav>
  <!-- End Nav -->