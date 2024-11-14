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
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 bg-body-secondary card">
            <ul class="list-unstyled text-center m-0">
                <li class="bg-body-secondary"><button type="submit" style="border: none;"><a class="text-decoration-none  dropdown-dc mt-2 h6 {{(request()->routeIs('user.profile')) ? 'text-danger' : 'text-dark'}}"
                            href="{{ route('user.profile', [Auth::user()->id]) }}">Hồ sơ của tôi</a></button></li>
                <li class="bg-body-secondary"><button type="submit" style="border: none;"><a class="text-decoration-none dropdown-dc mt-2 h6 {{(request()->routeIs('user.purchase')) ? 'text-danger' : 'text-dark'}}"
                            href="">Đơn hàng đã mua</a></button></li>
            </ul>
        </div>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 text-black p-0 bg-body-tertiary ">
            <div class="scroll-donhang">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach ($orders as $dh)
                    <div class="accordion-item p-2 border-5">
                        @if (isset($dh))
                        <div class="row" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$dh->id}}" aria-expanded="false" aria-controls="flush-collapse{{$dh->id}}">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="d-flex align-content-center">
                                    <strong class="me-2">Mã vận đơn: {{ $dh->id }}</strong>
                                    @if($dh->trang_thai == 0)
                                    <p class="align-content-center badge text-bg-warning m-0">Chờ xử lý</p>
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
                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
                                <!-- Văn bản căn phải cho col-xl, col-lg, col-md -->
                                <p class="d-none d-md-block text-end">
                                    Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                    -
                                    Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                </p>
                                <!-- Văn bản căn trái cho col-sm -->
                                <p class="d-md-none text-start">
                                    Ngày đặt hàng : {{ \Carbon\Carbon::parse($dh->thoi_diem_mua_hang)->format('d/m/Y') }} 
                                    <br />
                                    Dự kiến giao hàng : {{ $dh->ngay_du_kien_giao_hang->format('d/m/Y') }}
                                </p>
                                
                            </div>
                            <div class="col-12">
                                <h4>Địa chỉ người nhận:</h4>
                                <p>
                                    {{ $dh->ho_ten }} | {{ $dh->phone }} | {{$dh->dc_chi_tiet}}, {{$dh->qh}} {{$dh->thanh_pho}}
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
                            <div class="col-8 d-flex align-items-center text-end">
                                <p class="ms-auto mb-0">Phương thức thanh toán</p>

                            </div>
                            <div class="col-4 text-end text-truncate">
                                @if($dh->pttt == "COD")
                                <div class="d-flex justify-content-end align-items-center">
                                    <div class="badge text-bg-success">COD</div>
                                    <p class="ms-2 mb-0 align-self-center fs-6 text-truncate">Thanh toán khi nhận hàng</p>
                                </div>

                                @else
                                <p class="mb-0 text-truncate">Đã thanh toán</p>
                                @endif
                            </div>
                            <div class="col-8 d-flex align-items-center text-end">
                                <p class="ms-auto mb-0">Phí vận chuyển</p>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end align-items-center">
                                    <p class="fs-6">
                                        @if($dh->thanh_pho === "Thành phố Hồ Chí Minh" || $dh->thanh_pho === "Hồ Chí Minh")
                                            {{number_format($phivc->ship_cost_inner_city, 0, '','.');}} đ
                                        @else
                                            {{number_format($phivc->ship_cost_nationwide, 0, '','.');}} đ
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-8 d-flex align-items-center text-end">
                                <p class="ms-auto mb-0">Ưu đãi sản phẩm</p>
                            </div>
                            <div class="col-4">
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
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal-{{$dh->id}}" class="border-0 btn-link link-success link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;">
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
                                    <button class="border-0 btn-link link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" style="font-size: 14px;"><i>Mua lại</i></button>
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
@endsection