@extends('user.layout')
@section('title')
Thông tin tài khoản
@endsection

@section('category')
@foreach ($loai as $category)
    <li class="nav-dc dropdown">
        <a class="nav-link fz dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
            href="{{ url('/category' . '/' . $category->slug) }}">
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
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Thông tin tài khoản</h2>
<div class="container card">
    <div class="row">
        <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12 bg-body-secondary card">
            <ul class="list-unstyled text-center m-0">
                <li class="bg-body-secondary"><button type="submit" style="border: none;"><a
                            class="text-decoration-none  dropdown-dc mt-2 h6 {{(request()->routeIs('user.profile')) ? 'text-danger' : 'text-dark'}}"
                            href="#">Hồ sơ của tôi</a></button></li>
                <li class="bg-body-secondary"><button type="submit" style="border: none;"><a
                            class="text-decoration-none text-dark dropdown-dc mt-2 h6"
                            href="{{route('user.purchase', [Auth::user()->id])}}">Đơn hàng đã mua</a></button></li>
            </ul>
        </div>
        <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-12 text-black p-0 bg-body-tertiary ">
            <div class="row">
                <div class="col-xl-9">
                    <div class="d-flex align-dcs-center">
                        <img style="border-radius: 50%;" src="" width="100" height="100" alt="" />
                        <div style="padding-top: 15px; padding-left: 15px;">
                            <span style="font-size: 14px; letter-spacing: 1px;">Tên tài khoản:
                                {{$taiKhoan->name}}</span>
                            <br>
                            <span style="font-size: 14px; letter-spacing: 1px;">ID:
                                {{$taiKhoan->id}}</span>
                            <br>
                            <span style="font-size: 14px; letter-spacing: 1px;">Gmail:
                                {{$taiKhoan->email}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 d-flex  justify-content-center align-dcs-center"
                    style="height: 40px; margin-top: 4%;">
                    <a class="btn btn-dark " href="{{route('user.edit_profile', [Auth::user()->id])}}">Đổi mật
                        khẩu</a>
                </div>
            </div>
            <br>
            <div class="card p-1">
                <div class="row p-xl-2">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-6 col-6">
                        <h3 class="ms-xl-3"><i class="fa-solid fa-location-dot" style="color: #f90101;"></i> Địa Chỉ Của
                            Tôi</h3>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-6 d-flex justify-content-end">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Thêm địa chỉ
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{route('diachi.add', [Auth::user()->id])}}" method="post">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title fs-5" id="exampleModalLabel">Thêm địa chỉ</p>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="ho_ten">Họ tên</label>
                                                <input type="text" class="form-control" id="ho_ten" name="ho_ten"
                                                    v-model="ho_ten">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại</label>
                                                <input type="phone" class="form-control" id="phone" name="phone"
                                                    v-model="phone">
                                            </div>
                                            <div id="appAddDC">
                                                <address-form></address-form>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Thoát</button>
                                            <button type="submit" class="btn btn-outline-success">Lưu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="scroll-donhang">
                <div class="row p-2">
                    @if (isset($diachi))
                        @foreach ($diachi as $dc)
                            <hr class="mt-1 mb-0">
                            <div class="col-md-8">
                                <strong> {{$dc->ho_ten}}</strong>
                                <p>{{$dc->phone}}</p>
                                <p>{{$dc->dc_chi_tiet}}, {{$dc->qh}}, {{$dc->thanh_pho}}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex justify-content-end align-items-center">
                                    <button class="btn btn-link p-0" style="height: 21px" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal{{ $dc->id }}">
                                        Chỉnh sửa
                                    </button>

                                    <!-- form chỉnh sửa địa chỉ -->
                                    <div class="modal fade" id="exampleModal{{ $dc->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="{{ route('dia_chi.update', $dc->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa địa chỉ :
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="name{{ $dc->ho_ten }}">Họ tên</label>
                                                            <input type="text" name="ho_ten" class="form-control"
                                                                id="name{{ $dc->id }}" placeholder="Nhập tên"
                                                                value="{{ $dc->ho_ten }}" style="margin-bottom: 10px;">
                                                            <label for="phone{{ $dc->phone }}">Số điện thoại</label>
                                                            <input type="phone" name="phone" class="form-control"
                                                                id="phone{{ $dc->id }}" placeholder="Nhập số điện thoại"
                                                                value="{{ $dc->phone }}" style="margin-bottom: 10px;">
                                                            <label for="dc_chi_tiet{{ $dc->id }}">Địa chỉ cụ thể</label>
                                                            <input type="text" name="dc_chi_tiet" class="form-control"
                                                                id="dc_chi_tiet{{ $dc->id }}" placeholder="Nhập địa chỉ"
                                                                value="{{ $dc->dc_chi_tiet }}" style="margin-bottom: 10px;">
                                                            <label for="qh{{ $dc->id }}">Quận / Huyện</label>
                                                            <input type="text" name="qh" class="form-control"
                                                                id="qh{{ $dc->id }}" placeholder="Nhập địa chỉ"
                                                                value="{{ $dc->qh }}" style="margin-bottom: 10px;">
                                                            <label for="thanh_pho{{ $dc->id }}">Tỉnh / Thành Phố</label>
                                                            <input type="text" name="thanh_pho" class="form-control"
                                                                id="thanh_pho{{ $dc->id }}" placeholder="Nhập địa chỉ"
                                                                value="{{ $dc->thanh_pho }}" style="margin-bottom: 10px;">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <span style="font-size: 14px; height: 15px;" class="mx-1"> | </span>
                                    <form action="{{ route('xoa-dia-chi', $dc->id) }}" method="POST" style="display: inline; height: 21px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0">
                                            Xóa
                                        </button>
                                    </form>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button class="btn btn-outline-dark mt-2" style="font-size: 14px;">Thiết lập mặc
                                        định </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <button class="btn btn-outline-dark mt-2" style="font-size: 14px;">Thêm địa chỉ </button>
                    @endif


                </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>


</div>
</div>

@endsection
<!-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var passwordField = document.getElementById('passwordField');
        var togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            // Toggle giữa kiểu 'password' và 'text'
            passwordField.type = (passwordField.type === 'password') ? 'text' : 'password';
            // Toggle giữa biểu tượng mắt mở và đóng
            togglePassword.innerText = (passwordField.type === 'password') ? '👁️‍🗨️' : '👁️‍🗨️';
        });
    });
</script>  -->