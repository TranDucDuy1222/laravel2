@extends('user.layout')
@section('title')
Đơn hàng đã mua
@endsection
@section('category')
@foreach ($loai as $category)
<li class="nav-dc dropdown">
    <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
        href="{{ url('/category/' . $category->slug) }}">
        {{$category->ten_loai}}
    </a>
    <ul class="dropdown-menu" id="userDropdown">
        @foreach ($danh_muc as $dm)
        @if ($dm->id_loai == $category->id)
        <li class="hover-dm"><a class="dropdown-dc" href="{{$dm->slug}}">{{$dm->ten_dm}}</a></li>
        @endif
        @endforeach
    </ul>
</li>
@endforeach
@endsection

@section('content')
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Đơn hàng đã mua</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">

    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container">
            <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                <div class="col-3 bg-body-secondary">
                    <ul class="list-unstyled">
                        <li class="bg-body-secondary"><button type="submit" style="border: none;"><a class="text-decoration-none  dropdown-dc mt-2 h6 {{(request()->routeIs('user.profile')) ? 'text-danger' : 'text-dark'}}"
                                    href="{{ route('user.profile', [Auth::user()->id]) }}">Hồ sơ của tôi</a></button></li>
                        <li class="bg-body-secondary"><button type="submit" style="border: none;"><a class="text-decoration-none dropdown-dc mt-2 h6 {{(request()->routeIs('user.purchase')) ? 'text-danger' : 'text-dark'}}"
                                    href="">Đơn hàng đã mua</a></button></li>
                    </ul>
                </div>
                <div class="col-9">
                    <table class="'table">
                        <thead>
                            <tr>
                                <th style="width: 40%;">Sản phẩm</th>
                                <th style="width: 10%;">Kích cỡ</th>
                                <th style="width: 10%;">Số lượng</th>
                                <th style="width: 20%;">Giá</th>
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($purchased as $dhdm)
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <tr>
                                        <td>
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$dhdm->id}}" aria-expanded="false" aria-controls="collapse{{$dhdm->id}}">

                                                    <a href="" class="me-4">
                                                        <div class="">
                                                            <img src="{{ asset('/uploads/product/' . $dhdm->hinh) }}" width="60"
                                                                height="50" onerror="this.src='/imgnew/{{$dhdm->hinh}}'" alt="" />
                                                        </div>
                                                    </a>
                                                    <a href="" class="text-reset">{{$dhdm->ten_sp}}</a>

                                                </button>
                                            </h2>
                                            <div id="collapse{{$dhdm->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body text-black">
                                                    <div class="pttt">
                                                        <label for="">Phương thức thanh toán: {{$dhdm->pttt}}</label>
                                                    </div>
                                                    <div class="tong_dh">
                                                        <label for="">Thành tiền: {{$dhdm->tong_dh}}</label>
                                                    </div>
                                                    <div class="gia">
                                                        <label for="">{{$dhdm->thoi_diem_mua_hang }}<span class="text"></span></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="st-copy">{{$dhdm->size}}</span>

                                        </td>
                                        <td>
                                            <span class="st-copy">x{{$dhdm->so_luong}}</span>

                                        </td>
                                        <td>
                                            <span class="st-copy">{{number_format($dhdm->gia, 0, ',' , '.' )}} đ</span>

                                        </td>
                                    </tr>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </body>
</div>
@endsection