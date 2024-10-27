@extends('user.layout')
@section('title')
Thông tin tài khoản
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

@section('content')
    <h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Thông tin tài khoản</h2>
    <div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">

        
        <body style=" background-color: #F5F5F5;">
            <div class="col-8 container" >
                <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                        <div class="col-3 bg-body-secondary">
                        <ul class="list-unstyled">
                            <li class="bg-body-secondary"><a class="text-decoration-none  dropdown-item mt-2 h6 {{(request()->routeIs('user.profile'))?'text-danger':'text-dark'}}" href="#">Hồ sơ của tôi</a></li>
                            <li class="bg-body-secondary"><a class="text-decoration-none text-dark dropdown-item mt-2 h6" href="index.php?mod=thongtin&act=order">Đơn hàng đã mua</a></li>
                            <li class="bg-body-secondary"><a class="text-decoration-none text-dark dropdown-item mt-2 h6" href="#">Yêu cầu xóa tài khoản</a></li>
                        </ul>
                        </div>
                        <div class="col-9">
                            <div style="padding-top: 30px; padding-left: 30px;">
                                <div style="display: flex;">
                                    <img style="border-radius: 50%;" src="" width="100" height="100" alt="" />
                                    <div style="padding-top: 15px; padding-left: 15px;">
                                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Tên: {{$taiKhoan->name}}</span> 
                                    <br>
                                        <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">ID: {{$taiKhoan->id}}</span>
                                    </div>
                                </div>
                                
                            <br>
                            <br>
                            <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Gmail: {{$taiKhoan->email}}</span>
                            <br>
                            <br>
                            <span style="font-weight: bold; font-size: 16px; letter-spacing: 1px;">Số điện thoại: {{$taiKhoan->phone}}</span>
                            </div>
                            <a class="btn btn-dark my-3" style="margin-left: 30px;" href="{{route('user.edit_profile', [Auth::user()->id])}}">Đổi mật khẩu</a>
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