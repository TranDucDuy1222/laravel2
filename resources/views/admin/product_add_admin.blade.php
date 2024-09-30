@extends('admin.layoutadmin')
@section('title')
Thêm Sản Phẩm
@endsection

@section('content')
<form action="{{route('san-pham.store')}}" method="post" enctype="multipart/form-data">
    <!-- sa-app__body -->
    @csrf
    <input type="hidden" name="size[]" value="{{}}">
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Thêm sản phẩm</h1>
                        </div>
                        <div class="col-auto d-flex">
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        </div>
                        <div class="col-auto d-flex">
                            <a href=""></a><input type="submit" class="btn btn-dark" name="submit" value="Back"></a>
                        </div>
                    </div>
                </div>
                <div class="sa-entity-layout"
                    data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            @if(session()->has('thongbao'))
                            <div class="alert alert-danger p-3 fs-5 text-center">
                                {!! session('thongbao') !!}
                            </div>
                            @endif
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/name" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="form-product/name" name="ten_sp" required />
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/description" class="form-label">Mô tả</label>
                                        <textarea id="form-product/description" class="form-control" rows="8" name="mo_ta_ct"></textarea>
                                    </div>
                                    <div>
                                        <label for="form-product/short-description" class="form-label">Mô tả ngắn</label>
                                        <textarea id="form-product/short-description" class="form-control" rows="2" name="mo_ta_ngan"></textarea>
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
                                            <label for="form-product/price" class="form-label">Giá khuyến mãi</label><input
                                                type="number" class="form-control" id="form-product/price"
                                                name="gia_km" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/old-price" class="form-label">Giá cũ</label>
                                            <input type="number" class="form-control" id="form-product/old-price" name="gia" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Hàng tồn kho</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="37" id="form-product/size" name="size_product"/>
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="38.5" id="form-product/size" name="size_product"/>
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="39" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="39.5" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="40" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="40.5" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="41" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="41.5" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="42" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input class="form-control" readonly value="42.5" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/size" class="form-label">Kích thước</label>
                                            <input readonly value="43" class="form-control" id="form-product/size" name="size_product" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/quantity" class="form-label">Số lượng</label>
                                            <input value="0" type="number" class="form-control" id="form-product/quantity" name="so_luong" required/>
                                        </div>
                                    </div>
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
                                    <input name="hinh" type="file" class="form-controller" required>
                                </div>
                            </div>
                            <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Danh mục</h2>
                                    </div>
                                    <select class="sa-select2 form-select " name="id_dm" required>
                                        <option value="-1">Chọn loại</option>
                                        @foreach($loai_arr as $dm)
                                        <option value="{{$dm->id}}">
                                            {{$dm->ten_dm}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Trạng thái</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <input type="number" class="form-control" id="" name="trang_thai" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Tính chất</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <input type="number" class="form-control" id="" name="tinh_chat" required/>
                                        </div>
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
                                            <input type="text" class="form-control" id="" name="color" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <!-- sa-app__body / end -->
</form>
@endsection