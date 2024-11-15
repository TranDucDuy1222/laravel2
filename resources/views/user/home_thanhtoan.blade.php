@extends('user.layout')

@section('title')
Đặt hàng - Trendy U
@endsection

@section('category')
@foreach ($loai as $category)
<li class="nav-item dropdown">
  <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
    href="{{ url('/category'. '/' . $category->slug) }}">
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

@section('content')
<div class="container">
@if(session()->has('error'))
        <div class="toast show align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    {!! session('error') !!}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="pb-5">
        <div class="section__intro mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__text-wrap">
                            <h1 class="section__heading u-c-secondary">THANH TOÁN</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-6 col-sm-12 mb-3">
                        <div class="card text-black p-0 ">
                            <div class="d-flex align-items-center p-2">
                                <i class="fa-solid fa-location-dot me-2 fs-4" style="color: #ee301b;"></i>
                                <p class="fs-4 mb-0">Địa chỉ nhận hàng</p> 
                                <a href="{{ route('user.profile', [Auth::user()->id]) }}" class="btn btn-outline-dark ms-auto" style="font-size: 15px;">Chỉnh sửa</a>
                            </div>
                            <hr class="m-0">
                            <select class="form-select" id="selected_address" aria-label="Default select example">
                                @foreach ($diachis as $dc)
                                    <option value="{{$dc->id}}"> 
                                        {{$dc->ho_ten}} {{ $dc->phone }} | {{ $dc->dc_chi_tiet }} , {{ $dc->qh }}, {{ $dc->thanh_pho }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <div class="scroll-container">
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
                                        
                                        @foreach($pays as $item)
                                            <tr>
                                                <td>
                                                    <div class="table-p__box">
                                                        <div class="table-p__img-wrap">
                                                            <img class="h-100 w-100" src="{{ asset('/uploads/product/'.$item->sanPham->hinh) }}" alt="{{ $item->sanPham->ten_sp }}">
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
                                                    <span class="table-p__price">
                                                        @if ($item->sanPham->gia_km > 0)
                                                            {{ number_format($item->sanPham->gia_km , 0, '','.') }} đ
                                                        @else
                                                            {{ number_format($item->sanPham->gia , 0, '','.') }} đ
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-p__input-counter-wrap">
                                                        <div class="input-counter">
                                                        <input class="input-counter__text input-counter--text-primary-style" type="number" name="quantity" value="{{ $item->so_luong }}" id="quantity-{{ $item->id }}" readonly>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td id="total-price-{{ $item->id }}" class="item-total-price">
                                                    <span class="table-p__price">
                                                        @if ($item->sanPham->gia_km > 0)
                                                            {{ number_format($item->sanPham->gia_km * $item->so_luong , 0, '','.') }} đ
                                                        @else
                                                            {{ number_format($item->sanPham->gia * $item->so_luong , 0, '','.') }} đ
                                                        @endif
                                                    </span>
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <form class="f-cart" action="{{ route('pay.applyVoucher') }}" method="post">
                            @csrf
                            <div class="f-cart__pad-box">
                                <div class="mb-3">
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
                                            <td id="grand-total">
                                                {{ number_format($pays->sum(function($item) {
                                                    if ($item->sanPham->gia_km >0 ){
                                                        return $item->sanPham->gia_km * $item->so_luong;
                                                    }else{
                                                    return $item->sanPham->gia * $item->so_luong;
                                                    }
                                                }), 0, '','.') }} đ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td id="shipping-cost"> </td>
                                        </tr>
                                        <tr>
                                            <td>Voucher giảm giá</td>
                                            <td id="discount-amount">- {{ number_format($discountAmount , 0, '','.' ?? 0) }} đ</td>
                                        </tr>

                                    </tbody>
                                    <tr>
                                        <td>TỔNG THANH TOÁN</td>
                                        <td id="total-payable">{{ number_format($totalPayable, 0, '', '.') }} đ</td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                        <form id="order_form" action="{{ route('dat-hang') }}" method="post">
                            @csrf
                            <!-- Thông tin muốn lấy -->
                            <input type="hidden" name="total_payables" id="total_payables_hidden" value="{{ $totalPayable }}">
                            <input type="hidden" name="discount_amount" id="discount-amount_hidden" value="{{ $discountAmount }}">
                            <input type="hidden" name="selected_address" id="hidden_selected_address">
                            <div class="border p-3">
                                    <div class="text-black mb-xl-2 ">
                                        <h3>Phương thức thanh toán</h3>
                                        <div class="card my-2">
                                            <div class="d-flex justify-content-start align-items-center p-xl-2">
                                                <div class="badge text-bg-success">COD</div>
                                                <p class="ms-2 align-self-center fs-6">Thanh toán khi nhận hàng</p>
                                                <input type="radio" name="payment_method" value="COD" class="ms-auto" checked>
                                            </div>
                                        </div>
                                        <div class="card my-2">
                                            <div class="d-flex justify-content-start align-items-center p-xl-2">
                                                <div class="badge text-bg-warning">VNPay</div>
                                                <p class="ms-2 align-self-center fs-6">Thanh toán ví điện tử</p>
                                                <input type="radio" name="payment_method" value="VNPay" class="ms-auto">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn--e-brand-b-2 w-100" type="submit">ĐẶT HÀNG</button>

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

<!-- code khác -->
<script>
    // Đảm bảo không có form nào khác bị submit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(event) {
            console.log('Form submitting: ' + form.id);  // Ghi nhật ký để theo dõi form nào đang được submit
        });
    });

    // Lấy id_dc vào form đặt hàng
    document.getElementById('order_form').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn submit mặc định
        
        var selectedAddress = document.getElementById('selected_address').value;
        document.getElementById('hidden_selected_address').value = selectedAddress;
        
        console.log('Submitting order_form with address: ' + selectedAddress);

        // Thực hiện submit form đặt hàng
        this.submit();
    });

    // Lấy địa chỉ để tính tổng tiền 
    document.addEventListener('DOMContentLoaded', function() {
        const addressSelect = document.getElementById('selected_address');
        const shippingCostField = document.getElementById('shipping-cost');
        const totalPayableField = document.getElementById('total-payable');
        const totalPayablesHidden = document.getElementById('total_payables_hidden');  // Hidden field for total payable

        const shipCostInnerCity = {{ $giavc->ship_cost_inner_city }};
        const shipCostNationwide = {{ $giavc->ship_cost_nationwide }};
        const totalAmount = {{ $totalAmount }};
        const discountAmount = {{ $discountAmount }};

        addressSelect.addEventListener('change', function() {
            const selectedOption = addressSelect.options[addressSelect.selectedIndex];
            const thanhPho = selectedOption.text.split(',').pop().trim();
            let shippingCost = 0;

            if (thanhPho === 'Hồ Chí Minh' || thanhPho === 'Thành phố Hồ Chí Minh') {
                shippingCost = shipCostInnerCity;
            } else {
                shippingCost = shipCostNationwide;
            }

            const totalPayable = totalAmount - discountAmount + shippingCost;
            shippingCostField.innerText = shippingCost.toLocaleString() + ' đ';
            totalPayableField.innerText = totalPayable.toLocaleString() + ' đ';
            totalPayablesHidden.value = totalPayable;  // Update the hidden field
        });

        // Trigger change event on page load to set initial values
        addressSelect.dispatchEvent(new Event('change'));
    });


// Tuỳ chỉnh số lượng sản phẩm
function changeQuantityPay(itemId, change) {
    const quantityInput = document.getElementById(`quantity-${itemId}`);
    const stockLimit = parseInt(document.getElementById(`stock-${itemId}`).value);
    let currentQuantity = parseInt(quantityInput.value);
    currentQuantity += change;

    if (currentQuantity < 1) {
        currentQuantity = 1;
    } 
    if (currentQuantity > stockLimit) {
        currentQuantity = stockLimit;
        alert("Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.");
    }

    quantityInput.value = currentQuantity;
    document.getElementById(`form-quantity-${itemId}`).submit();
}

// Xử lý giảm giá khi người dùng nhập
document.addEventListener('DOMContentLoaded', function() {
    const cartItems = document.querySelectorAll('.cart-product');
    cartItems.forEach(item => {
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




