<style>
    .notification-list {
    position: absolute;
    top: 50px;
    right: 0;
    width: 300px;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
    max-height: 500px;
    overflow-y: auto;
}

.notification-list ul {
    list-style-type: none;
    padding: 10px;
    margin: 0;
}

.notification-list li {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

.notification-list li:last-child {
    border-bottom: none;
}
</style>
<body>
    <!-- sa-app -->
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header">
                    <a class="sa-sidebar__logo" href="index.html">
                        <!-- logo -->
                        <div class="sa-sidebar-logo d-flex justify-content-center mt-2">
                            <img src="{{ asset('/uploads/logo/logolight.png') }}" width="140" height="60" alt="" />
                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <ul class="app-menu sa-nav__menu sa-nav__menu--root">
                                <li><a class="app-menu__item" href="admin.php">
                                        <i class='sa-nav__icon fas fa-tachometer-alt'></i>
                                        <span class="app-menu__label">Thống Kê</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('admin/san-pham')}}">
                                        <i class='sa-nav__icon fas fa-box'></i>
                                        <span class="app-menu__label">Quản lý sản phẩm</span>
                                        <span class="text-end">{{$product_quantity}}</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('/admin/danh-muc')}}">
                                        <i class='sa-nav__icon fas fa-boxes'></i>
                                        <span class="app-menu__label">Quản lý danh mục</span>
                                        <span class="text-end">{{$category_quantity}}</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('/admin/tai-khoan')}}">
                                    <i class='sa-nav__icon fas fa-user'></i>
                                    <span class="app-menu__label">Quản lý tài Khoản</span>
                                    <span class="text-end">{{$user_quantity}}</span></a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('/admin/don-hang')}}">
                                        <i class="sa-nav__icon fa-solid fa-cart-shopping"></i>
                                        <span class="app-menu__label">Quản lý đơn hàng</span>
                                        <span class="text-end">{{$order_quantity}}</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('/admin/magiamgia')}}">
                                        <i class='sa-nav__icon fa-solid fa-dollar-sign'></i>
                                        <span class="app-menu__label">Mã giảm giá</span>
                                        <span class="text-end">{{$voucher_quantity}}</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('admin/danh-gia')}}">
                                        <i class='sa-nav__icon fa-solid fa-comment'></i>
                                        <span class="app-menu__label">Đánh Giá</span>
                                        <span class="text-end">{{$review_quantity}}</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('admin/trang-chu')}}">
                                        <i class='sa-nav__icon fa-solid fa-house-user'></i>
                                        <span class="app-menu__label">Trang Chủ</span>
                                    </a>
                                </li>
                                <li><a class="app-menu__item" href="{{url('admin/cai-dat')}}">
                                        <i class='sa-nav__icon bx fa-solid fa-gear fa-spin'></i>
                                        <span class="app-menu__label">Thiết lập cài đặt</span>
                                    </a>
                                </li>
                            </ul>
                            <!-- <ul class="sa-nav__menu sa-nav__menu--root">
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="admin.php" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-tachometer-alt"></i>
                                        </span>
                                        <span class="sa-nav__title">Thống Kê</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('admin/san-pham')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        <span class="sa-nav__title">Sản Phẩm</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('/admin/danh-muc')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                        <span class="sa-nav__title">Danh Mục</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('/admin/tai-khoan')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="sa-nav__title">Tài Khoản</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('/admin/don-hang')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="sa-nav__title">Đơn Hàng</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('/admin/magiamgia')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fa-solid fa-dollar-sign"></i>
                                        </span>
                                        <span class="sa-nav__title">Mã giảm giá</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('admin/danh-gia')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                        <i class="fa-solid fa-comment" style="color: #ffffff;"></i>
                                        </span>
                                        <span class="sa-nav__title">Đánh Giá</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('admin/trang-chu')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                        <i class="fa-solid fa-house-user"></i>
                                        </span>
                                        <span class="sa-nav__title">Trang Chủ</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('admin/cai-dat')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fa-solid fa-gear fa-spin"></i>
                                        </span>
                                        <span class="sa-nav__title">Thiết lập cài đặt</span>
                                    </a>
                                </li>
                            </ul> -->
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sa-app__sidebar-shadow"></div>
            <div class="sa-app__sidebar-backdrop" data-sa-close-sidebar=""></div>
        </div>
        <!-- sa-app__sidebar / end -->
        <!-- sa-app__content -->
        <div class="sa-app__content">
            <!-- sa-app__toolbar -->
            <div class="sa-toolbar sa-toolbar--search-hidden sa-app__toolbar">
                <div class="sa-toolbar__body">
                    <div class="sa-toolbar__item">
                        <button class="sa-toolbar__button" type="button" aria-label="Menu" data-sa-toggle-sidebar="">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="sa-toolbar__item">
                        Hệ Thống Quản Lý : Trendy U
                    </div>
                    <div class="mx-auto"></div>

                    
                    <div class="dropdown sa-toolbar__item">
                    <!-- <button id="notificationButton" class="btn position-relative">
                        <i class="fa-solid fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">5</span>
                    </button>
                    <div id="notificationList" class="notification-list" style="display:none;">
                        <ul>
                            @foreach(Session::all() as $key => $message)
                                @if(strpos($key, 'order_notification_') === 0 || strpos($key, 'review_notification_') === 0)
                                    <li class="d-flex justify-content-between align-items-center p-2 border-bottom">
                                    <a href="{{ route('don-hang.show', ['don_hang' => str_replace('order_notification_', '', $key)]) }}" class="nav-link" data-key="{{ $key }}" style="color: black">
                                        {{ $message }}
                                    </a>
                                        <button type="button" class="btn-close" aria-label="Close" onclick="removeNotification('{{ $key }}')"></button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div> -->
                        
                        <button class="sa-toolbar-user" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" data-bs-offset="0,1" aria-expanded="false">
                            <span class="sa-toolbar-user__avatar sa-symbol sa-symbol--shape--rounded">
                                <img type="file" src="" width="64" height="64">
                            </span>
                            <span class="sa-toolbar-user__info">
                                @if (Auth::check())
                                <span class="sa-toolbar-user__title">
                                    {{Auth::user()->name}}
                                </span>
                                <span class="sa-toolbar-user__subtitle">
                                    {{Auth::user()->email}}
                                </span>
                                @else
                                    <span class="sa-toolbar-user__title">
                                        
                                    </span>
                                    <span class="sa-toolbar-user__subtitle">
                                        
                                    </span>
                                @endif
                            </span>
                        </button>
                        <ul id="btn_logout">
                            <li>
                                <a class="dropdown-item" href="/logout">Đăng Xuất</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
                <div class="sa-toolbar__shadow"></div>
            </div>
            <!-- sa-app__toolbar / end -->
