@extends('admin.layoutadmin')
@section('title')
Quản trị Danh Mục
@endsection

@section('content')
<!-- sa-app__body -->
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
                    <h1 class="h3 m-0">Quản Lý Danh Mục</h1>
                </div>
                <div class="col-auto d-flex">
                    <a href="{{route('danh-muc.create')}}" class="btn btn-primary">Thêm Danh Mục</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <div class="sa-layout">
            <!-- <div class="sa-layout__backdrop" data-sa-layout-sidebar-close="">
                fdgkldfglk
            </div> -->
            <div class="sa-layout__content">
                <div class="row">
                    <div class="col-xl-6">
                        <select name="role" class="form-select" onchange="locLoai(this.value)">
                            <option value="All" selected>Loại Danh Mục</option>
                            @foreach ($loai_arr as $loai)
                                <option value="{{ $loai->slug }}" {{ $loai->slug == $slug ? "selected" : "" }}>
                                    {{ $loai->ten_loai }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6">
                        <select name="role" class="form-select" onchange="locAnHien(this.value)">
                            <option selected>Trạng thái</option>
                            <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Đang Hiện</option>
                            <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đang Ẩn</option>
                        </select>
                    </div>
                </div>
                <script>
                    function locLoai(slug) {
                        const params = new URLSearchParams(window.location.search);
                        params.set('slug', slug);
                        if (!params.has('trang_thai')) {
                            params.set('trang_thai', '0');
                        }
                        document.location = `/admin/danh-muc?${params.toString()}`;
                    }

                    function locAnHien(trangThai) {
                        const params = new URLSearchParams(window.location.search);
                        params.set('trang_thai', trangThai);
                        if (!params.has('slug')) {
                            params.set('slug', 'All');
                        }
                        document.location = `/admin/danh-muc?${params.toString()}`;
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
                                            <span class="badge bg-warning">{{ $dm->trang_thai == 0 ? 'Hiển thị' : 'Đã Ẩn' }}
                                            </span>
                                        </div>
                                    </td>
                                    <!-- Thao tác -->
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-outline-dark me-2"
                                                href="{{ route('danh-muc.edit', $dm->id) }}">Sửa</a>
                                            <!-- Nếu trạng thái bằng 0 thì cho ẩn -->
                                            @if($dm->trang_thai == 0)
                                                <form action="{{ route('danh-muc.hidden', $dm->id) }}" method="get">
                                                    <button class="btn btn-outline-warning me-2"
                                                        onclick="return confirm('Nếu bạn ẩn danh mục này. Các sản phẩm nằm trong danh mục này cũng sẽ bị ẩn')">Ẩn</button>
                                                </form>
                                            @endif
                                            <!-- Nếu trạng thái bằng 1 thì cho hiện -->
                                            @if($dm->trang_thai == 1)
                                                <form action="{{ route('danh-muc.show', $dm->id) }}" method="get">
                                                    <button class="btn btn-outline-success me-2"
                                                        onclick="return confirm('Nếu bạn hiện danh mục này. Các sản phẩm nằm trong danh mục này sẽ hiển thị')">Hiện</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('danh-muc.delete', $dm->id) }}" method="get">
                                                <button
                                                    onclick="return confirm('Bạn có chắc chắn muốn xoá danh mục này không?')"
                                                    class="btn btn-outline-danger">Xóa</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                          
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="text-center p-2 d-flex justify-content-center">{{$danhmuc_arr->links()}}</div>
            </div>
        </div>
    </div>
</div>
@endsection