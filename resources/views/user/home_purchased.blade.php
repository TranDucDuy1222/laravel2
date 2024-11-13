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
                                <strong>Mã vận đơn: {{ $dh->id }}</strong>
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
                                                    {{ $pc->ten_sp }}
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
                                @if ($dh->trang_thai == 1)
                                <p class="text-white badge-success">Chờ xử lý</p>
                                @elseif($dh->trang_thai == 2)
                                <button class="btn btn-outline-dark">Trạng thái</button>
                                @else
                                <button class="btn btn-outline-danger" style="font-size: 12px;">Hủy Đơn</button>
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