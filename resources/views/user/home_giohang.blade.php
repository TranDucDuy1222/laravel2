@extends('user.layout')

@section('title')
 Giỏ Hàng - Nike
@endsection

@section('content')
<div class="app-content">
    <div class="pt-5">
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">
                                <a href="">Trang chủ</a>
                            </li>
                            <li class="is-marked">
                                <a href="{{ route('cart.gio-hang') }}">Giỏ hàng</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="pb-5">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">GIỎ HÀNG</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-12 mb-3">
                        <div class="table-responsive">
                            <table class="table-p">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;">
                                            <span class="table-p__name"><a>Sản phẩm</a></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="table-p__name"><a>Giá</a></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="table-p__name"><a>Số lượng</a></span>
                                        </td>
                                        <td style="text-align: center;">
                                            <span class="table-p__name"><a>Tổng</a></span>
                                        </td>
                                    </tr>
                                    @foreach($gioHangs as $item)
                                        <tr>
                                            <td>
                                                <div class="table-p__box">
                                                    <div class="table-p__img-wrap">
                                                        <img class="u-img-fluid" src="{{ asset('/uploads/product/'.$item->sanPham->hinh) }}" alt="{{ $item->sanPham->ten_sp }}">
                                                    </div>
                                                    <div class="table-p__info">
                                                        <span class="table-p__name">
                                                            <a href="{{ route('product.detail', $item->sanPham->id) }}">{{ $item->sanPham->ten_sp }}</a>
                                                        </span>
                                                        <span class="table-p__category">
                                                            <a href="">{{ $item->sanPham->danhMuc ? $item->sanPham->danhMuc->ten_dm : 'Không xác định' }}</a>
                                                        </span>
                                                        <ul class="table-p__variant-list">
                                                            <li>
                                                                <span>Size: {{ $item->size->size_product }}</span>
                                                            </li>
                                                            <li>
                                                                <span>Màu: {{ $item->sanPham->color }}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="table-p__price">{{ number_format($item->sanPham->gia) }} VNĐ</span>
                                            </td>
                                            <td>
                                                <div class="table-p__input-counter-wrap">
                                                    <div class="input-counter">
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" id="form-quantity-{{ $item->id }}">
                                                            @csrf
                                                            <span class="input-counter__minus fas fa-minus" onclick="changeQuantity({{ $item->id }}, -1)"></span>
                                                            
                                                            <input class="input-counter__text input-counter--text-primary-style" type="number" 
                                                                name="quantity" value="{{ $item->so_luong }}" 
                                                                id="quantity-{{ $item->id }}" min="1" 
                                                                onchange="document.getElementById('form-quantity-{{ $item->id }}').submit();">

                                                            <input type="hidden" id="stock-{{ $item->id }}" value="{{ $item->size->so_luong }}">

                                                            <span class="input-counter__plus fas fa-plus" onclick="changeQuantity({{ $item->id }}, 1)"></span>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>

                                            <td id="total-price-{{ $item->id }}" class="item-total-price">
                                                <span class="table-p__price">{{ number_format($item->sanPham->gia * $item->so_luong) }} VNĐ</span>
                                            </td>
                                            <td>
                                                <div class="table-p__del-wrap">
                                                    <form action="{{ route('cart.remove', $item->id_sp) }}" method="GET" style="display:inline;">
                                                        <a class="far fa-trash-alt table-p__delete-link" href="#" onclick="event.preventDefault(); this.closest('form').submit(); return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');"></a>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-3">
                        <form class="f-cart" action="{{ route('cart.applyVoucher') }}" method="POST">
                            @csrf
                            <div class="f-cart__pad-box">
                                <div class="mb-3">
                                    <!-- <div class="newsletter__group mb-4">
                                        @if($availableVouchers->count() > 0)
                                            <select class="form-select input-text input-text--primary-style" name="voucher" id="voucher-select" aria-label="Default select example">
                                                <option value="">Chọn mã giảm giá</option>
                                                @foreach($availableVouchers as $voucher)
                                                <option value="{{ $voucher->code }}">{{ $voucher->code }} - {{ $voucher->phan_tram }}% ({{ $voucher->mo_ta ?? 'Không có mô tả' }})</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div> -->
                                    <div class="newsletter__group mb-4">
                                        <input class="input-text input-text--primary-style" type="text" placeholder="Nhập mã giảm giá" name="voucher">
                                        <button class="btn voucher__btn" type="submit">Áp dụng</button>
                                    </div>
                                    @if(session('voucher'))
                                        <div class="route-box row">
                                            <div class="route-box__g2 col-lg-6">
                                                <a class="route-box__link" href="">
                                                    Mã giảm giá: {{ session('voucher.code') }} đã được áp dụng với mức giảm: {{ session('voucher.amount') }}%.
                                                </a>
                                            </div>
                                            <div class="route-box__g1 col-lg-6">
                                                <a class="route-box__link" href="javascript:void(0);" onclick="removeVoucher()">
                                                    <i class="fas fa-trash"></i>
                                                    <span>Hủy mã giảm giá</span>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if ($errors->any())
                                    <div class="pd-detail__inline">
                                        <span class="pd-detail__click-wrap">
                                            @foreach ($errors->all() as $error)
                                                <a class="text-danger">{{ $error }}</a>
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="pd-detail__inline">
                                        <span class="pd-detail__click-wrap">
                                            <a class="text-success">{{ session('success') }}</a>
                                        </span>
                                    </div>
                                @endif
                                <table class="f-cart__table">
                                    <tbody>
                                        <tr>
                                            <td>Tổng tiền sản phẩm</td>
                                            <td id="grand-total">{{ number_format($gioHangs->sum(function($item) {
                                                return $item->sanPham->gia * $item->so_luong;
                                            })) }} VNĐ</td>
                                        </tr>
                                        <tr>
                                            <td>Voucher giảm giá</td>
                                            <td id="discount-amount">{{ number_format($discountAmount ?? 0) }} VNĐ</td>
                                        </tr>
                                    </tbody>
                                    
                                    <tr>
                                            <td>TỔNG THANH TOÁN</td>
                                            <td id="total-payable">{{ number_format($totalPayable ?? $gioHangs->sum(function($item) {
                                                return $item->sanPham->gia * $item->so_luong;
                                            })) }} VNĐ</td>
                                        </tr>
                                </table>
                                <div>
                                    <button class="btn btn--e-brand-b-2"><a class="nav-link" href="{{route('thanhtoan')}}">THANH TOÁN</a></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <div class="route-box">
                            <div class="route-box__g1">
                                <a class="route-box__link" href="">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>Tiếp tục mua sắm</span>
                                </a>
                            </div>
                            <div class="route-box__g2">
                                <a class="route-box__link" href=""><i class="fas fa-trash"></i>
                                    <span>Xóa</span>
                                </a>
                                <a class="route-box__link" href=""><i class="fas fa-sync"></i>
                                    <span>Cập nhật</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeQuantity(itemId, change) {
    const quantityInput = document.getElementById(`quantity-${itemId}`);
    const stockLimit = parseInt(document.getElementById(`stock-${itemId}`).value);
    console.log(`stock-${itemId}:`, document.getElementById(`stock-${itemId}`).value);

    let currentQuantity = parseInt(quantityInput.value);

    currentQuantity += change;
    if (currentQuantity < 1) {
        currentQuantity = 1;
    }

    if (currentQuantity > stockLimit) {
        currentQuantity = stockLimit;
        alert("Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.");
    } else {
        quantityInput.value = currentQuantity;
        document.getElementById(`form-quantity-${itemId}`).submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.querySelectorAll('.cart-product');

    cartItems.forEach(item => {
        const productId = item.getAttribute('data-id');
        const size = item.getAttribute('data-size');
        const quantityInput = item.querySelector('.product-quantity');
        const stockQuantity = parseInt(item.querySelector('.stock-quantity').getAttribute('data-stock'));
        let currentQuantity = parseInt(quantityInput.value);

        // Nếu số lượng trong giỏ lớn hơn số lượng trong kho
        if (currentQuantity > stockQuantity) {
            quantityInput.value = stockQuantity;
            alert(`Số lượng sản phẩm đã điều chỉnh về ${stockQuantity} do vượt quá hàng trong kho.`);
        }
    });
});

</script>
@endsection
