@extends('admin.layoutadmin')

@section('title')
    Tài khoản
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        @if(session()->has('thongbao'))
            <div class="toast show align-items-center text-bg-primary border-0 position-fixed top-3 end-0 p-3" role="alert"
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
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Quản lý tài khoản</h1>
                    </div>
                    <div class="col-auto d-flex">
                        <a href="{{ route('tai-khoan.create') }}" class="btn btn-primary">Thêm tài khoản</a>
                    </div>
                </div>
                <!-- Bộ lọc -->
                <form method="GET" action="{{ route('tai-khoan.index') }}">
                    <div class="row g-3 align-items-center mt-3">
                        <div class="col-auto">
                            <select name="role" class="form-select">
                                <option value="0" {{ request('role') == '0' ? 'selected' : '' }}>Người Dùng</option>
                                <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Admin</option>
                                <option value="">Tất cả vai trò</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <select name="is_hidden" class="form-select">
                                <option value="0" {{ request('is_hidden') == '0' ? 'selected' : '' }}>Hiện</option>
                                <option value="1" {{ request('is_hidden') == '1' ? 'selected' : '' }}>Đã ẩn</option>
                                <option value="">Tất cả trạng thái</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-secondary">Lọc</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                <div class="sa-layout__content">
                    <div class="card table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai Trò</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role == 1 ? 'Admin' : 'Người Dùng' }}</td>
                                        <td>
                                            <a href="{{ route('tai-khoan.show', $user->id) }}" class="btn btn-info btn-sm">Xem</a>
                                            
                                            @if($user->role == 1)  <!-- Nếu là Admin -->
                                                <a href="{{ route('tai-khoan.edit', $user->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                            @endif
                                            
                                            @if($user->is_hidden)
                                                <form action="{{ route('tai-khoan.restore', $user->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn hiện lại tài khoản này?')" class="btn btn-success btn-sm">Hiện lại</button>
                                                </form>
                                            @else
                                                <form action="{{ route('tai-khoan.hide', $user->id) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn ẩn tài khoản này?')" class="btn btn-danger btn-sm">Ẩn</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
