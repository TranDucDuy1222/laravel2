<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>
            @yield('title')
      </title>
      <!--FONT-GG-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;700&display=swap" rel="stylesheet">
      <!--FONT AWESOME-->
      <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
      <!-- MAIN-CSS -->
      <!--CSS-BOOSTRAP-->
      <link rel="stylesheet" href="/FE/bootstrap-5/css/bootstrap.min.css">
      <link rel="stylesheet" href="/FE/fontawesome-free-6.5.1-web/css/all.min.css">
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
</head>
<body>
  <!-- Nav   -->
  <nav class="header--style">
            <nav class="primary-nav primary-nav-wrapper--border">
                <div class="container">
                    <div class="primary-nav">
                        <a class="main-logo" href="/">
                        <img src="{{ asset('/uploads/logo/' . '') }}" width="140"
                        height="60" onerror="this.src='{{ asset('/uploads/logo/logolight.png') }}'" alt="" />
                        </a>
                        <form class="main-form">
                          <div class="d-flex ms-2 search-box">
                            <i class="fa-solid fa-magnifying-glass fa-fade"></i>
                            <input class="form-control" type="search" name="keyw" placeholder="Nhập...">
                          </div>
                        </form>
                        <div class="menu-init">
                            <div class="ah-lg-mode">
                                <ul class="ah-list ah-list--design1 ah-list--link-color-secondary"> 
                                    <li>
                                        <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li>
                                        <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li>
                                        <a class="s-youtube--color-hover" href="#"><i class="fab fa-youtube"></i></a></li>
                                    <li>
                                        <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li>
                                        <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a></li>  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <nav class="navbar navbar-expand-lg bg-body secondary-nav-wrapper shadow">
                <div class="container">
                    <div class="menu-init">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <ul class="navbar-nav ms-auto">
                              <li class="nav-item">
                                <a class="nav-link fz" href="/allproduct">
                                  Mới và Nổi Bật
                                </a>
                              </li>
                              @yield('category')
                              <li class="nav-item">
                                <a class="nav-link fz" href="/sale">
                                  Giảm Giá
                                </a>
                              </li>
                            </ul>
                        </div>
                    </div>
                    <div class="menu-init">
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample3" aria-controls="offcanvasExample3">
                            <span class="fas fa-shopping-bag"></span>
                        </button>
                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample3" aria-labelledby="offcanvasExampleLabel3">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasExampleLabel3"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <ul class="navbar-nav ms-auto me-lg-3">         
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>  
              </a>
              <ul class="dropdown-menu" id="userDropdown">
                @if (Auth::check())
                  <li class="dropdown-item">{{Auth::user()->name}}!</li>
                  <hr>
                  <li ><a class="dropdown-item" href="">Quản Lý Tài Khoản</a></li>
                  <hr>
                  <li ><a class="dropdown-item" href="">Đơn Hàng Đã Mua</a></li>
                  <hr>
                  <li ><a class="dropdown-item" href="/logout">Đăng Xuất</a></li>
                @else
                  <li ><a class="dropdown-item" href="/login">Đăng Nhập</a></li>
                  <li ><a class="dropdown-item" href="/signup">Đăng Ký</a></li>
                  <li ><a class="dropdown-item" href="">Quên Mật Khẩu</a></li>
                @endif
              </ul>
              
            </li>   
            <li class="nav-item dropdown">
              <a class="nav-link fz dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hỗ Trợ
              </a>
              <ul class="dropdown-menu" id="userDropdown">
                <li><a class="dropdown-item" href="#">Địa Chỉ Cửa Hàng</a></li>
                <li><a class="dropdown-item" href="#">Liên Hệ Chúng Tôi</a></li>
                <li><a class="dropdown-item" href="#">Giới Thiệu</a></li>
                <li><a class="dropdown-item" href="#">Gửi Phản Hồi</a></li>
                <li><a class="dropdown-item" href="#">Chính Sách Bán Hàng</a></li>
              </ul>
            </li>  
            <li class="nav-item position-relative" style="width: 35px;">
                <a class="nav-link" href="" >
                  <i class="fa-solid fa-cart-shopping"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    0
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

