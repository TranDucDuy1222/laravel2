@extends('admin.layoutadmin')

@section('title')
    Đơn hàng
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Quản lý đơn hàng</h1>
                    </div>
                </div>
                <form method="GET" action="{{ route('don-hang.index') }}">
                    <div class="row g-3 align-items-center mt-3">
                        <div class="col-auto">
                            <select name="trang_thai" class="form-select">
                                <option value="">Tất cả trạng thái</option>
                                <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Chưa xử lý</option>
                                <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Chưa giao hàng</option>
                                <option value="2" {{ request('trang_thai') == '2' ? 'selected' : '' }}>Đã giao thành công</option>
                                <option value="3" {{ request('trang_thai') == '3' ? 'selected' : '' }}>Đã hủy</option>
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
                                    <th>Người đặt hàng</th>
                                    <th>Thời gian đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donHangs as $donHang)
                                    <tr>
                                        <td>{{ $donHang->id }}</td>
                                        <td>{{ $donHang->user->name }}</td>
                                        <td>{{ $donHang->thoi_diem_mua_hang }}</td>
                                        <td>{{ number_format($donHang->tong_dh, 0, ',', '.') }} đ</td>
                                        <td>{{ $donHang->pttt }}</td>
                                        <td>
                                            @if ($donHang->trang_thai == 0)
                                                <span class="badge bg-info">Chưa xử lý</span>
                                            @elseif ($donHang->trang_thai == 1)
                                                <span class="badge bg-warning">Chưa giao hàng</span>
                                            @elseif ($donHang->trang_thai == 2)
                                                <span class="badge bg-success">Đã giao thành công</span>
                                            @elseif ($donHang->trang_thai == 3)
                                                <span class="badge bg-danger">Đã hủy</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('don-hang.show', $donHang->id) }}" class="btn btn-info btn-sm">Xem chi tiết</a>
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
