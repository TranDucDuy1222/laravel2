@extends('user.layout')
@section('title')
Tất Cả Sản Phẩm
@endsection

@section('category')
  @foreach ($danhmuc as $category )
    <li class="nav-item">
      <a class="nav-link fz" href="/category/{{$category->id}}">
        {{$category->ten_dm}}
      </a>
    </li>
  @endforeach
@endsection

@section('content')

<!-- all product -->
<div class="container-fluid">
  <div class="mx-xl-5 mt-2 row">
    <div class="col-lg-2 overflow-auto" id="box-menu-dung">
      <!-- Tìm kiếm -->
      <div class="ms-2">
        <div class="search-box bg-white">
          <i class="fa-solid fa-magnifying-glass fa-fade"></i>
          <input class="form-control" type="text" ng-model="keyw" name="keyw" placeholder="Nhập...">
        </div>
      </div>
      <hr>
      <div class="w-100 menu-dung">
        <div class="ms-3">
          <i class="fa-solid fa-list fa-bounce"></i>
          <strong class="ms-2">Danh Mục</strong>
        </div>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Giày Nam</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Giày Nữ</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Giày Trẻ Em</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Giảm Giá</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Nike Air Max DN</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Nike Air Max DN</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Nike Air Max 1</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Nike Air Max 90</p>
          </a>
        </li>
        <li><a class="w-100 d-flex" href="#">
            <input type="checkbox" class="ms-3">
            <p class="m-auto fs-5">Nike Air Max 95</p>
          </a>
        </li>
      </div>
      <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
              aria-controls="panelsStayOpen-collapseOne">
              <strong>Giá Tiền</strong>
            </button>
          </h2>
          <div class="w-100 menu-dung" id="panelsStayOpen-collapseOne">
            <li><a class="w-100 d-flex" href="#">
                <input type="checkbox" class="ms-3">
                <p class="m-auto fs-6"><strong>1.00.000->2.000.000 VNĐ</strong></p>
              </a>
            </li>
            <li><a class="w-100 d-flex" href="#">
                <input type="checkbox" class="ms-3">
                <p class="m-auto fs-6"><strong>2.00.000->4.000.000 VNĐ</strong></p>
              </a>
            </li>
            <li><a class="w-100 d-flex" href="#">
                <input type="checkbox" class="ms-3">
                <p class="m-auto fs-5">Trên 4.000.000 VNĐ</p>
              </a>
            </li>
            <li><a class="w-100 d-flex" href="#">
                <input type="checkbox" class="ms-3">
                <p class="m-auto fs-5">Dưới 1.000.000 VNĐ</p>
              </a>
            </li>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseThree">
              <strong>Màu Sắc</strong>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
            <div class="accordion-body row">
              <div class="col-lg-4">
                <button class="rounded-circle border border-danger bg-danger"
                  style="height: 40px; width: 40px;"></button>
                <p>Đỏ</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border border-primary bg-primary"
                  style="height: 40px; width: 40px;"></button>
                <p>Xanh</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border border-warning bg-warning"
                  style="height: 40px; width: 40px;"></button>
                <p>Vàng</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle bg-dark" style="height: 40px; width: 40px;"></button>
                <p>Đen</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border border-white bg-light" style="height: 40px; width: 40px;"></button>
                <p>Trắng</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border border-secondary bg-secondary"
                  style="height: 40px; width: 40px;"></button>
                <p>Xám</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border bgpink" style="height: 40px; width: 40px;"></button>
                <p>Hồng</p>
              </div>
              <div class="col-lg-4">
                <button class="rounded-circle border border-success bg-success"
                  style="height: 40px; width: 40px;"></button>
                <p>Xanh Lá</p>
              </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
              aria-controls="panelsStayOpen-collapseFour">
              <strong>Size</strong>
            </button>
          </h2>
          <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
            <div class="w-100 menu-dung">
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">Nam</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">Nữ</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">Dành cho trẻ em</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">35->36</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">36->37</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">37->38</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">38->39</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">39->40</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">40->41</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">41->42</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">42->43</p>
                </a>
              </li>
              <li><a class="w-100 d-flex" href="#">
                  <input type="checkbox" class="ms-3">
                  <p class="m-auto fs-5">43->44</p>
                </a>
              </li>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-10">
      <!-- Sắp xếp -->
      <div class="d-flex justify-content-end">
        <div class="">
          <button class="btn btn-outline-secondary rounded-pill dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Sắp xếp
          </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item" >Giá tăng dần</li>
            <li class="dropdown-item" >Giá giảm dần</li>
            <li class="dropdown-item" >Mới Nhất</li>
          </ul>
        </div>
      </div>
      <br>
      <!-- show sản phẩm -->
        <div class="row">
          @foreach ($allproduct as $item)
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
          <div class="col-sm-6 col-xl-3 mb-2" >
            <div class="card">
              <a href="/detail/{{$item->id}}" id="hover-img-home">
                <img src="/img/{{$item->hinh}}" onerror="this.src='/imgnew/{{$item->hinh}}'" alt="" class="w-100" style="height: 346px;" >
              </a>
              <div class="card-body text-center">
                <a href="">
                  <h5 id="hover-sp"> {{$item->ten_sp}} </h5>
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
      <!-- Phân trang -->
      <div class="p-2 d-flex justify-content-center"> {{$allproduct->links()}} </div>

      <!-- End phân trang -->
    </div>
  </div>
</div>


<!-- end all product -->

@endsection