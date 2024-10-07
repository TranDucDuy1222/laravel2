@extends('admin.layoutadmin')
@section('title')
Sửa Danh Mục
@endsection

@section('content')
<form action="{{route('danh-muc.update', $danhMuc->id)}}" method="post" enctype="multipart/form-data" style="height: 100%;" >
@method('PUT')
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <div class="mx-sm-2 px-2 px-sm-3 px-xxl-4 pb-6">
            <div class="container">
                <div class="py-5">
                    <div class="row g-4 align-items-center">
                        <div class="col">
                            <h1 class="h3 m-0">Chỉnh sửa danh mục</h1>
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
                                    <div>
                                        <h5 for="form-product/short-description" >Tên danh mục</h5>
                                        <input type="text" value="{{$danhMuc->ten_dm}}" name="ten_dm" class="form-control" required>
                                    </div>
                                    @if ($errors->has('ten_dm'))
                                        <div class="alert alert-danger mt-2">
                                            {{ $errors->first('ten_dm') }}
                                        </div>
                                    @endif
                                    <br>
                                    <div>
                                        <h5>Loại của danh mục hiện tại</h5>
                                        <select class="sa-select2 form-select " name="id_loai" required>
                                            <option value="0">Chọn loại</option>
                                            @foreach($loai_arr as $loai)
                                            <option value="{{ $loai->id }}" {{ $loai->id == $danhMuc->id_loai? "selected":"" }}>
                                                {{$loai->ten_loai}}
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
    </div>
    @csrf
    <!-- sa-app__body / end -->
</form>
@endsection