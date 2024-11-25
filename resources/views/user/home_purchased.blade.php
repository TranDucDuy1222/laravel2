@extends('user.layout')
@section('title')
Đơn hàng đã mua - TrendyU
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
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Đơn hàng đã mua</h2>
<div class="container card">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 bg-body-tertiary card">
            <ul class="list-unstyled text-center m-0">
                <li class=""><a class="text-decoration-none  dropdown-dc mt-2 h6 {{(request()->routeIs('user.profile')) ? 'text-danger' : 'text-dark'}}"
                            href="{{ route('user.profile', [Auth::user()->id]) }}">Hồ sơ của tôi</a></li>
                <li class=""><a class="text-decoration-none dropdown-dc mt-2 h6 {{(request()->routeIs('user.purchase')) ? 'text-danger' : 'text-dark'}}"
                            href="">Đơn hàng đã mua</a></li>
            </ul>
        </div>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 text-black p-0 bg-body-tertiary " style="color: brown;">
            <nav class="overflow-x-auto scroll-status-od">
                <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
                    <button class="nav-link click-tabs flex-grow-1 active" id="cho-xac-nhan-tab" data-bs-toggle="tab" data-bs-target="#cho-xac-nhan" type="button" role="tab" aria-controls="cho-xac-nhan" aria-selected="true">
                        <div class="text-center position-relative pt-2">
                            <i class="fa-regular fa-clipboard custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner badge bg-danger">
                                    {{ $status_1 }}
                                </span>
                            </i>
                            <p>Chờ xác nhận</p>
                        </div>
                    </button>
                    <button class="nav-link click-tabs flex-grow-1" id="doi-van-chuyen-tab" data-bs-toggle="tab" data-bs-target="#doi-van-chuyen" type="button" role="tab" aria-controls="doi-van-chuyen" aria-selected="false">
                        <div class="text-center pt-2">
                            <i class="fa-solid fa-box custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner badge bg-danger">
                                    {{ $status_2 }}
                                </span>
                            </i>
                            <p>Đợi vận chuyển</p>
                        </div>
                    </button>
                    <button class="nav-link click-tabs flex-grow-1" id="dang-giao-hang-tab" data-bs-toggle="tab" data-bs-target="#dang-giao-hang" type="button" role="tab" aria-controls="dang-giao-hang" aria-selected="false">
                        <div class="text-center pt-2">
                            <i class="fa-solid fa-shipping-fast custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner-ship badge bg-danger">
                                    {{ $status_3 }}
                                </span>
                            </i>
                            <p>Đang giao hàng</p>
                        </div>
                    </button>
                    <button class="nav-link click-tabs flex-grow-1" id="da-nhan-hang-tab" data-bs-toggle="tab" data-bs-target="#da-nhan-hang" type="button" role="tab" aria-controls="da-nhan-hang" aria-selected="false">
                        <div class="text-center pt-2">
                            <i class="fa-solid fa-clipboard-check custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner badge bg-danger">
                                    {{ $status_4 }}
                                </span>
                            </i>
                            <p>Đã nhận hàng</p>
                        </div>
                    </button>
                    <button class="nav-link click-tabs flex-grow-1" id="da-danh-gia-tab" data-bs-toggle="tab" data-bs-target="#da-danh-gia" type="button" role="tab" aria-controls="da-danh-gia" aria-selected="false">
                        <div class="text-center pt-2">
                            <i class="fa-regular fa-star custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner badge bg-danger">
                                    {{ $status_5 }}
                                </span>
                            </i>
                            <p>Đã đánh giá</p>
                        </div>
                    </button>
                    <button class="nav-link click-tabs flex-grow-1 " id="da-huy-tab" data-bs-toggle="tab" data-bs-target="#da-huy" type="button" role="tab" aria-controls="da-huy" aria-selected="false">
                        <div class="text-center pt-2">
                            <i class="fa-solid fa-circle-xmark custom-icon" style="color: #000000; position: relative;">
                                <span class="position-absolute top-right-corner badge bg-danger">
                                    {{ $status_6 }}
                                </span>
                            </i>
                            <p>Đã Huỷ</p>
                        </div>
                    </button>
                    
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="cho-xac-nhan" role="tabpanel" aria-labelledby="cho-xac-nhan-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_0 as $dh)
                            <div class="accordion-item p-2 border-5 ">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-sm-5 col-6">
                                            @if ($dh->trang_thai == 0)
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#cancel-{{$dh->id}}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;">
                                                    Hủy Đơn
                                                </button>
                                                <!-- Modal huỷ đơn hàng -->
                                                <div class="modal fade" id="cancel-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Huỷ đơn hàng : {{$dh->id}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <i class="fa-regular fa-circle-xmark display-1" style="color: #e04300;"></i>
                                                            <br>
                                                            <p >Bạn có chắc chắn muốn huỷ đơn hàng này không!</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="btn btn-outline-danger" style="font-size: 14px;">
                                                            Xác Nhận Hủy Đơn
                                                        </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            @elseif($dh->trang_thai == 1)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 2)
                                            <p class="text-black"><i>Đơn hàng đang được giao đến bạn</i></p>
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-sm-7 col-6">
                                            <div class="text-sm-end text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="doi-van-chuyen" role="tabpanel" aria-labelledby="doi-van-chuyen-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_1 as $dh)
                            <div class="accordion-item p-2 border-5">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-5">
                                            @if($dh->trang_thai == 1)
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#cancel-{{$dh->id}}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;">
                                                    Hủy Đơn
                                                </button>
                                                <!-- Modal huỷ đơn hàng -->
                                                <div class="modal fade" id="cancel-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Huỷ đơn hàng : {{$dh->id}}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center">
                                                            <i class="fa-regular fa-circle-xmark display-1" style="color: #e04300;"></i>
                                                            <br>
                                                            <p >Bạn có chắc chắn muốn huỷ đơn hàng này không!</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="btn btn-outline-danger" style="font-size: 14px;">
                                                            Xác Nhận Hủy Đơn
                                                        </a>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            @elseif($dh->trang_thai == 2)
                                            <p class="text-black"><i>Đơn hàng đang được giao đến bạn</i></p>
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="dang-giao-hang" role="tabpanel" aria-labelledby="dang-giao-hang-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_2 as $dh)
                            <div class="accordion-item p-2 border-5">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-5">
                                            @if ($dh->trang_thai == 0)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 1)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 2)
                                                @if($dh->pttt == 'COD')
                                                    <p class="text-black"><i>Thanh toán khi nhận hàng</i> <u>{{number_format($dh->tong_dh, 0, '','.');}} đ</u></p>
                                                @else
                                                <p class="text-black"><i>Thanh toán khi nhận hàng</i> <u>0đ</u></p>
                                                @endif
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="da-nhan-hang" role="tabpanel" aria-labelledby="da-nhan-hang-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_3 as $dh)
                            <div class="accordion-item p-2 border-5">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-5">
                                            @if ($dh->trang_thai == 0)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 1)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 2)
                                            <p class="text-black"><i>Đơn hàng đang được giao đến bạn</i></p>
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="da-danh-gia" role="tabpanel" aria-labelledby="da-danh-gia-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_4 as $dh)
                            <div class="accordion-item p-2 border-5">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-5">
                                            @if ($dh->trang_thai == 0)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 1)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 2)
                                            <p class="text-black"><i>Đơn hàng đang được giao đến bạn</i></p>
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="da-huy" role="tabpanel" aria-labelledby="da-huy-tab" tabindex="0">
                    <div class="scroll-donhang">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($orders_5 as $dh)
                            <div class="accordion-item p-2 border-5">
                                @if (isset($dh))
                                    <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                                            <div class="d-flex align-content-center">
                                                <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                                @if($dh->trang_thai == 0)
                                                <p class="align-content-center badge text-bg-warning m-0">Chờ xác nhận</p>
                                                @elseif($dh->trang_thai == 1)
                                                <p class="align-content-center badge text-bg-info m-0">Đã xác nhận đơn hàng</p>
                                                @elseif($dh->trang_thai == 2)
                                                <p class="align-content-center badge text-bg-primary m-0">Đã giao hàng cho đơn vị vận chuyển</p>
                                                @elseif($dh->trang_thai == 3)
                                                <p class="align-content-center badge text-bg-secondary m-0">Đã nhận được hàng</p>
                                                @elseif($dh->trang_thai == 4)
                                                <p class="align-content-center badge text-bg-success m-0">Đã đánh giá sản phẩm</p>
                                                @elseif($dh->trang_thai == 5)
                                                <p class="align-content-center badge text-bg-danger m-0">Đã hủy</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                                            <!-- Văn bản căn phải cho col-xl và col-lg -->
                                            <p class="d-none d-lg-block text-end">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho col-md -->
                                            <p class="d-none d-md-block d-lg-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                -
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                            <!-- Văn bản căn trái cho các màn hình nhỏ hơn col-md -->
                                            <p class="d-md-none text-start">
                                                Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                                <br />
                                                Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <h4>Địa chỉ người nhận:</h4>
                                            <p>
                                            <i class="fa-solid fa-location-dot" style="color: #000000;"></i> {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
                                            </p>
                                        </div>
                                        
                                        <p class="text-center">Xem chi tiết <i class="fa-solid fa-chevron-down" style="color: #0c0d0d;"></i></p>
                                    </div>
                                    <div id="flush-collapse{{$dh->id}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$dh->id}}" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body p-3">
                                            @foreach ($purchased as $pc)
                                                @php
                                                $gia = number_format($pc->gia, 0, '','.');
                                                @endphp
                                                @if ($pc->id_dh == $dh->id)
                                                <div class="row">
                                                    <div class="col-2 p-1" style="height: 100px; width: 80px;">
                                                        <img src="{{ asset('/uploads/product/' . $pc->hinh) }}" class="h-100 w-100" onerror="this.src='/imgnew/{{$pc->hinh}}'" alt="" />
                                                    </div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col-10 mb-xl-1 mb-lg-1">
                                                                <a href="{{ route('product.detail' , $pc->id_sp) }}" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="text-decoration: underline;">
                                                                    {{ $pc->ten_sp }}
                                                                </a>
                                                            </div>
                                                            <div class="col-2">
                                                                <p class="text-end">
                                                                    <strong>x{{ $pc->so_luong }}</strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p>
                                                                Kích cở : {{ $pc->size_product }} <br/>
                                                                Màu sắc : {{ $pc->color }}
                                                                </p>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="text-end">
                                                                    {{ $gia }} đ
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr class="m-0">
                                        <div class="row" style="font-size: 13px;">
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-start text-sm-end">
                                                <p class="ms-auto mb-0 pttt">Phương thức thanh toán</p>
                                            </div>
                                            <div class="col-sm-4 col-7 text-sm-end text-start">
                                                @if($dh->pttt == "COD")
                                                    <div class="d-flex justify-content-end align-items-center">
                                                        <div class="badge text-bg-success">COD</div>
                                                        <p class="ms-2 mb-0 align-self-center">Thanh toán khi nhận hàng</p>
                                                    </div>
                                                @else
                                                    <div class="d-flex justify-content-end align-items-center text-sm-end text-start">
                                                        <img src="{{ asset('/uploads/logo/icon_vnpay.webp') }}" class="icon-vnpay" alt="">
                                                        <p class="ms-2 mb-0 align-self-center">Đã thanh toán</p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                                            + {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                                        @else
                                                            + {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-5 d-flex align-items-center text-end">
                                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                                            </div>
                                            <div class="col-sm-4 col-7">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <p class="fs-6">
                                                    {{number_format($dh->uu_dai, 0, '','.');}} đ
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-5">
                                            @if ($dh->trang_thai == 0)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 1)
                                                <a href="{{ route('user.purchase-cancel' , $dh->id) }}" class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
                                                    <i>Xác Nhận Hủy Đơn</i>
                                                </a>
                                            @elseif($dh->trang_thai == 2)
                                            <p class="text-black"><i>Đơn hàng đang được giao đến bạn</i></p>
                                            @elseif($dh->trang_thai == 3)
                                                <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="background: none; font-size: 14px;">
                                                    <i>Đánh giá</i>
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal-{{$dh->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('user.purchase-reivew') }}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @foreach ($purchased as $pc)
                                                                    @if ($pc->id_dh == $dh->id)
                                                                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                                                        <input type="hidden" name="id_dh" value="{{$dh->id }}">
                                                                        <input type="hidden" name="id_sp[{{ $pc->id_sp }}]" value="{{$pc->id_sp}}">
                                                                        <input type="hidden" name="id_ctdh[{{ $pc->id_sp }}]" value="{{$pc->id_ctdh}}">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm : {{ $pc->ten_sp }}</h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="mb-3"> 
                                                                                <label for="review-content-{{ $pc->id_sp }}" class="form-label">Nội dung đánh giá</label> 
                                                                                <textarea class="form-control" name="noi_dung[{{ $pc->id_sp }}]" id="review-content-{{ $pc->id_sp }}" rows="3" placeholder="Nhập nội dung đánh giá của bạn"></textarea> 
                                                                            </div> 
                                                                            <div class="mb-3"> 
                                                                                <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Đánh giá sao</label> 
                                                                                <div class="rating"> 
                                                                                    <input type="radio" id="star5-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="5">
                                                                                    <label for="star5-{{ $pc->id_sp }}" title="Rất tốt">5 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star4-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="4">
                                                                                    <label for="star4-{{ $pc->id_sp }}" title="Tốt">4 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star3-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="3">
                                                                                    <label for="star3-{{ $pc->id_sp }}" title="Trung bình">3 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star2-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="2">
                                                                                    <label for="star2-{{ $pc->id_sp }}" title="Kém">2 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                    <input type="radio" id="star1-{{ $pc->id_sp }}" name="rating[{{ $pc->id_sp }}]" value="1">
                                                                                    <label for="star1-{{ $pc->id_sp }}" title="Rất kém">1 <i class="fa-solid fa-star" style="color: #FFD43B;"></i></label> 
                                                                                </div> 
                                                                            </div>
                                                                            <label for="review-rating-{{ $pc->id_sp }}" class="form-label">Hình ảnh về sản phẩm</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="file" name="hinh_dg[{{ $pc->id_sp }}]" class="form-control" id="inputGroupFile01">
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                                                                    <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @elseif($dh->trang_thai == 4)
                                            <p class="text-success"><i>Đã đánh giá</i></p>
                                            @elseif($dh->trang_thai == 5)
                                                <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px; background: none;"><i>Mua lại</i></button>
                                            @endif
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end">Thành tiền: {{number_format($dh->tong_dh, 0, '','.');}} đ</div>
                                        </div>
                                    </div>
                                @else
                                    <h4>Bạn chưa có đơn hàng nào</h4>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

</div>
@endsection