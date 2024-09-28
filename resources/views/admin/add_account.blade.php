@extends('admin.layoutadmin')

@section('title')
    Thêm tài khoản
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Thêm tài khoản mới</h1>
            </div>
            <div class="card shadow border-light">
                <div class="card-body">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                    <form action="{{ route('tai-khoan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên</label>
                                <input type="text" name="name" class="form-control" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" required>
                                @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                                @error('password_confirmation')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="role" class="form-label">Vai trò</label>
                                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="0" {{ old('role') == 0 ? 'selected' : '' }}>Người dùng</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="is_hidden" class="form-label">Trạng thái</label>
                                <select id="is_hidden" name="is_hidden" class="form-select" required>
                                    <option value="0" {{ old('is_hidden') == 0 ? 'selected' : '' }}>Hiển thị</option>
                                    <option value="1" {{ old('is_hidden') == 1 ? 'selected' : '' }}>Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('tai-khoan.index') }}" class="btn btn-secondary mb-3">Quay lại</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
