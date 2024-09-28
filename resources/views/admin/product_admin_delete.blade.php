@extends('admin.layoutadmin')
@section('title')
    Sản Phẩm Đã Ẩn
@endsection

@section('content')
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body">
        <div class="mx-xxl-3 px-4 px-sm-5">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Products</h1>
                    </div>
                    <div class="col-auto d-flex">
                        <a href="admin.php?mod=product&act=add" class="btn btn-primary">New product</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
            <div class="sa-layout">
                <div class="sa-layout__backdrop" data-sa-layout-sidebar-close=""></div>
                <div class="sa-layout__content">
                    <select id="trangthai" class="form-select" aria-label="Default select example" style="height: 50px;" onchange="loctrangthai(this.value)">
                            <option selected value="1" value="1" {{$trangthai == "1"? "selected":""}}>Sản Phẩm Đang Kinh Doanh</option>
                            <option value="2" {{$trangthai == "2"? "selected":""}}>Sản Phẩm Sắp Hết Hàng</option>
                            <option value="3" {{$trangthai == "3"? "selected":""}}>Sản Phẩm Ngừng Kinh Doanh</option>
                    </select>
                    <script>
                    function loctrangthai(tt){
                        document.location=`/admin/san-pham?trangthai=${tt}`;
                    }
                    </script>
                    <br>
                    <tr>
                        <td colspan="6">
                            <select id="selLoai" aria-label="Default select example" class="form-select" onchange="locsp(this.value)" >
                                <option value="-1" selected>Lọc theo NSX</option>
                                @foreach ($loai_arr as $loai)
                                <option value="{{$loai->madm}}" {{$loai->madm == $id_loai? "selected":""}} >
                                    {{$loai->tendm}}
                                </option>
                                @endforeach
                            </select>
                            <script>
                            function locsp(id_loai) {
                                document.location=`/admin/sanpham?id_loai=${id_loai}`;
                            }
                            </script>
                        </td>
                    </tr>
                    <br>
                    <div class="card table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="w-min">
                                        <input type="checkbox"
                                            class="form-check-input m-0 fs-exact-16 d-block" />
                                    </th>
                                    <th class="min-w-20x">Product</th>
                                    <th>Category</th>
                                    <th>Quanlity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th class="w-min"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sanpham_arr as $sp)  
                                    <tr>
                                    <td><input type="checkbox" class="form-check-input my-4 fs-exact-16 d-block"
                                            aria-label="..." /></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="app-product.html" class="me-4">
                                                <div
                                                    class="sa-symbol sa-symbol--shape--rounded sa-symbol--size--lg">
                                                    <img src="/imgnew/{{$sp->anhsp}}" width="40"
                                                        height="40" onerror="this.src='/img/{{$sp->anhsp}}'" alt="" />
                                                </div>
                                            </a>
                                            <div>
                                                <a href="app-product.html" class="text-reset">{{$sp->tensp}}</a>
                                                <div class="sa-meta mt-0">
                                                    <ul class="sa-meta__list">
                                                        <li class="sa-meta__item">ID:
                                                            <span title="Click to copy product ID"
                                                                class="st-copy">{{$sp->masp}}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-reset">
                                             {{$sp->tendm}}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="badge badge-sa-success">{{$sp->soluong}}</div>
                                    </td>
                                    <td>
                                        <div class="sa-price">
                                            
                                                <span class="sa-price__integer">{{number_format($sp->gia, 0, ',' , '.' )}} đ</span>
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
                                            <a href="san-pham/khoi-phuc/{{ $sp->masp }}" class="btn btn-outline-dark me-2">Khôi phục</a>
                                            <a href="san-pham/xoa-vinh-vien/{{$sp->masp}}" class="btn btn-outline-danger " onclick="return confirm('Xác nhận Xóa vĩnh viễn?')">Xóa vĩnh viễn</a>
                                        </div>  
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center p-2 d-flex justify-content-center">{{$sanpham_arr->links()}}</div>
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