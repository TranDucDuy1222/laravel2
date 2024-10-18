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

<!-- Detail -->
<section class="container section mt-4 text-black">
  <div class="row">
    <div class="col-sm-12 col-xl-8">
      <div class="row">
        <div class="col-sm-2">
          <!-- <img src="public/img/nikeair3.png" alt="" class="w-100 img-nho my-1">
                    <img src="public/img/nikeair3.1.png" alt="" class="w-100 img-nho my-1">
                    <img src="public/img/nikeair3.2.png" alt="" class="w-100 img-nho my-1">
                    <img src="public/img/nikeair3.3.png" alt="" class="w-100 img-nho my-1">
                    <img src="public/img/nikeair3.4.png" alt="" class="w-100 img-nho my-1"> -->
        </div>
        <div class="col-sm-10">
          <img src="{{ asset('/uploads/product/'.$detail->hinh) }}"
            onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" class="w-100" alt="..." height="650px" >
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-xl-4">
      <div class="row">
        <h3 class="col-xl-9">
          {{$detail->ten_sp}}
        </h3>
        <p class="col-xl-3">
          <i class="fa-solid fa-eye"></i>

        </p>
      </div>
      <div class="d-flex">
        <s class="text-secondary fs-4">{{$giaold}}</s>
        <p class="ms-4 text-danger fs-4"> {{$gia_chinh}} đ</p>
      </div>
      <!-- Button trigger modal -->
      <strong data-bs-toggle="modal" data-bs-target="#exampleModal" class="fs-5"><u>Xem chi tiết về sản
          phẩm</u></strong>
      <p>
        {{$detail->mo_ta_ngan}}
      </p>
      <br>
      <div class="d-flex">
        <p><strong>Chọn Kích Cở</strong></p>
        <p class="ms-auto">Hướng Dẫn chọn kích cở </p>
      </div>
      <div class="row m-auto">
      @foreach ($size as $ssl)
      @if ($ssl->so_luong > 0)
      <button id="size" name="size" class="btn col-sm-2 my-1 mx-1 border border-black" data-size="{{$ssl->size_product}}">{{$ssl->size_product}}</button>
      <input name="hangTrongKho" type="hidden" value="{{$ssl->so_luong}}" data-size="{{$ssl->size_product}}">
      @endif
      @endforeach
        <div id="error-message" style="color: red; display: none;">Vui lòng chọn size trước khi thêm vào giỏ hàng.</div>
      </div>
      <hr>
      <div class="d-flex">
        <div class="row">
          <div class="col-sm-5">
            <div class="input-group">
              <strong>Số Lượng:</strong>
            </div>
          </div>
          <div class="col-sm-5">
            <input type="number" name="soluong" id="soluong" class="form-control input-group-lg" required value="1" min="1">
          </div>
          <div id="error-message-sl" style="color: red; display: none;">Số lượng nhập vào vượt quá số lượng hàng trong kho.</div>
        </div>
      </div>
      <hr>
      <div class="d-flex">
        <div class="m-auto">
          <a href="#" id="themvaogio">
            <button class="btn btn-dark rounded-pill" onclick="">Thêm Vào Giỏ Hàng</button>
          </a>
          <button onclick='history.back()' class='btn btn-outline-dark rounded-pill'>Xem Sản Phẩm Khác</button>
        </div>
      </div>
      <hr>
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseFour">
              <strong>Giao hàng và trả hàng miễn phí</strong>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse p-2">
            Giao hàng và trả lại miễn phí<br>
            Đơn hàng từ 5.000.000₫ trở lên của bạn sẽ được giao hàng tiêu chuẩn miễn phí.<br>
            <li>Giao hàng tiêu chuẩn 4-5 ngày làm việc</li>
            <li>Chuyển phát nhanh 2-4 ngày làm việc</li>
            Đơn hàng được xử lý và giao từ Thứ Hai đến Thứ Sáu (trừ ngày lễ)<br>
            Thành viên Nike được hưởng lợi nhuận miễn phí
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <h3><u>Bạn Có Thể Thích <i class="fa-solid fa-arrow-down fa-bounce"></i></u></h3>
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
      <div class="col-xl-4">
      <div class="card">
              <a href="/detail/{{$item->id}}" id="hover-img-home">
                <img src="{{ asset('/uploads/product/'.$item->hinh) }}"
                  onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" class="w-100" alt="..." height="300px" >
              </a>
              <div class="card-body text-center">
                <a href="">
                  <h5 id="hover-sp"> {{$item->hinh}} </h5>
                </a>
                <div class="row">
                  <div class="col-sm-6">
                    {{$item->ten_dm}}
                  </div>
                  <div class="col-sm-6">
                    <strong> {{$gia_chinh}} đ</strong>
                  </div>
                </div>
              </div>
            </div>
      </div>
  @endforeach
  </div>
  <br>
  <h3><u>Đánh Giá</u></h3>
  @foreach ($comment as $item )
  <div class="card p-3 mb-1">
    <div class="row">
        <div class="col-xl-3">
          <div class="d-flex" >
            <strong> {{$item->name}} </strong>
            <p class="ms-2" >| {{$item->thoi_diem}}</p>
          </div>

          <p>⭐⭐⭐⭐⭐</p>
          <p>Phân Loại : {{$item->ten_sp}} </p>
          <p><strong>Nội dung :</strong> {{$item->noi_dung}}.</p>
          <p><strong>Chất lượng sản phẩm:</strong> {{$item->quality_product}}</p>
          
          @if (!empty($item->feedback))
            <p class="ms-2" ><strong>Phản Hồi từ người bán :</strong> <br> {{$item->feedback}}.</p>
          @endif
        </div>
        <div class="col-xl-9 card">
          <img src="/img/{{$item->hinh_dg}}" alt="Ảnh từ người mua" class="col-xl-3">
        </div>
    </div>
  </div>
  @endforeach
