@extends('user.layout')
@section('title')
Chi Tiết : {{$detail->ten_sp}}
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
                    <li class="hover-dm">
                        <a class="dropdown-item" href="{{ route('danh-muc-san-pham', $dm->slug)}}">{{$dm->ten_dm}}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    </li>
@endforeach
@endsection

@php
    if ($detail->gia_km > 0) {
        $gia_moi = $detail->gia_km;
        //   $giaold = '<del>' . $gia . '</del>';
    } else {
        $gia_moi = $detail->gia;
        $giaold = '';
    }
    $num = $gia_moi;
    $gia_chinh = number_format($num, 0, '', '.');
    $giaold = number_format($detail->gia, 0, '', '.');
@endphp

@section('content')
<div class="app-content pt-lg-4">
    <!-- Thông báo lấy mã giảm giá -->
        <div class="z-1 toast align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true" id="toast-vocher"> 
            <div class="d-flex"> 
                <div class="toast-body" id="toast-body"></div> 
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> 
            </div> 
        </div>
    <!-- end thông báo lấy mã giảm giá -->
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pd mb-4">
                        <div class="pd-wrap">
                            <div class="img-details">
                                <img src="{{ asset('/uploads/product/' . $detail->hinh) }}" class="h-100 w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="pd-detail ">
                        <div>
                            <span class="pd-detail__name">{{$detail->ten_sp}}</span>
                            <!-- <span class="section__span u-c-silver"></span> -->
                        </div>
                        <div>
                            <div class="pd-detail__inline">
                                @if ($detail->trang_thai === 2)
                                    <span style="font-size: 2rem;" class="text-black">Giá dự kiến </span>
                                    <span class="text-danger" style="font-size: 2rem;">
                                        {{$gia_chinh}} đ
                                    </span>
                                @else
                                    <span class="pd-detail__price">
                                        {{$gia_chinh}} đ
                                    </span>
                                @endif
                                <del class="pd-detail__del">{{$giaold}} đ</del>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="pd-detail__rating gl-rating-style"><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star-half-alt"></i>
                                <span class="pd-detail__review u-s-m-l-4">
                                    <a data-click-scroll="#view-review">{{$sldg}} Đánh giá</a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <span class="pd-detail__preview-desc">{{$detail->mo_ta_ngan}}</span>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <!-- Cột chứa Đã Bán -->
                                <div class="col-xl-6 col-lg-6 col-md-4 col-sm-4 col-12">
                                    <div class="pd-detail__inline">
                                        <span class="pd-detail__click-wrap">
                                            <i class="fa-solid fa-basket-shopping u-s-m-r-6"
                                                style="color: #ec3609;"></i>
                                            <a>Đã Bán</a>
                                            <span class="pd-detail__click-count">({{$detail->luot_mua ?? 0}})</span>
                                        </span>
                                    </div>
                                </div>
                                <!-- Cột chứa Thêm vào danh sách yêu thích -->
                                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                                    <div class="d-flex justify-content-md-end justify-content-xs-start">
                                        <!-- Căn phải với màn hình lớn, căn trái với màn hình nhỏ -->
                                        <div class="pd-detail__inline">
                                            <span class="pd-detail__click-wrap">
                                                <i class="far fa-heart u-s-m-r-6"></i>
                                                <a href="/">Thêm vào danh sách yêu thích</a>
                                                <span class="pd-detail__click-count">(222)</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <form class="pd-detail__form" action="{{ route('cart.add', ['id' => $detail->id]) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="d-flex">
                                        <span class="pd-detail__label mb-2">Size:</span>
                                        <div class="ms-auto pd-detail__inline">
                                            <span class="pd-detail__click-wrap">
                                                <a href="">Hướng dẫn lựa chọn size</a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="pd-detail__size">
                                        @if ($detail->trang_thai != 1)
                                            @foreach ($size as $ssl)
                                                @if ($ssl->so_luong > 0 )
                                                    <div class="size__radio">
                                                        <input type="radio" id="size-{{ $loop->index }}" name="size"
                                                            value="{{ $ssl->size_product }}" data-size="{{ $ssl->so_luong }}">
                                                        <label class="size__radio-label"
                                                            for="size-{{ $loop->index }}">{{ $ssl->size_product }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="error-message" style="color: red; display: none;">Vui lòng chọn size trước khi thêm vào giỏ hàng.</div>
                                </div>
                                <div class="pd-detail-inline-2">
                                    <div class="mb-3">
                                        <span class="pd-detail__label mb-2" for="quantity">Số lượng:</span>
                                    </div>
                                    <div class="mb-3 ms-4">
                                        <div class="input-counter">
                                            <input class="input-counter__text input-counter--text-primary-style"
                                                type="number" name="soluong" id="quantity" class="form-control" min="1"
                                                value="1" required>
                                        </div>
                                        <div id="error-message-sl"></div>
                                    </div>
                                </div>
                                @if(session('error'))
                                    <div class="pd-detail__inline">
                                        <span class="pd-detail__click-wrap">
                                            <a class="text-danger">{{ session('error') }}</a>
                                        </span>
                                    </div>
                                @endif
                                <hr>
                                <div class="d-flex justify-content-center align-content-center ">
                                    <div class="my-3">
                                        @if ($detail->trang_thai === 2)
                                            <a href="{{ route('user.contact') }}" class="btn-link text-black">
                                                Liên hệ với chúng tôi để đặt hàng
                                            </a>
                                        @elseif ($detail->trang_thai === 1 )
                                            <button class="btn btn-dark " type="button">Sản phẩm ngừng kinh doanh</button>
                                        @else
                                            <button class="btn btn--e-brand-b-2" type="submit">Thêm vào giỏ hàng</button>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour"
                                                aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                                                <strong>Giao hàng và trả hàng miễn phí</strong>
                                            </button>
                                        </h2>
                                        <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse p-2">
                                            Giao hàng và trả lại miễn phí<br>
                                            Đơn hàng từ 5.000.000₫ trở lên của bạn sẽ được giao hàng tiêu chuẩn miễn
                                            phí.<br>
                                            <li>Giao hàng tiêu chuẩn 4-5 ngày làm việc</li>
                                            <li>Chuyển phát nhanh 2-4 ngày làm việc</li>
                                            Đơn hàng được xử lý và giao từ Thứ Hai đến Thứ Sáu (trừ ngày lễ)<br>
                                            Thành viên Nike được hưởng lợi nhuận miễn phí
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br/>
                            <!-- Mã giảm giá -->
                            @if (!$ma_giam_gia->isEmpty()) 
                                <div id="discountCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5600" > 
                                    <div class="carousel-indicators chuyen"> 
                                        @foreach ($ma_giam_gia as $index => $item) 
                                            <button type="button" data-bs-target="#discountCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : '' }}" aria-label="Slide {{ $index + 1 }}"></button> 
                                        @endforeach
                                    </div>
                                    <div class="carousel-inner"> 
                                        @foreach ($ma_giam_gia as $index => $item) 
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}"> 
                                                <div class="container"> 
                                                    <div class="sharp-corners p-1"> 
                                                        <div class="d-flex justify-content-center align-content-center mb-1" > 
                                                            <u>
                                                                <p id="copy{{ $index }}">{{ $item->code }} </p> 
                                                            </u>
                                                            <p class="ms-md-2 text-truncate" style="width: 220px;"> {{ $item->mo_ta }}</p> 
                                                        </div> 
                                                        <div class="d-flex justify-content-center">
                                                            <button style="font-size: 14px;" class="btn btn-outline-light p-1 m-0" onclick="copyText({{ $index }})">Lấy mã</button> 
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div> 
                                        @endforeach 
                                    </div> 
                                    <a class="carousel-control-prev black-icons position-absolute" href="#discountCarousel" role="button" data-bs-slide="prev"> 
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span> 
                                    </a> 
                                    <a class="carousel-control-next black-icons position-absolute" href="#discountCarousel" role="button" data-bs-slide="next"> 
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span> 
                                        <span class="sr-only">Next</span> 
                                    </a> 
                                </div>

                            @endif
                            <!-- End mã giảm giá -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pd-tab">
                        <div class="mb-4">
                            <ul class="pd-tab__list nav mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true">MÔ TẢ</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">ĐÁNH GIÁ</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                <div class="pd-tab__desc">
                                    <div class="mb-3 text-black">
                                        {!! $detail->mo_ta_ct !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                aria-labelledby="pills-profile-tab" tabindex="0">
                                <div class="pd-tab__rev">
                                    <div class="mb-4 text-black">
                                        <form class="pd-tab__rev-f1">
                                            <div class="rev-f1__group">
                                                <div class="mb-2">
                                                    <h2>{{$sldg}} Đánh giá</h2>
                                                </div>
                                            </div>
                                            <!-- đánh giá -->
                                            @foreach ($comment as $item)
                                                <div class="row">
                                                    <div class="col-xl-3 col-12">
                                                        <div class="review-o__info mb-2">
                                                            <span class="review-o__name">{{$item->name}} </span>
                                                            <span class="review-o__date">{{$item->thoi_diem}}</span>
                                                        </div>
                                                        <div class="review-o__rating gl-rating-style mb-2">
                                                            @if ($item->quality_product == 5)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @elseif($item->quality_product == 4)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @elseif($item->quality_product == 3)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @elseif($item->quality_product == 2)
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @else
                                                                <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                                            @endif
                                                        </div>
                                                        <p>Phân Loại : {{$item->ten_sp}} </p>
                                                        <p>Size: {{$item->size_product ?? 'Null'}} - Màu: {{$item->color}}
                                                        </p>
                                                        <p><strong>Chất lượng sản phẩm:</strong>
                                                        </p>
                                                        <p class="review-o__text">{{$item->noi_dung}}.</p>
                                                        @if (!empty($item->feedback))
                                                            <p class="ms-2"><strong>Phản Hồi từ người bán :</strong> <br>
                                                                {{$item->feedback}}.</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-8 col-12">
                                                        <img src="{{ asset('/uploads/review/' . $item->hinh_dg) }}"
                                                            class="img-circle" height="220px" alt="Ảnh từ người mua">
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-5">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary mb-2 underline-animations">BẠN CÓ THỂ THÍCH</h1>
                            <span class="section__span u-c-silver"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row">
                    @foreach ($relatedpro as $item)
                        @php 
                            $gianew = $item->gia_km > 0 ? $item->gia_km : $item->gia;
                            $gia = number_format($gianew, 0, '', '.'); 
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-5">
                            <div class="product-short">
                                <div class="product-short__container">
                                    <div class="card">
                                        @if ($item->trang_thai_san_pham != 2 )
                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="d-flex justify-content-center align-content-center">
                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}" class="img-fluid" style="max-height: 295px;"
                                                    alt="" class="w-100">
                                                @if ($item->gia_km > 0)
                                                    <img src="{{ asset('/uploads/logo/sale.png') }}" style="" alt=""
                                                        class="img-sale">
                                                @endif
                                            </a>
                                        @elseif ($item->trang_thai_san_pham == 2)
                                            <a href="/detail/{{$item->id}}" id="hover-img-home" class="image-container d-flex justify-content-center align-content-center">
                                                <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                    style="max-height: 295px;" alt="" class="img-fluid">
                                                <img src="{{ asset('/uploads/logo/') }}"
                                                    onerror="this.src='{{ asset('/uploads/logo/logocs1.png') }}'"
                                                    class="overlay-image" alt="">
                                            </a>
                                        @endif
                                        <div class="card-body text-center">
                                            <a href="">
                                                <h5 id="hover-sp" class="text-truncate">{{$item->ten_sp}}</h5>
                                            </a>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-sm-7 col-12 text-start">
                                                            <div class="d-flex align-items-center">
                                                                <strong id="color-gia">{{ $gia }}đ</strong>
                                                                @if ($item->gia_km >= 1)
                                                                    @php 
                                                                        $discountPercentage = (($item->gia - $item->gia_km) / $item->gia) * 100; 
                                                                    @endphp 
                                                                    @if ($discountPercentage > 1)
                                                                        <div class="bg-text-success text-danger ms-2"
                                                                            style="font-size: 10px;">
                                                                            -{{ number_format($discountPercentage, 0) }}%
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5 col-12 text-start text-sm-end">
                                                            <i class="fa-solid fa-basket-shopping u-s-m-r-6"
                                                                style="color: #ec3609;"></i>
                                                            <span class="pd-detail__click-count">Đã Bán
                                                                ({{$item->luot_mua ?? 0}})</span>
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
<script>
    // Tuỳ chỉnh ảnh cao bằng cột nội dung
    document.addEventListener("DOMContentLoaded", function() {
        function adjustImageHeight() {
            const imgContainer = document.querySelector('.img-details');
            const content = document.querySelector('.pd-detail');

            if (imgContainer && content) {
                const contentHeight = content.clientHeight;
                if (window.innerWidth >= 1000) { // Điều kiện cho col-md trở lên
                    imgContainer.style.height = `${contentHeight}px`;
                } else {
                    imgContainer.style.height = 'auto'; // Đặt lại chiều cao khi dưới col-md
                }
            }
        }

        // Gọi hàm điều chỉnh ngay khi trang được tải
        adjustImageHeight();

        // Gọi hàm điều chỉnh khi cửa sổ thay đổi kích thước
        window.addEventListener('resize', adjustImageHeight);
    });
    // copy mã giảm giá 
    document.addEventListener('DOMContentLoaded', function () { 
        window.copyText = function (index) { 
            var copyText = document.getElementById("copy" + index); 
            navigator.clipboard.writeText(copyText.textContent).then(function () { 
                var toastContainer = document.getElementById("toast-vocher"); 
                var toastBody = document.getElementById("toast-body"); 
                toastBody.textContent = "Đã lấy mã giảm giá thành công: " + copyText.textContent; 
                toastContainer.classList.remove("d-none"); 
                toastContainer.classList.add("show"); setTimeout(function () { 
                    toastContainer.classList.remove("show"); 
                    toastContainer.classList.add("d-none"); 
                }, 4000); }, 
                function (err) { 
                    console.error('Lỗi sao chép: ', err); 
                }); 
            } 
        }
    );

    document.addEventListener('DOMContentLoaded', function () {
        let selectedSize = null;
        let hangTrongKho = 0;
        let currentCustomerId = @json($currentCustomerId);
        let cart = @json($cart);

        const sizeRadios = document.querySelectorAll('input[name="size"]');
        const quantityInput = document.getElementById('quantity');
        const errorMsg = document.getElementById('error-message-sl');

        sizeRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                selectedSize = this.value;
                if (this.getAttribute('data-size') > 10) {
                    hangTrongKho = Math.floor(parseFloat(this.getAttribute('data-size')) / 2);
                } else {
                    hangTrongKho = this.getAttribute('data-size');
                }


                var soluong = parseInt(quantityInput.value);
                if (soluong > hangTrongKho) {
                    quantityInput.value = hangTrongKho;
                    errorMsg.style.display = 'block';
                    errorMsg.innerText = 'Số lượng tối đa bạn có thể đặt cho sản phẩm này :' + hangTrongKho;
                } else {
                    errorMsg.style.display = 'none';
                }

                document.getElementById('error-message').style.display = 'none';
            });
        });

        const addToCartButton = document.querySelector('.btn--e-brand-b-2');
        addToCartButton.addEventListener('click', function (event) {
            if (!selectedSize) {
                event.preventDefault();
                document.getElementById('error-message').style.display = 'block';
                return;
            }

            // Kiểm tra số lượng trong giỏ hàng
            let quantityToAdd = parseInt(quantityInput.value);
            let currentQuantityInCart = cart[selectedSize] ? cart[selectedSize].quantity : 0;

            if (currentQuantityInCart + quantityToAdd > hangTrongKho) {
                event.preventDefault();
                errorMsg.style.display = 'block';
                return;
            }

            if (currentQuantityInCart >= hangTrongKho) {
                event.preventDefault();
                alert('Bạn đã đạt giới hạn số lượng cho size này trong giỏ hàng.');
                return;
            }
            cart[selectedSize] = {
                quantity: (currentQuantityInCart || 0) + quantityToAdd,
                size: selectedSize
            };
            console.log('Thêm vào giỏ hàng với size:', selectedSize, 'và số lượng:', cart[selectedSize].quantity);

            updateCartUI();
        });

        quantityInput.addEventListener('input', function () {
            var soluong = parseInt(this.value);

            // Kiểm tra điều kiện số lượng
            if (isNaN(soluong) || soluong <= 0) {
                this.value = 1; // Nếu nhập số lượng không hợp lệ, đặt về 1
                errorMsg.style.display = 'none';
            } else if (soluong > hangTrongKho) {
                this.value = hangTrongKho; // Nếu số lượng vượt quá hàng trong kho, đặt về số lượng tối đa
                errorMsg.style.display = 'block'; // Hiển thị thông báo
            } else {
                errorMsg.style.display = 'none'; // Ẩn thông báo khi số lượng hợp lệ
            }
        });

        function updateCartUI() {
            // Cập nhật UI giỏ hàng nếu cần thiết
            console.log('Giỏ hàng hiện tại:', cart);
        }
    });
</script>

@endsection