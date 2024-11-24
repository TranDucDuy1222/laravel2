@extends('admin.layoutadmin')
@section('title')
Tài khoản
@endsection
@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Chỉnh sửa tài khoản</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <ul id="top-tabbar-vertical" class="p-0">
                                <li class="active" id="personal">
                                    <a href="javascript:void();">
                                        <i class="fa-solid fa-box"></i><span>Thông tin tài khoản</span>
                                    </a>
                                </li>
                                <li id="contact">
                                    <a href="javascript:void();">
                                        <i class="fa-regular fa-file-lines"></i><span>Mật khẩu</span>
                                    </a>
                                </li>
                                </ul>
                            </div>
                            <div class="col-md-9">
                                <form id="form-wizard3" action="{{ route('tai-khoan.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <fieldset>
                                    <div class="form-card">
                                        <div class="row">
                                            <div class="col-12">
                                            <h3 class="mb-4">Thông tin tài khoản:</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Tên</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Email</label>
                                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="role" class="form-label fw-semibold">Vai trò</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Người Dùng</option>
                                                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group">
                                                    <label for="is_hidden" class="form-label fw-semibold">Trạng Thái</label>
                                                    <select name="is_hidden" class="form-select" required>
                                                        <option value="0" {{ $user->is_hidden == 0 ? 'selected' : '' }}>Đang hiển thị</option>
                                                        <option value="1" {{ $user->is_hidden == 1 ? 'selected' : '' }}>Đã ẩn</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button id="submit" type="button" name="next" class="btn btn-primary next action-button float-end" value="Next" >Tiếp tục</button>
                                </fieldset>
                                <fieldset>
                                    <div class="form-card text-left">
                                        <div class="row">
                                            <div class="col-12">
                                            <h3 class="mb-4">Mật khẩu tài khoản:</h3>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Mật khẩu cũ</label>
                                                <input type="password" name="current_password" class="form-control" placeholder="Nhập mật khẩu cũ">
                                                @error('current_password')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Mật khẩu mới</label>
                                                    <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary action-button float-end" value="save" >Thêm tài khoản</button>
                                    <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-3" value="Previous" >Quay lại</button>
                                    </fieldset> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection