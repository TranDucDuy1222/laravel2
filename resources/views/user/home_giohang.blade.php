@extends('user.layout')

@section('title')
 Giỏ Hàng - Trendy U
@endsection

@section('category')
    @foreach ($loai as $category)
        <li class="nav-item dropdown">
            <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                href="{{ route('loai-san-pham',$category->slug) }}">
                {{$category->ten_loai}}
            </a>
            <ul class="dropdown-menu" id="userDropdown">
                @foreach ($danh_muc as $dm)
                    @if ($dm->id_loai == $category->id)
                        <li class="hover-dm"><a class="dropdown-item" href="{{ route('danh-muc-san-pham' , $dm->slug)}}">{{$dm->ten_dm}}</a></li>
                    @endif
                @endforeach
            </ul>
        </li>
    @endforeach
@endsection

@section('content')
@if(session()->has('error'))
    <div class="z-1 toast show align-items-center text-bg-danger border-0 position-fixed top-3 end-0 p-3" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {!! session('error') !!}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
            </button>
        </div>
    </div>
@endif
@if(session()->has('success'))
    <div class="z-1 toast show align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {!! session('success') !!}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close">
            </button>
        </div>
    </div>
@endif
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
    <div class="z-1 toast align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert" aria-live="assertive" aria-atomic="true" id="toast-container">
    <div class="d-flex">
        <div class="toast-body" id="toast-body">
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
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
                <form action="{{ route('pay') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-xl-12 mb-3">
                        <div class="table-responsive">
                            <div class="scroll-container">
                                <table class="table-p">
                                    <tbody>
                                        <tr>
                                            <td style="width :2%;"></td>
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
                                            @php
                                                $carts = session('carts', []);
                                            @endphp
                                            @foreach($carts as $index => $item)
                                            <tr class="border-bottom">
                                                <td>
                                                    <input type="checkbox" name="selected_products[]" class="form-check-input large-checkbox" value="{{ $item->id }}" onclick="calculateTotal()" checked>
                                                </td>
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
                                                            {{ number_format($item->sanPham->gia_km, 0, '', '.') }} đ
                                                        @else
                                                            {{ number_format($item->sanPham->gia, 0, '', '.') }} đ
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-p__input-counter-wrap">
                                                        <div class="input-counter">
                                                            <input type="hidden" id="so_luong_kho-{{ $item->id }}" value="{{ $item->size->so_luong }}">
                                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" id="form-quantity-{{ $item->id }}" onsubmit="return checkQuantity({{ $item->id }})">
                                                                @csrf
                                                                <span class="input-counter__minus fas fa-minus" onclick="changeQuantity({{ $item->id }}, -1)"></span>
                                                                <input class="input-counter__text input-counter--text-primary-style" type="number" name="quantity" value="{{ $item->so_luong }}" id="quantity-{{ $item->id }}" min="1">
                                                                <input type="hidden" id="stock-{{ $item->id }}" value="{{ $item->size->so_luong }}">
                                                                <span class="input-counter__plus fas fa-plus" onclick="changeQuantity({{ $item->id }}, 1)"></span>
                                                            </form>
                                                            <script>
                                                                console.log('Form rendered for item ID: {{ $item->id }}');
                                                            </script>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td id="total-price-{{ $item->id }}" class="item-total-price">
                                                    <span class="table-p__price">
                                                        @if ($item->sanPham->gia_km > 0)
                                                            {{ number_format($item->sanPham->gia_km * $item->so_luong, 0, '', '.') }} đ
                                                        @else
                                                            {{ number_format($item->sanPham->gia * $item->so_luong, 0, '', '.') }} đ
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-p__del-wrap">
                                                        <form action="{{ route('cart.remove', $item->id_sp) }}" method="GET" style="display:inline;">
                                                            <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')" class="btn far fa-trash-alt table-p__delete-link"></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end align-items-center my-2">
                        <div class="text-black me-2">
                            <h4 style="color: red;">Tổng tiền: <span id="total-amount">0</span> đ</h4>
                        </div>
                        <button class="btn btn--e-brand-b-2" type="submit" id="checkout-button">THANH TOÁN (0)</button>
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
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function changeQuantity(itemId, change) {
    const quantityInput = document.getElementById(`quantity-${itemId}`);
    if (!quantityInput) {
        console.error(`Quantity input not found for item ID: ${itemId}`);
        return;
    }
    let currentQuantity = parseInt(quantityInput.value);
    currentQuantity += change;

    if (currentQuantity < 1) {
        currentQuantity = 1;
    }

    quantityInput.value = currentQuantity;
    checkQuantity(itemId);
}

function checkQuantity(itemId) {
    const quantityInput = document.getElementById(`quantity-${itemId}`);
    const stockQuantity = parseInt(document.getElementById(`stock-${itemId}`).value);
    const currentQuantity = parseInt(quantityInput.value);

    if (!quantityInput) {
        console.error(`Quantity input not found for item ID: ${itemId}`);
        return false;
    }

    if (!stockQuantity) {
        console.error(`Stock quantity not found for item ID: ${itemId}`);
        return false;
    }

    if (currentQuantity > stockQuantity) {
        quantityInput.value = stockQuantity;
        showToast('Số lượng sản phẩm không được vượt quá số lượng hàng có sẵn.');
        return false;
    }

    const form = document.getElementById(`form-quantity-${itemId}`);
    if (form) {
        console.log(`Form found and submitted for item ID: ${itemId}`);
        form.submit();
    } else {
        console.error(`Form not found for item ID: ${itemId}`);
    }
    return true;
}

function showToast(message) {
    alert(message); // You can replace this with your actual toast implementation
}


function showToast(message) {
    const toastContainer = document.getElementById('toast-container');
    const toastBody = document.getElementById('toast-body');

    toastBody.textContent = message;
    toastContainer.classList.remove('d-none');
    toastContainer.classList.add('show');
    
    // Tự động ẩn thông báo sau 3 giây
    setTimeout(() => {
        toastContainer.classList.remove('show');
        toastContainer.classList.add('d-none');
    }, 3000);
}

// Tính tổng tiền các sản phẩm 
function calculateTotal(){
    let total = 0;
    let count = 0;
    document.querySelectorAll('input[name="selected_products[]"]:checked').forEach(checkbox => {
      const productRow = checkbox.closest('tr');
      const priceElement = productRow.querySelector('.item-total-price .table-p__price');
      const price = parseInt(priceElement.textContent.replace(/\D/g, ''));
      total += price;
      count++;
    });
    document.getElementById('total-amount').textContent = new Intl.NumberFormat().format(total);
    document.getElementById('checkout-button').textContent = `THANH TOÁN (${count})`;
    
    // Kiểm tra nếu không có sản phẩm nào được chọn
    if(count === 0) {
        document.getElementById('checkout-button').disabled = true;
    } else {
        document.getElementById('checkout-button').disabled = false;
    }
}

// Gọi hàm khi trang được tải để tính tổng ban đầu
document.addEventListener('DOMContentLoaded', calculateTotal);


</script>
@endsection
