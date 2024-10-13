@extends('user.layout')
@section('title')
Chi Tiết : {{$detail->ten_sp}}
@endsection

@section('category')
@foreach ($danhmuc as $category)
  <li class="nav-item">
  <a class="nav-link fz" href="/category/{{$category->id}}">
    {{$category->ten_dm}}
  </a>
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
<section class="container section">
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
          <img src="/img/{{$detail->hinh}}" onerror="this.src='/imgnew/{{$detail->hinh}}'" alt="" class="w-100">
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
          <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="">{{$ssl->size_product}}</button>
        @endforeach
        
        <!-- <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='36'">36</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='37'">37</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='38'">38</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='38.5'">38.5</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='39'">39</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='39.5'">39.5</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='40'">40</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='40.5'">40.5</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='41'">41</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='41.5'">41.5</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='42'">42</button>
        <button class="btn btn-outline-dark col-sm-2 my-1 mx-1" ng-click="detail.size='43'">43</button> -->
      </div>
      <hr>
      <div class="d-flex">
        <div class="row">
          <div class="col-sm-5">
            <div class="input-group">
              <strong>Số Lượng :</strong>
            </div>
          </div>
          <div class="col-sm-5">
            <input type="number" name="soluong" id="soluong" class="form-control input-group-lg" required min="1" oninput="updateValue(this.value)">
          </div>
        </div>
      </div>
      <hr>
      <div class="d-flex">
        <div class="m-auto">
          <a href="#" id="themvaogio">
            <button class="btn btn-dark rounded-pill">Thêm Vào Giỏ Hàng</button>
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
                <img src="/img/{{$item->hinh}}" alt="" class="w-100">
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
          <img src="/img/{{$detail->hinh}}" alt="" class="img-nho col-xl-4">
          <p class="col-xl-8">
            {{$detail->ten_sp}}
          </p>
        </div>
        <br>
        <p>
          Sẵn sàng, thiết lập, chơi! Luôn nhẹ nhàng trên đôi chân của bạn với những đôi giày thể thao phiên bản đặc biệt
          này. Phần dưới chân bằng bọt mềm kết hợp với bộ phận Max Air đàn hồi ở gót chân mang đến cho bạn lớp đệm nhẹ
          lý tưởng để hoàn thiện xu hướng khiêu vũ lan truyền mới nhất. Ngoài ra, màu sắc vui tươi, chi tiết thiết kế
          phản chiếu và biểu tượng Swoosh lắc lư mang đến cho những đôi giày này vẻ ngoài sẵn sàng thu hút sự chú ý.
        </p>
        <ul>
          <label>Những lợi ích</label>
          <li>Cặp da tổng hợp với lưới thoáng khí mang lại kết cấu bền bỉ, thoáng khí và thoải mái.</li>
          <li>Đế giữa bằng bọt và bộ phận Max Air ở gót chân giúp mang lại lớp đệm nhẹ.</li>
          <li>Cổ áo có đệm, cắt thấp tạo cảm giác mềm mại và thoải mái.</li>
          <li>Đế ngoài bằng cao su Waffle tăng thêm lực kéo bền bỉ và kiểu dáng di sản.</li>
        </ul>
        <ul>
          <label>Thông tin chi tiết sản phẩm</label>
          <li>Dây buộc cổ điển</li>
          <li>Chi tiết thiết kế phản quang</li>
          <li>Không nhằm mục đích sử dụng làm thiết bị bảo hộ cá nhân (PPE)</li>
          <li>Màu sắc hiển thị: Đen/Hồng vui tươi/Xanh sân vận động/Trắng</li>
          <li>Phong cách: FJ3286-001</li>
          <li>Quốc gia/Khu vực xuất xứ: Indonesia</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Detail -->

<script src="/up/js/size&color.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const inputElement = document.getElementById('soluong');
    inputElement.value = 1;

    document.getElementById('themvaogio').addEventListener('click', function() {
      var soluong = inputElement.value;
      var masp = '{{$detail->id}}';
      var url = '/themvaogio/' + id + '/' + soluong;
      window.location.href = url;
    });
  });
</script>

@endsection