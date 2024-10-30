@extends('user.layout')

@section('title')
 Giỏ Hàng - Trendy U
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
                                            @foreach($carts as $item)
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
                                                            {{ number_format($item->sanPham->gia_km) }} VNĐ
                                                        @else
                                                            {{ number_format($item->sanPham->gia) }} VNĐ
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-p__input-counter-wrap">
                                                    <div class="input-counter">
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" id="form-quantity-{{ $item->id }}">
                                                        @csrf
                                                        <span class="input-counter__minus fas fa-minus" onclick="changeQuantity({{ $item->id }}, -1)"></span>
                                                        <input class="input-counter__text input-counter--text-primary-style" type="number" name="quantity" value="{{ $item->so_luong }}" id="quantity-{{ $item->id }}" min="1" onchange="document.getElementById('form-quantity-{{ $item->id }}').submit();">
                                                        <input type="hidden" id="stock-{{ $item->id }}" value="{{ $item->size->so_luong }}">
                                                        <span class="input-counter__plus fas fa-plus" onclick="changeQuantity({{ $item->id }}, 1)"></span>
                                                        </form>
                                                    </div>
                                                    </div>
                                                </td>
                                                <td id="total-price-{{ $item->id }}" class="item-total-price">
                                                    <span class="table-p__price">
                                                        @if ($item->sanPham->gia_km > 0)
                                                            {{ number_format($item->sanPham->gia_km * $item->so_luong) }} VNĐ
                                                        @else
                                                            {{ number_format($item->sanPham->gia * $item->so_luong) }} VNĐ
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
                            <h4 style="color: red;">Tổng tiền: <span id="total-amount">0</span> VNĐ</h4>
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
// Tuỳ chỉnh số lượng sản phẩm
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

// Tính tổng tiền sản các sản phẩm 
function calculateTotal() {
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
  }

  // Gọi hàm khi trang được tải để tính tổng ban đầu
  document.addEventListener('DOMContentLoaded', calculateTotal);

</script>
@endsection
