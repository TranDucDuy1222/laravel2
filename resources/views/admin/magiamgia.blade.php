@extends('admin.layoutadmin')

@section('title')
    Quản lý mã giảm giá
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Quản lý mã giảm giá</h1>
                    </div>
                    <div class="col-auto d-flex">
                        <a href="{{ route('magiamgia.create') }}" class="btn btn-primary">Thêm mã giảm giá</a>
                    </div>
                </div>
                <!-- Bộ lọc -->
                <form method="GET" action="{{ route('magiamgia.index') }}">
                    <div class="row g-3 align-items-center mt-3">
                        <div class="col-auto">
                            <select name="type" class="form-select">
                                <option value="">Tất cả loại mã</option>
                                <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Mã dùng 1 lần</option>
                                <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Mã dùng nhiều lần</option>
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
                                    <th>Mã giảm giá</th>
                                    <th>Phần trăm giảm</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($discounts as $discount)
                                    <tr>
                                        <td>{{ $discount->id }}</td>
                                        <td>{{ $discount->code }}</td>
                                        <td>{{ $discount->phan_tram }}%</td>
                                        <td>{{ $discount->ma_gioi_han}}</td>
                                        <td>{{ $discount->mo_ta }}</td>
                                        <td>{{ $discount->ngay_het_han ? \Carbon\Carbon::parse($discount->ngay_het_han)->format('d/m/Y') : 'Không có' }}</td>
                                        <td>
                                            <a href="{{ route('magiamgia.show', $discount->id) }}" class="btn btn-info btn-sm">Xem</a>
                                            <a href="{{ route('magiamgia.edit', $discount->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                                            <form action="{{ route('magiamgia.destroy', $discount->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')" class="btn btn-danger btn-sm">Xóa</button>
                                            </form>
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
