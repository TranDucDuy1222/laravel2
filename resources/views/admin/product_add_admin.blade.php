@extends('admin.layoutadmin')
@section('title')
Thêm Sản Phẩm
@endsection

@section('content')
<form action="{{route('san-pham.store')}}" method="post" enctype="multipart/form-data">
    <!-- sa-app__body -->
    @csrf
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
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Basic information</h2>
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/name" class="form-label">Tên</label>
                                        <input value="{{old('ten_sp')}}" type="text" class="form-control" id="form-product/name" name="ten_sp" required />
                                    </div>
                                    <div class="mb-4">
                                        <label for="form-product/description" class="form-label">Mô tả</label>
                                        <textarea id="description" class="form-control" rows="8" name="mo_ta_ct" required>{{old('mo_ta_ct')}}</textarea>
                                    </div>
                                    <div>
                                        <label for="form-product/short-description" class="form-label">Mô tả ngắn</label>
                                        <textarea id="form-product/short-description" class="form-control" rows="4" name="mo_ta_ngan" required>{{old('mo_ta_ngan')}}</textarea>
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
                                            <input value="{{old('gia_km')}}" type="number" class="form-control" id="form-product/price" name="gia_km" />
                                            @error('gia_km')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <label for="form-product/old-price" class="form-label">Giá cũ</label>
                                            <input value="{{old('gia')}}" type="number" class="form-control" id="form-product/old-price" name="gia" required />
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
                                    @if(session('selected_option') == 'giay')
                                        <div class="row g-4">
                                            @if ($errors->has('so_luong'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('so_luong') }}
                                            </div>
                                            @endif
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="37" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="38.5" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="39" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="39.5" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="40" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="40.5" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="41" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="41.5" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="42" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="42.5" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input readonly value="43" class="form-control" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />

                                            </div>
                                        </div>
                                    @elseif(session('selected_option') == 'ao' || session('selected_option') == 'quan' || session('selected_option') == 'pk')
                                        <!-- Hiển thị bảng chọn size bằng chữ -->
                                        <div class="row g-4">
                                            @if ($errors->has('so_luong'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('so_luong') }}
                                            </div>
                                            @endif
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input class="form-control" readonly value="S" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />
                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input readonly value="M" class="form-control" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />
                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input readonly value="X" class="form-control" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />
                                            </div>
                                        </div>
                                        <div class="row g-4">
                                            <div class="col">
                                                <label for="form-product/size" class="form-label">Kích thước</label>
                                                <input readonly value="XL" class="form-control" name="size_product[]" />
                                            </div>
                                            <div class="col">
                                                <label for="form-product/quantity" class="form-label">Số lượng</label>
                                                <input value="  {{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required />
                                            </div>
                                        </div>
                                    @endif
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
                                    <input value="{{old('hinh')}}" name="hinh" type="file" class="form-controller" required>
                                </div>
                            </div>
                            <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Danh Mục</h2>
                                    </div>
                                    <select class="sa-select2 form-select " name="id_dm" required>
                                        <option value="0">Chọn danh mục</option>
                                        @foreach($loai_arr as $dm)
                                        <option value="{{ $dm->id }}" {{ old('id_dm') == $dm->id ? 'selected' : '' }}>
                                            {{$dm->ten_dm}}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_dm')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                </div>
                            </div>
                            <div class="card w-100 mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Trạng Thái</h2>
                                    </div>
                                    <select class="sa-select2 form-select " name="trang_thai" required>
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
                            <div class="card mt-5">
                                <div class="card-body p-5">
                                    <div class="mb-5">
                                        <h2 class="mb-0 fs-exact-18">Màu</h2>
                                    </div>
                                    <div class="row g-4">
                                        <div class="col">
                                            <input type="text" class="form-control" value="{{old('color')}}" id="" name="color" required />
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
<style>
.ck-editor__editable_inline {
    height: 400px;
}
</style>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/translations/vi.js"> </script>
    <script src="{{asset('FE/ckfinder/ckfinder.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            ClassicEditor
                .create(document.querySelector('#description'), {
                    language: 'vi'
                })
                .then(editor => {
                    console.log(editor);
                    console.log("create");
                })
                .catch(error => {
                    console.error(error);
                    console.log("Failed to create");
                });
        });
        function openPopup(idobj) {
            CKFinder.popup( {
                chooseFiles: true,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        document.getElementById( idobj ).value = file.getUrl();
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        document.getElementById( idobj ).value = evt.data.resizedUrl;
                    } );
                }
            } );
        }

    </script>

@endsection