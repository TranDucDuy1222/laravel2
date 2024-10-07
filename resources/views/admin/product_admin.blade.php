@extends('admin.layoutadmin')
@section('title')
Quản Trị Sản Phẩm
@endsection

@section('content')
<!-- sa-app__body -->
<div id="top" class="sa-app__body">
    <div class="mx-xxl-3 px-4 px-sm-5">
        <div class="py-5">
            <div class="row g-4 align-items-center">
                <div class="col">
                    <h1 class="h3 m-0">Sản phẩm</h1>
                </div>
                <div class="col-auto d-flex">
                    <a href="{{route('san-pham.create')}}" class="btn btn-primary">Thêm sản phẩm</a>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <div class="sa-layout">
            <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
            <div class="sa-layout__content">
                @if(session()->has('thongbao'))
                <div class="alert alert-danger p-3 fs-5 text-center">
                    {!! session('thongbao') !!}
                </div>
                @endif
                <!-- Lọc theo trạng thái -->
                <select id="trangthai" class="form-select" aria-label="Default select example" style="height: 50px;"
                    onchange="loctrangthai(this.value)">
                    <option value="0" {{$trangthai == "0" ? "selected" : ""}}>Sản Phẩm Đang Kinh Doanh</option>
                    <option value="1" {{$trangthai == "1" ? "selected" : ""}}>Sản Phẩm Sắp Hết Hàng</option>
                    <option value="2" {{$trangthai == "2" ? "selected" : ""}}>Sản Phẩm Ngừng Kinh Doanh</option>
                    <option value="3" {{$trangthai == "3" ? "selected" : ""}}>Sản Phẩm Sắp Về Hàng</option>
                </select>
                <!--Lọc trạng thái bằng JS-->
                <script>
                    function loctrangthai(tt) {
                        document.location = `/admin/san-pham?trangthai=${tt}`;
                    }
                </script>

                <br>
                <!-- Lọc theo danh mục -->
                <tr>
                    <td colspan="6">
                        <select id="selLoai" aria-label="Default select example" class="form-select"
                            onchange="locsp(this.value)">
                            <option value="-1" selected>Lọc theo danh mục</option>
                            @foreach ($loai_arr as $loai)
                            <option value="{{$loai->id}}" {{$loai->id == $id_dm ? "selected":""}}>
                                {{$loai->ten_dm}}
                            </option>
                            @endforeach
                        </select>
                        <script>
                            function locsp(id_dm) {
                                document.location = `/admin/san-pham?id_dm=${id_dm}`;
                            }
                        </script>
                    </td>
                </tr>
                <br>
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <!-- <th class="w-min">
                                    <input type="checkbox"
                                        class="form-check-input m-0 fs-exact-16 d-block" />
                                </th> -->
                                <th style="width: 30%;">Sản phẩm</th>
                                <th style="width: 60%;">Kích cỡ : Số lượng</th>
                                <!-- <th>Quanlity</th>
                                <th>Price</th>
                                <th>Sale Price</th>
                                <th>Status</th>
                                <th class="w-min"></th> -->
                                <th style="width: 10%;"></th>
                            </tr>

                        </thead>
                        <tbody>

                            @foreach($sanpham_arr as $sp)
                            <div class="accordion" id="accordionExample">

                                <div class="accordion-item">
                                    <tr>
                                        <td>
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$sp->id}}" aria-expanded="false" aria-controls="collapse{{$sp->id}}">
                                                    <a href="app-product.html" class="me-4">
                                                        <div
                                                            class="">
                                                            <img src="/imgnew/{{$sp->hinh}}" width="60"
                                                                height="50" onerror="this.src='/img/{{$sp->hinh}}'" alt="" />
                                                        </div>
                                                    </a>
                                                    <div>
                                                        <a href="app-product.html" class="text-reset">{{$sp->ten_sp}}</a>
                                                        <div class="sa-meta mt-0">
                                                            <ul class="sa-meta__list">
                                                                <li class="sa-meta__item">ID:
                                                                    <span title="Click to copy product ID"
                                                                        class="st-copy">{{$sp->id}}</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapse{{$sp->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                                <div class="accordion-body text-black">
                                                    <div class="danh-muc">
                                                        <label for="">Danh mục: {{$sp -> ten_dm}}</label>
                                                    </div>
                                                    <div class="mau">
                                                        <label for="">Màu: {{$sp -> color}}</label>
                                                    </div>
                                                    <div class="gia">
                                                        <label for="">Giá: <span class="text-bg-dark">{{number_format($sp->gia, 0, ',' , '.' )}} đ</span></label>
                                                    </div>
                                                    <div class="gia-km">
                                                        <label for="">Giá khuyến mãi: <span class="text-danger">{{number_format($sp->gia_km, 0, ',' , '.' )}} đ</span></label>
                                                    </div>
                                                    <div class="trang-thai">
                                                        <label for="">Trạng thái:
                                                            @if ($sp -> trang_thai == 0)
                                                            Còn hàng
                                                            @endif
                                                            @if ($sp -> trang_thai == 1)
                                                            Sắp hết hàng
                                                            @endif
                                                            @if ($sp -> trang_thai == 2)
                                                            Hết hàng
                                                            @endif
                                                            @if ($sp -> trang_thai == 3)
                                                            Sắp về hàng
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="">
                                                @php
                                                $hasSize = false;
                                                @endphp

                                                @foreach ($size_arr as $size)
                                                @if ($size->id_product == $sp->id)
                                                <button class="btn btn-outline-dark mb-1">{{$size->size_product}} : {{$size->so_luong}}</button>
                                                @php
                                                $hasSize = true;
                                                @endphp
                                                @endif
                                                @endforeach

                                                @if (!$hasSize)
                                                <button class="btn btn-outline-dark mb-1">0 : 0</button>
                                                @endif
                                            </div>


                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-outline-dark me-2" href="{{route('san-pham.edit', $sp->id)}}">Chỉnh</a>
                                                @if ($sp -> an_hien)
                                                <form class="d-inline" action="{{ route('san-pham.show', $sp->id) }}" method="POST">
                                                    @csrf
                                                    <button type='submit' onclick="return confirm('Bạn có chắc muốn hiện sản phẩm này không ?')" class="btn btn-outline-success">
                                                        Hiện
                                                    </button>
                                                </form>
                                                @else
                                                <form class="d-inline" action="{{ route('san-pham.hide', $sp->id) }}" method="POST">
                                                    @csrf
                                                    <button type='submit' onclick="return confirm('Bạn có chắc muốn ẩn sản phẩm này không ?')" class="btn btn-outline-danger">
                                                        Ẩn
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </div>
                                <!-- <td>
                                        <input type="checkbox" class="form-check-input my-4 fs-exact-16 d-block"
                                            aria-label="..." />
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="app-product.html" class="me-4">
                                                <div
                                                    class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                                    <img src="/imgnew/{{$sp->hinh}}" width="40"
                                                        height="40" onerror="this.src='/img/{{$sp->hinh}}'" alt="" />
                                                </div>
                                            </a>
                                            <div>
                                                <a href="app-product.html" class="text-reset">{{$sp->ten_sp}}</a>
                                                <div class="sa-meta mt-0">
                                                    <ul class="sa-meta__list">
                                                        <li class="sa-meta__item">ID:
                                                            <span title="Click to copy product ID"
                                                                class="st-copy">{{$sp->id}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-reset">
                                             {{$sp->ten_dm}}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="badge badge-sa-success"></div>
                                    </td>
                                    <td>
                                        <div class="sa-price">
                                            
                                                <span class="sa-price__integer">{{number_format($sp->gia, 0, ',' , '.' )}} đ</span>
                                                <span class="sa-price__symbol"></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="sa-price">
                                            
                                                <span class="sa-price__integer">{{number_format($sp->gia_km, 0, ',' , '.' )}} đ</span>
                                                <span class="sa-price__symbol"></span>
                                        </div>
                                    </td>
                                    <td>
                                            
                                            @if($sp->trangthai==1)
                                                <div type="button" class="badge badge-sa-success" id="form-product/quantity" name="trangthai">Stocking</div>
                                            @elseif($sp->trangthai==2)
                                                <div type="button" class="badge badge-sa-success" id="form-product/quantity" name="trangthai">Out of stock</div>
                                            
                                            @elseif($sp->trangthai==3)
                                                <div class="badge badge-sa-danger" role="alert">Stop selling</div>
                                            @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-outline-dark me-2" href="{{route('san-pham.edit', $sp->id)}}">Edit</a>
                                            <form class="d-inline" action="{{ route('san-pham.destroy', $sp->id) }}" method="POST">
                                                @method('DELETE')
                                                <button type='submit' onclick="return confirm('Bạn có chắc muốn ẩn sản phẩm này không!')" class="btn btn-outline-danger">
                                                    Ẩn
                                                </button>
                                                @csrf
                                            </form>
                                        </div>
                                    </td> -->
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    <!--Phân trang-->
                    <div class="text-center p-2 d-flex">{{$sanpham_arr->links()}}</div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- sa-app__body / end -->
<!-- <script>
    function deleteProduct(id){
        var kq = confirm("Are you sure you want to delete this product?");
        if(kq){
            window.location.search='?mod=product&act=delete&id='+id; 
        }
    }
    </script> -->
@endsection