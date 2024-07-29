
<body>
    <!-- sa-app -->
    <div class="sa-app sa-app--desktop-sidebar-shown sa-app--mobile-sidebar-hidden sa-app--toolbar-fixed">
        <!-- sa-app__sidebar -->
        <div class="sa-app__sidebar">
            <div class="sa-sidebar">
                <div class="sa-sidebar__header">
                    <a class="sa-sidebar__logo" href="index.html">
                        <!-- logo -->
                        <div class="sa-sidebar-logo">
                            <span class="h5 mb-0 text-uppercase text-primary bg-dark px-2">NIKE</span>
                        </div>
                        <!-- logo / end -->
                    </a>
                </div>
                <div class="sa-sidebar__body" data-simplebar="">
                    <ul class="sa-nav sa-nav--sidebar" data-sa-collapse="">
                        <li class="sa-nav__section">
                            <ul class="sa-nav__menu sa-nav__menu--root">
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="admin.php" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-tachometer-alt"></i>
                                        </span>
                                        <span class="sa-nav__title">Dashboard</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('admin/san-pham')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-box"></i>
                                        </span>
                                        <span class="sa-nav__title">Product</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="{{url('/admin/danh-muc')}}" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-boxes"></i>
                                        </span>
                                        <span class="sa-nav__title">Category</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="admin.php?mod=account&act=account" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <span class="sa-nav__title">Account</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="/admin/order_admin/" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </span>
                                        <span class="sa-nav__title">Order</span>
                                    </a>
                                </li>
                                <li class="sa-nav__menu-item sa-nav__menu-item--has-icon">
                                    <a href="admin.php?mod=comment&act=comment" class="sa-nav__link">
                                        <span class="sa-nav__icon">
                                        <i class="fa-solid fa-comment" style="color: #ffffff;"></i>
                                        </span>
                                        <span class="sa-nav__title">Comment</span>
                                    </a>
                                </li>
                            </ul>
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
                        Administrative Management Systems
                    </div>
                    <div class="mx-auto"></div>

                    <div class="dropdown sa-toolbar__item">
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
</script>
