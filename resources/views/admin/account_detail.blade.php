@extends('admin.layoutadmin')

@section('title')
    Chi tiết tài khoản
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Chi tiết tài khoản</h1>
            </div>
            <div class="card shadow border-light">
                <div class="card-body">
                    <h5 class="card-title">Thông tin tài khoản</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vai trò</label>
                            <input type="text" class="form-control" value="{{ $user->role == 1 ? 'Admin' : 'Người Dùng' }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Trạng thái</label>
                            <input type="text" class="form-control" value="{{ $user->is_hidden ? 'Đã ẩn' : 'Đang hiển thị' }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày tạo</label>
                            <input type="text" class="form-control" value="{{ $user->created_at->format('d/m/Y H:i:s') }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Ngày cập nhật</label>
                            <input type="text" class="form-control" value="{{ $user->updated_at->format('d/m/Y H:i:s') }}" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mt-4">
                        <div>
                            <a href="{{ route('tai-khoan.index') }}" class="btn btn-secondary mb-3">Quay lại</a>
                        </div>
                        <div>
                            <a href="{{ route('tai-khoan.edit', $user->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