</section>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content m-auto" style="width: 700px;">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Thông tin sản phẩm</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container row">
          <img src="{{ asset('/uploads/product/'.$detail->hinh) }}"
          onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" alt="" class="img-nho col-xl-4">
          <p class="col-xl-8">
            {{$detail->ten_sp}}
          </p>
        </div>
        <br>
        <p>
          {{$detail->mo_ta_ct}}
        </p>
        <!-- <ul>
          <label>Những lợi ích</label>
          <p>Cặp da tổng hợp với lưới thoáng khí mang lại kết cấu bền bỉ, thoáng khí và thoải mái.</p>
          <p>Đế giữa bằng bọt và bộ phận Max Air ở gót chân giúp mang lại lớp đệm nhẹ.</p>
          <p>Cổ áo có đệm, cắt thấp tạo cảm giác mềm mại và thoải mái.</p>
          <p>Đế ngoài bằng cao su Waffle tăng thêm lực kéo bền bỉ và kiểu dáng di sản.</p>
        </ul>
        <ul>
          <label>Thông tin chi tiết sản phẩm</label>
          <p>Dây buộc cổ điển</p>
          <p>Chi tiết thiết kế phản quang</p>
          <p>Không nhằm mục đích sử dụng làm thiết bị bảo hộ cá nhân (PPE)</p>
          <p>Màu sắc hiển thị: Đen/Hồng vui tươi/Xanh sân vận động/Trắng</p>
          <p>Phong cách: FJ3286-001</p>
          <p>Quốc gia/Khu vực xuất xứ: Indonesia</p>
        </ul> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Detail -->

<!-- <script src="{{ asset('/up/js/size&color.js') }}"></script> -->
<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    const inputElement = document.getElementById('soluong');
    inputElement.value = 1;

    document.getElementById('themvaogio').addEventListener('click', function() {
      var soluong = inputElement.value;
      var masp = '{{$detail->id}}';
      var url = '/themvaogio/' + masp + '/' + soluong;
      window.location.href = url;
    });
  });
</script> -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedSize = null;
    let hangTrongKho = 0; // Biến để lưu trữ số lượng hàng trong kho của size đã chọn

    const sizeButtons = document.querySelectorAll('button[name="size"]');
    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            sizeButtons.forEach(otherButton => {
                otherButton.classList.remove('btn-dark');
                otherButton.classList.add('btn-outline-dark');
            });
            this.classList.remove('btn-outline-dark');
            this.classList.add('btn-dark');
            selectedSize = this.getAttribute('data-size'); // Lưu size đã chọn
            hangTrongKho = document.querySelector(`input[name="hangTrongKho"][data-size="${selectedSize}"]`).value; // Lấy số lượng hàng trong kho cho size đã chọn
            console.log('Size đã chọn:', selectedSize, 'Hàng trong kho:', hangTrongKho);
            document.getElementById('error-message').style.display = 'none'; // Ẩn thông báo lỗi nếu có
        });
    });

    const addToCartButton = document.querySelector('#themvaogio button');
    addToCartButton.addEventListener('click', function(event) {
        if (!selectedSize) {
            event.preventDefault(); // Ngăn chặn hành động mặc định
            document.getElementById('error-message').style.display = 'block'; // Hiển thị thông báo lỗi
        } else {
            console.log('Thêm vào giỏ hàng với size:', selectedSize);
        }
    });

    document.getElementById('soluong').addEventListener('input', function() {
        var soluong = parseInt(this.value);
        var errorMsg = document.getElementById('error-message-sl');
        var errorMsg_0sz = document.getElementById('error-message-0sz');
        if (!selectedSize || isNaN(soluong) || soluong <= 0 || this.value.trim() === "") {
            this.value = 1;
            this.setAttribute('value', 1);
            errorMsg.style.display = 'none';
        } else if (soluong > hangTrongKho) {
            this.value = hangTrongKho;
            this.setAttribute('value', hangTrongKho); // Cập nhật thuộc tính value
            errorMsg.style.display = 'block';
        } else {
            this.setAttribute('value', soluong); // Cập nhật thuộc tính value
            errorMsg.style.display = 'none';
        }
    });
});


</script>

@endsection