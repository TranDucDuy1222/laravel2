@extends('user.layout')
@section('title')
    Danh Mục : {{$danhmuc1->tendm}}
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
                <p class="m-auto fs-5">1.00.000->2.000.000 VNĐ</p>
              </a>
            </li>
            <li><a class="w-100 d-flex" href="#">
                <input type="checkbox" class="ms-3">
                <p class="m-auto fs-5">2.00.000->4.000.000 VNĐ</p>
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
      <div id="show_product"> <router-view>
        
      </router-view> </div>
      <!-- Phân trang -->
      <div class="p-2 d-flex justify-content-center"> {{$categories->links()}} </div>

      <!-- End phân trang -->
    </div>
  </div>
</div>


<!-- end all product -->

@endsection