<!-- Ẩn hiện nút đăng xuất -->
<script>
    
    
    document.getElementById('dropdownMenuButton').addEventListener('click', function() {
        var ulElement = document.getElementById('btn_logout');
        if (ulElement.style.display === 'none') {
            ulElement.style.display = 'block';
        } else {
            ulElement.style.display = 'none';
        }
    });
    // document.getElementById('notificationButton').addEventListener('click', function() {
    //     const notificationList = document.getElementById('notificationList');
    //     if (notificationList.style.display === 'none' || notificationList.style.display === '') {
    //         notificationList.style.display = 'block';
    //     } else {
    //         notificationList.style.display = 'none';
    //     }
    // });

    // // Đóng thông báo khi nhấp ra ngoài
    // document.addEventListener('click', function(event) {
    //     const notificationButton = document.getElementById('notificationButton');
    //     const notificationList = document.getElementById('notificationList');
    //     if (!notificationButton.contains(event.target) && !notificationList.contains(event.target)) {
    //         notificationList.style.display = 'none';
    //     }
    // });

    // //Hàm gửi request để xóa thông báo
    // // import axios from 'axios';
    // function removeNotification(notificationKey) {

    //     axios.post('/admin/remove-notification', {
    //         key: notificationKey}).then(response => {
    //             console.log('Notification removed');
    //             }).catch(error => {console.log(error);});
    // }
    // // Hàm để xóa thông báo khi người dùng click vào liên kết
    // document.querySelectorAll('.alert-link').forEach(link => {
    //     link.addEventListener('click', function () {
    //         const key = this.getAttribute('data-key');
    //         removeNotification(key);
    //         });
    //     });
</script>
