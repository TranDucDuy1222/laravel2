@extends('user.layout')
@section('title')
Thông tin tài khoản
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
@if(session()->has('thongbao'))
            <div class="toast show align-items-center text-bg-dark border-0 position-fixed top-3 end-0 p-3" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {!! session('thongbao') !!}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
@endif
<h2 style="letter-spacing: 2px; text-align: center; padding-top: 40px;">Thông tin tài khoản</h2>
<div class="row" style="padding-bottom: 50px;  padding-top: 20px; margin-left: 0; margin-right: 0;">

    <body style=" background-color: #F5F5F5;">
        <div class="col-8 container">
            <div class="row" style="border: 1px solid #DCDCDC; height: 70vh;">
                <div class="col-3 bg-body-secondary">
                    <ul class="list-unstyled">
                        <li class="bg-body-secondary"><a class="text-decoration-none  dropdown-item mt-2 h6 {{(request()->routeIs('user.edit_profile'))?'text-danger':'text-dark'}}" href="#">Hồ sơ của tôi</a></li>
                        <li class="bg-body-secondary"><a class="text-decoration-none text-dark dropdown-item mt-2 h6" href="index.php?mod=thongtin&act=order">Đơn hàng đã mua</a></li>
                    </ul>
                </div>
                <div class="col-9">
                    <div style="padding-top: 30px; padding-left: 30px;">
                        <form action="{{route('user.update_mk', [Auth::user()->id])}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="mkcu" class="form-label">Mật khẩu cũ:</label>
                                <input type="text" id="mkcu" name="mkcu" value="" class="form-control" required>
                            </div>
                            <div>
                                <label for="mkmoi">Mật khẩu mới:</label>
                                <input type="text" id="mkmoi" name="mkmoi" value="" class="form-control" required>
                            </div>
                            <input type="submit" class="btn btn-dark my-3" name="submit" value="Lưu chỉnh sửa">
                        </form>
                        
                    </div>

                </div>
            </div>
    </body>
</div>

@endsection