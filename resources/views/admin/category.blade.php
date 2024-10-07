@extends('admin.layoutadmin')
@section('title')
Danh Mục
@endsection

@section('content')
<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="mx-xxl-3 px-4 px-sm-5">
        <div class="py-5">
            <div class="row g-4 align-items-center">
                <div class="col">
                    <h1 class="h3 m-0">Quản Lý Danh Mục</h1>
                </div>
                <div class="col-auto d-flex">
                    <a href="" class="btn btn-primary">Thêm Danh Mục</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <div class="sa-layout">
            <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
            <div class="sa-layout__content">
                <select name="role" class="form-select" onchange="locLoai(this.value)">
                    <option value="All" selected>Loại Danh Mục</option>
                    @foreach ($loai_arr as $loai)
                        <option value="{{ $loai->slug }}" {{ $loai->slug == $slug ? "selected" : "" }}>
                            {{ $loai->ten_loai }} </option>
                    @endforeach
                </select>
                <script>
                    function locLoai(slug) {
                        document.location = `/admin/danh-muc?slug=${slug}`;
                    }
                </script>

                <br>
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="w-min">
                                    <input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block" />
                                </th>
                                <th style="width: 8%;">ID danh mục</th>
                                <th>Loại</th>
                                <th>Tên danh mục</th>
                                <th>Slug</th>
                                <th>Trạng thái</th>
                                <th class="w-min">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhmuc_arr as $dm)  
                                <tr>
                                    <!-- Checkbox -->
                                    <td><input type="checkbox" class="form-check-input m-0 fs-exact-16 d-block"
                                            aria-label="..." />
                                    </td>
                                    <!-- ID danh mục -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="app-product.html" class="me-4">
                                                <div>
                                                    <div class="sa-meta mt-0">
                                                        <ul class="sa-meta__list">
                                                            <li class="sa-meta__item">ID:
                                                                <span title="Click to copy product ID"
                                                                    class="st-copy">{{$dm->id}}</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                        </div>
                                    </td>
                                    <!-- Loại -->
                                    <td>
                                        <span class="">
                                            {{ $dm->ten_loai }}
                                        </span>
                                    </td>
                                    <!-- Tên danh mục -->
                                    <td>
                                        <a href="" class="text-reset">{{$dm->ten_dm}}</a>
                                    </td>
                                    <!-- Slug -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <p>{{$dm->slug}}</p>
                                        </div>
                                    </td>
                                    <!-- Trạng thái -->
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="badge bg-warning">{{ $dm->trang_thai == 0 ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                        </div>
                                    </td>
                                    <!-- Thao tác -->
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-outline-dark me-2" href="">Sửa</a>
                                            <a class="btn btn-outline-warning me-2" href="">Ẩn</a>
                                            <a class="btn btn-outline-danger" href="">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <div class="text-center p-2">{{$danhmuc_arr->links()}}</div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection