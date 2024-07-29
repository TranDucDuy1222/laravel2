@extends('admin.layoutadmin')
@section('title')
Thêm Sản Phẩm
@endsection

@section('content')
<form action="{{route('san-pham.store')}}" method="post" enctype="multipart/form-data">
    <!-- sa-app__body -->
    @csrf
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Add Product</h1>
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
                                        <label for="form-product/name" class="form-label">Name</label><input type="text"
                                            class="form-control" id="form-product/name" name="tensp" required />
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/description" class="form-label">Description</label>
                                        <textarea id="form-product/description" class="form-control" rows="8"
                                            name="motachitiet"></textarea>
                                    </div>
                                    <div>
                                        <label for="form-product/short-description" class="form-label">Short
                                            description</label>
                                        <textarea id="form-product/short-description" class="form-control" rows="2"
                                            name="motangan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Pricing</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <label for="form-product/price" class="form-label">Sale Price</label><input
                                                type="number" class="form-control" id="form-product/price"
                                                name="giakhuyenmai" />
                                        </div>
                                        <div class="col">
                                            <label for="form-product/old-price" class="form-label">Old
                                                price</label><input type="number" class="form-control"
                                                id="form-product/old-price" name="gia" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Inventory</h2>
                                    </div>
                                    <div>
                                        <label for="form-product/quantity" class="form-label">
                                            Quantity</label>
                                        <input type="number" class="form-control" id="form-product/quantity"
                                            name="soluong" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sa-entity-layout__sidebar">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Images</h2>
                                    </div>
                                </div>
                                <div class="mt-n5">
                                    <input type="file" class="form-controller" name="anhsp" required>
                                </div>
                            </div>
                            <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Categories</h2>
                                    </div>
                                    <select class="sa-select2 form-select " name="madm" required>
                                        <option value="-1">Chọn loại</option>
                                        @foreach($loai_arr as $dm)
                                            <option value="{{$dm->madm}}">
                                                {{$dm->tendm}}
                                            </option>
                                        @endforeach                                             
                                    </select>
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