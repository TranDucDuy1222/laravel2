@extends('admin.layoutadmin')
@section('title')
Chỉnh Sửa Sản Phẩm
@endsection

@section('content')
<form action="{{route('san-pham.update', $sp->id )}}" method="post" enctype="multipart/form-data">
    @method('PUT')
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Chỉnh sửa sản phẩm</h1>
                        </div>
                        <div class="col-auto d-flex">
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout"
                    data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/name" class="form-label">Tên</label>
                                        <input value="{{$sp->ten_sp}}" type="text" class="form-control" id="form-product/name" name="ten_sp" required />
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/description" class="form-label">Mô tả</label>
                                        <textarea id="form-product/description" class="form-control" rows="8" name="mo_ta_ct" required>{{$sp->mo_ta_ct}}</textarea>
                                    </div>
                                    <div>
                                        <label for="form-product/short-description" class="form-label">Mô tả ngắn</label>
                                        <textarea id="form-product/short-description" class="form-control" rows="2" name="mo_ta_ngan" required>{{$sp->mo_ta_ngan}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Giá</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/price" class="form-label">Giá khuyến mãi</label>
                                            <input value="{{$sp->gia_km}}" type="number" class="form-control" id="form-product/price" name="gia_km" required />
                                            @error('gia_km')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="form-product/old-price" class="form-label">Giá cũ</label>
                                            <input value="{{$sp->gia}}" type="number" class="form-control" id="form-product/old-price" name="gia" required />
                                            @error('gia')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Hàng nhập vào kho</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                        </div>
                                    </div>
                                    @foreach ($sizeProduct as $ssl)
                                    <div class="row g-4">
                                        @if ($errors->has('so_luong'))
                                        <div class="alert alert-danger">
                                            {{ $errors->first('so_luong') }}
                                        </div>
                                        @endif
                                        <div class="col">
                                            <input class="form-control my-2" readonly value="{{$ssl->size_product}}" name="size_product[]" />
                                        </div>
                                        <div class="col">
                                            <input value="{{$ssl->so_luong}}" type="number" class="form-control my-2" name="so_luong[]" required />
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                                </div>
                                <div class="sa-entity-layout__sidebar">
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <div class="mb-5">
                                                <h2 class="mb-0 fs-exact-18">Ảnh</h2>
                                            </div>
                                        </div>
                                        <div class="mt-n5">
                                            <img src="{{ asset('/uploads/product/'. $sp->hinh) }}" onerror="this.src='/img/{{$sp->hinh}}'" class="w-50">
                                            <input type="file" name="hinh">
                                            <input type="hidden" value="{{$sp->hinh}}" name="hinh" >
                                        </div>
                                    </div>
                                    <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Chọn Danh mục</h2>
                                    </div>
                                    <select class="sa-select2 form-select " name="id_dm" required>
                                        <option value="0">Chọn danh mục</option>
                                        @foreach($loai_arr as $dm)
                                        <option value="{{ $dm->id }}" {{$dm->id == $sp -> id_dm ? "selected":""}}>
                                            {{$dm->ten_dm}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_dm')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="card w-100 mt-5">
                                    <div class="card-body p-5">
                                        <div class="mb-5">
                                            <h2 class="mb-0 fs-exact-18">Trạng Thái</h2>
                                        </div>
                                        <select class="sa-select2 form-select" name="trang_thai" required>
                                            <option value="0">Sản Phẩm Đang Kinh Doanh</option>
                                            <option value="3">Sản Phẩm Sắp Về Hàng</option>
                                            <!-- @foreach($loai_arr as $dm)
                                        <option value="{{ $dm->id }}" {{ old('id_dm') == $dm->id ? 'selected' : '' }}>
                                            {{$dm->ten_dm}}
                                        </option>
                                        @endforeach -->
                                        </select>
                                        @error('id_dm')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Màu</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <input type="text" class="form-control" value="{{$sp->color}}" id="" name="color" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='card w-100 mt-5'>
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Ngày</h2>
                                    </div>
                                    <input name="ngay" type="date" value="{{$sp->ngay}}"
                                        class="form-control shadow-none border-primary" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- sa-app__body / end -->
    @csrf
</form>
@endsection