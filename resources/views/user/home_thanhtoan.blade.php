@extends('user.layout')
@section('title')
Đặt hàng - Trendy U
@endsection

@section('category')
@foreach ($loai as $category)
    <li class="nav-item dropdown">
        <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
            href="{{ url('/category' . '/' . $category->slug) }}">
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
                                @if ($diachis->isEmpty())
                                    <a href="{{ route('user.profile', [Auth::user()->id]) }}"
                                        class="btn btn-outline-dark ms-auto" style="font-size: 15px;"> Thêm địa chỉ </a>
                                @else
                                    <a href="{{ route('user.profile', [Auth::user()->id]) }}"
                                        class="btn btn-outline-dark ms-auto" style="font-size: 15px;"> Chỉnh sửa </a>
                                @endif
                            </div>
                            <hr class="m-0">
                            <select class="form-select" id="selected_address" aria-label="Default select example">
                                @foreach ($diachis as $dc)
                                    <option value="{{$dc->id}}">
                                        {{$dc->ho_ten}} {{ $dc->phone }} | {{ $dc->dc_chi_tiet }} , {{ $dc->qh }},
                                        {{ $dc->thanh_pho }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="table-responsive">
                            <div class="scroll-container">
                                <div class="table-p row border-top border-bottom">
                                    <div class="col-12 d-none d-sm-block bg-light">
                                        <div class="tr row py-3">
                                            <div class="col-6">
                                                <span class="table-p__name text-center"><a>Sản phẩm</a></span>
                                            </div>
                                            <div class="col-2">
                                                <span class="table-p__name text-center"><a>Giá</a></span>
                                            </div>
                                            <div class="col-2">
                                                <span class="table-p__name text-center"><a>Số lượng</a></span>
                                            </div>
                                            <div class="col-2">
                                                <span class="table-p__name text-center"><a>Tổng</a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        @foreach($pays as $item)
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="row py-4 d-flex align-items-stretch">
                                                    <div class="col-3 custom-img-wrap">
                                                        <img class=""
                                                            src="{{ asset('/uploads/product/' . $item->sanPham->hinh) }}"
                                                            alt="{{ $item->sanPham->ten_sp }}">
                                                    </div>
                                                    <div class="table-p__info col-9">
                                                        <span class="table-p__name">
                                                            <a
                                                                href="{{ route('product.detail', $item->sanPham->id) }}">{{ $item->sanPham->ten_sp }}</a>
                                                        </span>
                                                        <span class="table-p__category">
                                                            <a
                                                                href="">{{ $item->sanPham->danhMuc ? $item->sanPham->danhMuc->ten_dm : 'Không xác định' }}</a>
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
                                            </div>
                                            <div class="col-lg-6 col-sm-12">
                                                <div class="col-12 d-block d-sm-none">
                                                    <div class="tr row py-3">
                                                        <div class="col-4">
                                                            <span class="table-p__name text-center"><a>Giá</a></span>
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="table-p__name text-center"><a>Số lượng</a></span>
                                                        </div>
                                                        <div class="col-4">
                                                            <span class="table-p__name text-center"><a>Tổng</a></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-4 d-flex align-items-center">
                                                    <div class="col-4 text-center">
                                                        <span class="table-p__price">
                                                            @if ($item->sanPham->gia_km > 0)
                                                                {{ number_format($item->sanPham->gia_km, 0, '', '.') }} đ
                                                            @else
                                                                {{ number_format($item->sanPham->gia, 0, '', '.') }} đ
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="table-p__input-counter-wrap">
                                                            <div class="input-counter d-flex align-items-center justify-content-center">
                                                                <input
                                                                    class="input-counter__text input-counter--text-primary-style"
                                                                    type="number" name="quantity" value="{{ $item->so_luong }}"
                                                                    id="quantity-{{ $item->id }}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="total-price-{{ $item->id }}" class="item-total-price col-4 text-center">
                                                        <span class="table-p__price">
                                                            @if ($item->sanPham->gia_km > 0)
                                                                {{ number_format($item->sanPham->gia_km * $item->so_luong, 0, '', '.') }}
                                                                đ
                                                            @else
                                                                {{ number_format($item->sanPham->gia * $item->so_luong, 0, '', '.') }}
                                                                đ
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        @endforeach
                                    </div>
                                </div>
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
                                                    Mã giảm giá: <u>{{ session('voucher.code') }}</u> đã được áp dụng với mức giảm:
                                                    {{ session('voucher.amount') }}%.
                                                </a>
                                            </div>
                                            <div class="route-box__g1 col-lg-6">
                                                <a class="route-box__link" href="javascript:void(0);"
                                                    onclick="removeVoucher()">
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
                                                {{ number_format($pays->sum(function ($item) {
                                                    if ($item->sanPham->gia_km > 0) {
                                                        return $item->sanPham->gia_km * $item->so_luong;
                                                    } else {
                                                        return $item->sanPham->gia * $item->so_luong;
                                                    }
                                                }), 0, '', '.') }} đ
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Phí vận chuyển</td>
                                            <td id="shipping-cost"> </td>
                                        </tr>
                                        <tr>
                                            <td>Voucher giảm giá</td>
                                            <td id="discount-amount">-
                                                {{ number_format($discountAmount, 0, '', '.' ?? 0) }} đ
                                            </td>
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
                            <input type="hidden" name="total_payables" id="total_payables_hidden" value="{{ $totalPayable }}"> 
                            <input type="hidden" name="discount_amount" id="discount-amount_hidden" value="{{ $discountAmount }}"> 
                            <input type="hidden" name="selected_address" id="hidden_selected_address"> 
                            <input type="hidden" name="payment_method" value="COD" id="payment_method"> 

                            <h3>Phương thức thanh toán</h3>
                                    <div class="card my-2">
                                        <div class="d-flex justify-content-start align-items-center p-2 payment-options" data-payment="COD">
                                            <div class="badge text-bg-success">COD</div>
                                            <p class="ms-2 align-self-center fs-6">Thanh toán khi nhận hàng</p>
                                            <input type="radio" id="payment_cod" name="payment_option" value="COD"
                                                class="ms-auto" checked>
                                        </div>
                                    </div>
                                    <div class="card my-2">
                                        <div class="d-flex justify-content-start align-items-center p-xl-2 payment-options" data-payment="VNPay">
                                            <img src="{{ asset('/uploads/logo/logo-vnpay.png') }}" class="img-vnpay" alt="">
                                            <p class="ms-2 align-self-center fs-6">Thanh toán ví điện tử</p>
                                            <input type="radio" id="payment_vnpay" name="payment_option" value="VNPay"
                                                class="ms-auto">
                                        </div>
                                    </div>

                            <div class="d-flex justify-content-center"> 
                                @if ($diachis->isEmpty())
                                    <a href="{{ route('user.profile', [Auth::user()->id]) }}" id="add-address-link" 
                                    class="btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" 
                                    style="display: none;">Vui lòng thêm địa chỉ để đặt hàng</a>
                                @else
                                    <button class="btn btn--e-brand-b-2 w-100" id="place-order-button" type="submit">ĐẶT HÀNG</button> 
                                    <button class="btn btn--e-brand-b-2 w-100" id="pay-vnpay-button"
                                        style="display: none;" type="submit">THANH TOÁN VÍ ĐIỆN TỬ
                                    </button>
                                @endif
                                
                            </div> 
                        </form>
                    </div>
                    <div class="col-lg-12">
                        <div class="route-box">
                            <div class="route-box__g1">
                                <a class="route-box__link" href="{{url('/loai-san-pham/tat-ca-san-pham')}}">
                                    <i class="fas fa-long-arrow-alt-left"></i>
                                    <span>Tiếp tục mua sắm</span>
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
function removeVoucher() {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = "{{ route('pay.removeVoucher') }}";
    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = "{{ csrf_token() }}";
    form.appendChild(csrf);
    document.body.appendChild(form);
    form.submit();
    document.body.removeChild(form);
}

// Đảm bảo payment_method có giá trị theo radio đã chọn 
document.addEventListener('DOMContentLoaded', function() { 
    const paymentMethodInputs = document.querySelectorAll('#payment_method'); 
    const paymentOptions = document.getElementsByName('payment_option'); 
    paymentOptions.forEach(option => { 
        option.addEventListener('change', function() { 
            paymentMethodInputs.forEach(input => { input.value = this.value; }); 
            console.log('Selected payment method: ' + this.value); }); 
        }); 
        // Đặt giá trị ban đầu cho payment_method 
        const initialPaymentValue = document.querySelector('input[name="payment_option"]:checked').value; 
        paymentMethodInputs.forEach(input => { 
            input.value = initialPaymentValue; 
        }); 
});

$(document).ready(function () {
    // Hàm để cập nhật trạng thái của các nút dựa trên radio button được chọn
    function updateButtons() {
        var selectedValue = $('input[name="payment_option"]:checked').val();
        $('#payment_method').val(selectedValue);

        // Hiển thị nút phù hợp với phương thức thanh toán được chọn
        if (selectedValue === 'COD') {
            $('#place-order-button').show();
            $('#pay-vnpay-button').hide();
        } else if (selectedValue === 'VNPay') {
            $('#place-order-button').hide();
            $('#pay-vnpay-button').show();
        }
    }

    // Đăng ký sự kiện click cho các div chứa radio button
    $('.payment-options').on('click', function () {
        var selectedValue = $(this).data('payment');
        $('input[name="payment_option"][value="' + selectedValue + '"]').prop('checked', true);
        
        updateButtons();
    });

    // Đăng ký sự kiện thay đổi cho radio button
    $('input[name="payment_option"]').on('change', function () {
        updateButtons();
    });

    // Kiểm tra nếu không có địa chỉ, hiển thị liên kết thêm địa chỉ
    if ("{{ $diachis->isEmpty() }}") {
        $('#add-address-link').show();
        $('#place-order-button, #pay-vnpay-button').hide();
    } else {
        $('#add-address-link').hide();
    }

    // Gọi hàm cập nhật nút ban đầu
    updateButtons();
});

// Đảm bảo không có form nào khác bị submit
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function (event) {
        console.log('Form submitting: ' + form.id); // Ghi nhật ký để theo dõi form nào đang được submit
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
    const totalPayablesHidden = document.getElementById('total_payables_hidden');
    const discountAmountField = document.getElementById('discount-amount_hidden');
    const shipCostInnerCity = {{ $giavc->ship_cost_inner_city }}; 
    const shipCostNationwide = {{ $giavc->ship_cost_nationwide }}; 
    const totalAmount = {{ $totalAmount }};
    
    addressSelect.addEventListener('change', function() {
        const selectedOption = addressSelect.options[addressSelect.selectedIndex]; 
        const thanhPho = selectedOption.text.split(',').pop().trim(); 
        let shippingCost = 0; 

        if (thanhPho === 'Hồ Chí Minh' || thanhPho === 'Thành phố Hồ Chí Minh') { 
            shippingCost = shipCostInnerCity;
        } else { 
            shippingCost = shipCostNationwide; 
        }

        const discountAmount = parseFloat(discountAmountField.value) || 0;
        const totalPayable = totalAmount - discountAmount + shippingCost;

        shippingCostField.innerText = shippingCost.toLocaleString() + ' đ'; 
        totalPayableField.innerText = totalPayable.toLocaleString() + ' đ'; 
        totalPayablesHidden.value = totalPayable;  
    });
    
    addressSelect.dispatchEvent(new Event('change'));
});
</script>

@endsection