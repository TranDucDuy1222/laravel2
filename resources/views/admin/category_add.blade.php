@extends('admin.layoutadmin')
@section('title')
Thêm danh mục
@endsection

@section('content')
<form action="{{route('danh-muc.store')}}" method="post" enctype="multipart/form-data" style="height: 100%;" >
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Thêm danh mục</h1>
                        </div>
                        <div class="col-auto d-flex">
                            <input type="submit" class="btn btn-primary" name="submit" value="Lưu">
                        </div>
                    </div>
                    
                </div>
                <div class="sa-entity-layout"
                    data-sa-container-query="{&quot;920&quot;:&quot;sa-entity-layout--size--md&quot;,&quot;1100&quot;:&quot;sa-entity-layout--size--lg&quot;}">
                    <div class="sa-entity-layout__body">
                        <div class="sa-entity-layout__main">
                            <div class="card">
                                <div class="card-body p-5">
                                    <div class="mb-4">
                                        <h5 for="form-product/short-description">Tên danh mục</h5>
                                        <input type="text" value="{{old(key: 'ten_dm')}}" name="ten_dm" class="form-control" required>
                                    </div>
                                    <div>
                                        <h5>Chọn loại</h5>
                                        <select class="sa-select2 form-select " name="id_loai" required>
                                            <option value="0">Chọn loại</option>
                                            @foreach($loai_arr as $loai)
                                            <option value="{{ $loai->id }}">
                                                {{$loai->ten_loai}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('id_loai')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @csrf
    <!-- sa-app__body / end -->
</form>
@endsection