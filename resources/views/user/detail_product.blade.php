@extends('user.layout')
@section('title')
Chi Tiết : {{$detail->ten_sp}}
@endsection

@section('category')
@foreach ($loai as $category)
    <li class="nav-item dropdown">
        <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
            href="{{ url('/category/' . $category->slug) }}">
            {{$category->ten_loai}}
        </a>
        <ul class="dropdown-menu" id="userDropdown">
            @foreach ($danh_muc as $dm)
                @if ($dm->id_loai == $category->id)
                    <li class="hover-dm"><a class="dropdown-item" href="{{$dm->slug}}">{{$dm->ten_dm}}</a></li>
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
<div class="app-content">
    <div class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="pd mb-4">
                        <div class="pd-wrap">
                            <div id="pd-o-initiate">
                                <div class="pd-o-img-wrap">
                                    <img src="{{ asset('/uploads/product/' . $detail->hinh) }}"
                                         class="img-fluid"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pd-detail">
                        <div>
                            <span class="pd-detail__name">{{$detail->ten_sp}}</span>
                            <!-- <span class="section__span u-c-silver"></span> -->
                        </div>
                        <div>
                            <div class="pd-detail__inline">
                                <span class="pd-detail__price">{{$gia_chinh}} VND</span>
                                <del class="pd-detail__del">{{$giaold}} VND</del>
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
                                            <i class="fa-solid fa-basket-shopping u-s-m-r-6" style="color: #ec3609;"></i>
                                            <a >Đã Bán</a>
                                            <span class="pd-detail__click-count">({{$detail->luot_mua ?? 0}})</span>
                                        </span>
                                    </div>
                                </div>
                                <!-- Cột chứa Thêm vào danh sách yêu thích -->
                                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-8 col-12">
                                    <div class="d-flex justify-content-md-end justify-content-xs-start"> <!-- Căn phải với màn hình lớn, căn trái với màn hình nhỏ -->
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
                            <form class="pd-detail__form" action="{{ route('cart.add', ['id' => $detail->id]) }}"
                                method="POST">
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
                                        @foreach ($size as $ssl)
                                            @if ($ssl->so_luong > 0)
                                                <div class="size__radio">
                                                    <input type="radio" id="size-{{ $loop->index }}" name="size"
                                                        value="{{ $ssl->size_product }}" data-size="{{ $ssl->so_luong }}">
                                                    <label class="size__radio-label"
                                                        for="size-{{ $loop->index }}">{{ $ssl->size_product }}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                        <div id="error-message" style="color: red; display: none;">Vui lòng chọn size trước khi thêm vào giỏ hàng.</div>
                                    </div>
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
                                <div class="row">
                                    <div class="my-3 col-lg-6">
                                        <button class="btn btn--e-brand-b-2" type="submit">Thêm vào giỏ hàng</button>
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
                                                    <div class="col-xl-5">
                                                        <div class="review-o__info mb-2">
                                                            <span class="review-o__name">{{$item->name}} </span>
                                                            <span class="review-o__date">{{$item->thoi_diem}}</span>
                                                        </div>
                                                        <div class="review-o__rating gl-rating-style mb-2">
                                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                                class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                                class="far fa-star"></i>
                                                            <span>(4)</span>
                                                        </div>
                                                        <p>Phân Loại : {{$item->ten_sp}} </p>
                                                        <p>Size: {{$item->id_size}} - Màu: {{$item->color}}</p>
                                                        <p><strong>Chất lượng sản phẩm:</strong> {{$item->quality_product}}
                                                        </p>
                                                        <p class="review-o__text">{{$item->noi_dung}}.</p>
                                                        @if (!empty($item->feedback))
                                                            <p class="ms-2"><strong>Phản Hồi từ người bán :</strong> <br>
                                                                {{$item->feedback}}.</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-xl-7">
                                                        <img src="/img/{{$item->hinh_dg}}" alt="Ảnh từ người mua"
                                                            class="col-xl-3">
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
                            <h1 class="section__heading u-c-secondary mb-2">BẠN CÓ THỂ THÍCH</h1>
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
                            if ($item->gia_km > 0) {
                                $gia_moi = $item->gia_km;
                                //   $giaold = '<del>' . $gia . '</del>';
                            } else {
                                $gia_moi = $item->gia;
                            }
                            $num = $gia_moi;
                            $gia_chinh = number_format($num, 0, '', '.');
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-5">
                            <div class="product-short">
                                <div class="product-short__container">
                                    <div class="card">
                                        <a href="/detail/{{$item->id}}" id="hover-img-home">
                                            <img src="{{ asset('/uploads/product/' . $item->hinh) }}"
                                                
                                                style="max-height: 295px;" alt="" class="w-100">
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
                                                    <strong id="color-gia"> {{number_format($item->gia_km, 0, '', '.')}}đ </strong>
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
                hangTrongKho = parseInt(this.getAttribute('data-size'));

                var soluong = parseInt(quantityInput.value);
                if (soluong > hangTrongKho) {
                    quantityInput.value = hangTrongKho;
                    errorMsg.style.display = 'block';
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

        / Kiểm tra số lượng trong giỏ hàng
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