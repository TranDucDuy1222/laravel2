@extends('admin.layoutadmin')

@section('title')
    Chỉnh sửa tài khoản
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Chỉnh sửa tài khoản</h1>
            </div>
            <div class="card shadow border-light">
                <div class="card-body">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                    <form action="{{ route('tai-khoan.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Vai trò</label>
                                <select name="role" class="form-select" required>
                                    <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Người Dùng</option>
                                    <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="is_hidden" class="form-select" required>
                                    <option value="0" {{ $user->is_hidden == 0 ? 'selected' : '' }}>Đang hiển thị</option>
                                    <option value="1" {{ $user->is_hidden == 1 ? 'selected' : '' }}>Đã ẩn</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <h5 class="card-title">Thay đổi mật khẩu</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật khẩu cũ</label>
                                <input type="password" name="current_password" class="form-control" placeholder="Nhập mật khẩu cũ">
                                @error('current_password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật khẩu mới</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Xác nhận mật khẩu mới">
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('tai-khoan.index') }}" class="btn btn-secondary mb-3">Quay lại</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Cập nhật tài khoản</button>
                            </div>
                        </div>             
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
