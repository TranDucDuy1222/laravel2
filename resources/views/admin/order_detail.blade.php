@extends('admin.layoutadmin')

@section('title')
    Đơn hàng
@endsection

@section('content')
<div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Chi Tiết Đơn Hàng #{{ $donHang->id }}</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    Thông Tin Đơn Hàng
                </div>
                <div class="card-body">
                    <p><strong>Người Mua:</strong> {{ $donHang->user->name }}</p>
                    <p><strong>Địa Chỉ:</strong> {{ $donHang->diaChi->dc_chi_tiet }}</p>
                    <p><strong>Thời Điểm Mua:</strong> {{ \Carbon\Carbon::parse($donHang->thoi_diem_mua_hang)->format('d/m/Y H:i') }}</p>

                    <p><strong>Tổng Tiền:</strong> {{ number_format($donHang->tong_dh, 0, ',', '.') }} VND</p>
                    <p><strong>Phương Thức Thanh Toán:</strong> {{ $donHang->pttt }}</p>
                    <p><strong>Trạng Thái:</strong>
                        @if($donHang->trang_thai == 0)
                            <span class="badge bg-warning">Chưa giao hàng</span>
                        @elseif($donHang->trang_thai == 1)
                            <span class="badge bg-success">Đã giao thành công</span>
                        @elseif($donHang->trang_thai == 2)
                            <span class="badge bg-danger">Đã hủy</span>
                        @endif
                    </p>
                    <!-- Form cập nhật trạng thái -->
                    <form action="{{ route('don-hang.update-trang-thai', $donHang->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="trang_thai" class="mb-3"><strong>Thay Đổi Trạng Thái:</strong></label>
                        <div class="row">
                            <div class="col-md-2 mb-3" >
                                <select name="trang_thai" id="trang_thai" class="form-control">
                                    <option value="0" {{ $donHang->trang_thai == 0 ? 'selected' : '' }}>Chưa giao hàng</option>
                                    <option value="1" {{ $donHang->trang_thai == 1 ? 'selected' : '' }}>Đã giao thành công</option>
                                    <option value="2" {{ $donHang->trang_thai == 2 ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-3" >
                                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Sản Phẩm Đã Mua</h1>
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
                                    <th>Mã Sản Phẩm</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Size</th>
                                    <th>Giá</th>
                                    <th>Tổng Giá</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($donHang->chiTietDonHangs && $donHang->chiTietDonHangs->isNotEmpty())
                                @foreach($donHang->chiTietDonHangs as $ct)
                                    <tr>
                                        <td>{{ $ct->id_sp }}</td>
                                        
                                        <td>
                                            <img src="{{ asset('images/' . $ct->sanPham->hinh) }}" alt="{{ $ct->sanPham->ten_sp }}" style="width: 50px; height: auto;">
                                        </td>
                                        <td>{{ $ct->sanPham->ten_sp }}</td>
                                        <td>{{ $ct->so_luong }}</td>
                                        <td>{{ $ct->size ?? 'N/A' }}</td>
                                        <td>{{ number_format($ct->gia, 0, ',', '.') }} VND</td>
                                        <td>{{ number_format($ct->so_luong * $ct->gia, 0, ',', '.') }} VND</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">Không có sản phẩm nào trong đơn hàng này.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
