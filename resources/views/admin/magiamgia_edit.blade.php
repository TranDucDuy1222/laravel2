@extends('admin.layoutadmin')

@section('title')
    Chỉnh sửa mã giảm giá
@endsection

@section('content')
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <h1 class="h3 m-0">Chỉnh sửa mã giảm giá</h1>
            </div>
            <div class="card shadow border-light">
                <div class="card-body">
                    <h5 class="card-title">Thông tin mã giảm giá</h5>
                    <form action="{{ route('magiamgia.update', $discount->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên mã giảm giá</label>
                                <input type="text" name="code" class="form-control" value="{{ $discount->code }}" required>
                                @error('code')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Loại mã giảm giá</label>
                                <select name="usage_type" class="form-select" required>
                                    <option value="1" {{ $discount->usage_type == 1 ? 'selected' : '' }}>Dùng một lần</option>
                                    <option value="0" {{ $discount->usage_type == 0 ? 'selected' : '' }}>Dùng nhiều lần</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số phần trăm giảm giá</label>
                                <input type="number" name="phan_tram" class="form-control" value="{{ $discount->phan_tram }}" required>
                                @error('phan_tram')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="number" name="ma_gioi_han" class="form-control" value="{{ $discount->ma_gioi_han }}">
                                @error('ma_gioi_han')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày bắt đầu</label>
                                <input type="date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::parse($discount->start_date)->format('Y-m-d') }}" required>
                                @error('start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày kết thúc</label>
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control" value="{{ \Carbon\Carbon::parse($discount->ngay_het_han)->format('Y-m-d') }}" required>
                                @error('end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea name="description" class="form-control" rows="3">{{ $discount->description }}</textarea>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="{{ route('magiamgia.index') }}" class="btn btn-secondary mb-3">Quay lại</a>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Cập nhật mã giảm giá</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
