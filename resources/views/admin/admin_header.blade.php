<body class="sidebar-main-active right-column-fixed">
      <div class="wrapper">
         <div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-center shadow">
               <a href="index1.html" class="">
                  <img src="{{ asset('/uploads/logo/logolight.png') }}" class="img-fluid" alt="">

               </a>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li><a href="{{url('admin')}}">
                        <i class='sa-nav__icon fas fa-tachometer-alt'></i>
                        <span class="app-menu__label">Thống Kê</span>
                        </a>
                     </li>
                     <li><a href="{{url('admin/san-pham')}}">
                        <i class='sa-nav__icon fas fa-box'></i>
                        <span class="app-menu__label">Quản lý sản phẩm</span>
                        </a>
                     </li>
                     <li><a href="{{url('/admin/danh-muc')}}">
                        <i class='sa-nav__icon fas fa-boxes'></i>
                        <span class="app-menu__label">Quản lý danh mục</span>
                        </a>
                     </li>
                     <li><a href="{{url('/admin/tai-khoan')}}">
                        <i class='sa-nav__icon fas fa-user'></i>
                        <span class="app-menu__label">Quản lý tài Khoản</span>
                        </a>
                     </li>
                     <li><a href="{{url('/admin/don-hang')}}">
                        <i class="sa-nav__icon fa-solid fa-cart-shopping"></i>
                        <span class="app-menu__label">Quản lý đơn hàng</span>
                        </a>
                     </li>
                     <li><a href="{{url('/admin/magiamgia')}}">
                           <i class="fa-solid fa-ticket-simple"></i>
                        <span class="app-menu__label">Mã giảm giá</span>
                        </a>
                     </li>
                     <li><a href="{{url('admin/danh-gia')}}">
                           <i class='sa-nav__icon fa-solid fa-comment'></i>
                           <span class="app-menu__label">Đánh Giá</span>
                        </a>
                     </li>
                     <li><a href="{{url('admin/email')}}">
                           <i class='sa-nav__icon fa-solid fa-envelope-open-text'></i>
                           <span class="app-menu__label">Email</span>
                        </a>
                     </li>
                     <li><a href="{{url('admin/trang-chu')}}">
                           <i class='sa-nav__icon fa-solid fa-house-user'></i>
                           <span class="app-menu__label">Trang Chủ</span>
                        </a>
                     </li>
                     <li><a href="{{url('admin/cai-dat')}}">
                        <i class="sa-nav__icon fa-solid fa-gear"></i>
                        <span class="app-menu__label">Thiết lập cài đặt</span>
                        </a>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar shadow">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb d-block">
                     <h4 class="mb-0 text-dark">@yield('title')</h4>
                  </div>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  </div>
                  <ul class="navbar-list">
                     <li class="line-height">
                        <div class="dropdown">
                           <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              @if (Auth::check())
                              <span class="fw-semibold">
                                 {{Auth::user()->name}}
                              </span>
                              <span class="">
                                 {{Auth::user()->email}}
                              </span>
                              @else
                                 <span class="">
                                    
                                 </span>
                                 <span class="">
                                    
                                 </span>
                              @endif 
                           </a>
                           <ul class="dropdown-menu">
                              <li>
                                 <div class="iq-card shadow-none m-0">
                                    <div class="iq-card-body p-0 ">
                                       <div class="d-inline-block w-100 text-center p-3">
                                          <a class="btn btn-primary" href="/logout" role="button">Đăng xuất <i class="ri-login-box-line ml-2"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </li>
                           </ul>
                        </div>
                     </li>
                  </ul>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
         <!-- Page Content  -->
         @if(session()->has('thongbao'))
         <div class="toast show align-items-center text-bg-primary border-0 position-fixed end-0 p-3 z-9" style="top: 100px;" role="alert"
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