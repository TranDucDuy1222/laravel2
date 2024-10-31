@extends('user.layout')
@section('title')
Thông tin tài khoản
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

<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Thông tin tài khoản</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">
    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container">
            <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                <div class="col-3 bg-body-secondary">
                    <ul class="list-unstyled">
                        <li class="bg-body-secondary"><a
                                class="text-decoration-none  dropdown-dc mt-2 h6 {{(request()->routeIs('user.profile')) ? 'text-danger' : 'text-dark'}}"
                                href="#">Hồ sơ của tôi</a></li>
                        <li class="bg-body-secondary"><a class="text-decoration-none text-dark dropdown-dc mt-2 h6"
                                href="index.php?mod=thongtin&act=order">Đơn hàng đã mua</a></li>
                        <li class="bg-body-secondary"><a class="text-decoration-none text-dark dropdown-dc mt-2 h6"
                                href="#">Yêu cầu xóa tài khoản</a></li>
                    </ul>
                </div>
                <div class="col-9">
                    <div class="card">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="d-flex align-dcs-center">
                                    <img style="border-radius: 50%;" src="" width="100" height="100" alt="" />
                                    <div style="padding-top: 15px; padding-left: 15px;">
                                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Tên:
                                            {{$taiKhoan->name}}</span>
                                        <br>
                                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">ID:
                                            {{$taiKhoan->id}}</span>
                                        <br>
                                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Gmail:
                                            {{$taiKhoan->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 d-flex  justify-content-center align-dcs-center"
                                style="height: 30px;">
                                <a class="btn btn-outline-dark"
                                    href="{{route('user.edit_profile', [Auth::user()->id])}}">Đổi mật khẩu</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card p-1">
                        <div class="row p-xl-2">
                            <div class="col-md-8">
                                <h3 class="ms-3">Địa Chỉ Của Tôi</h3>
                            </div>
                            <div class="col-md-4">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Thêm địa chỉ mới
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm địa chỉ mới</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="appAddDC">
                                                    <address-form></address-form>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Thoát</button>
                                                <button type="button" class="btn btn-outline-success">Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="row p-2">
                            @if (isset($diachi))
                                @foreach ($diachi as $dc)
                                    <div class="col-md-8">
                                        <strong> {{$dc->ho_ten}}</strong>
                                        <p>{{$dc->phone}}</p>
                                        <p>{{$dc->dc_chi_tiet}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex justify-content-end">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $dc->id }}"
                                                style="font-size: 14px;">Cập nhật </a>
                                            <!-- form chỉnh sửa địa chỉ -->
                                            <div class="modal fade" id="exampleModal{{ $dc->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <form action="{{ route('dia_chi.update', $dc->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa
                                                                    địa chỉ :</h1>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="name{{ $dc->ho_ten }}">Tên</label>
                                                                    <input type="text" name="ho_ten" class="form-control"
                                                                        id="name{{ $dc->id }}" placeholder="Nhập tên"
                                                                        style="margin-bottom: 10px;" value="{{ $dc->ho_ten }}">

                                                                    <label for="phone{{ $dc->phone }}">Số điện thoại</label>
                                                                    <input type="phone" name="phone" class="form-control"
                                                                        id="phone{{ $dc->id }}" placeholder="Nhập số điện thoại"
                                                                        style="margin-bottom: 10px;" value="{{ $dc->phone }}">

                                                                    <label for="dc_chi_tiet{{ $dc->id }}">Địa chỉ</label>
                                                                    <input type="text" name="dc_chi_tiet" class="form-control"
                                                                        id="dc_chi_tiet{{ $dc->id }}" placeholder="Nhập địa chỉ"
                                                                        style="margin-bottom: 10px;"
                                                                        value="{{ $dc->dc_chi_tiet }}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-outline-success">Lưu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <span style="font-size: 14px;"> | </span>
                                            <form action="{{ route('xoa-dia-chi', $dc->id) }}" method="POST" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link" style="background: none; border: none; padding: 0; color: blue; text-decoration: underline; cursor: pointer;">
        Xóa
    </button>
</form>                                        </div>
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
    </body>
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