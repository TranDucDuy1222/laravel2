@extends('admin.layoutadmin')
@section('title')
Quản Trị Sản Phẩm
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
                    <h1 class="h3 m-0">Sản phẩm</h1>
                </div>
                <div class="col-auto d-flex">
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Thêm sản phẩm
                    </button>
                    <!-- <a href="{{route('san-pham.create')}}" class="btn btn-primary">Thêm sản phẩm</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Modal hiện hộp thoại chọn loại sản phẩm -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Chọn loại sản phẩm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select id="selectLoai" aria-label="Default select example" class="form-select">
                        <option value="giay">Giày</option>
                        <option value="ao">Áo</option>
                        <option value="quan">Quần</option>
                        <option value="pk">Phụ kiện</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="continueButton" href="#">
                        <button type="button" class="btn btn-primary">Tiếp tục <i class="fa-solid fa-arrow-right fa-beat"></i></button>
                    </a>
                </div>
                <script>
                    document.getElementById('continueButton').addEventListener('click', function() {
                        var selectedValue = document.getElementById('selectLoai').value;
                        this.href = "{{ route('san-pham.create') }}?selection=" + selectedValue;
                    });
                </script>
            </div>
        </div>
    </div>
    <!-- End Modal hiện hộp thoại chọn loại sản phẩm -->
    <div class="mx-xxl-3 px-4 px-sm-5 pb-6">
        <div class="sa-layout">
            <div class="sa-layout__content">
            <form id="searchForm" action="/admin/san-pham" method="GET">
                    <div class="row">
                        <div class="col-4">
                            <!-- Lọc theo trạng thái -->    
                            <select id="trangthai" name="trangthai" class="form-select" aria-label="Default select example" style="height: 50px;">
                                <option value="0" {{$trangthai == "0" ? "selected" : ""}}>Sản Phẩm Đang Kinh Doanh</option>
                                <option value="1" {{$trangthai == "1" ? "selected" : ""}}>Sản Phẩm Sắp Hết Hàng</option>
                                <option value="2" {{$trangthai == "2" ? "selected" : ""}}>Sản Phẩm Ngừng Kinh Doanh</option>
                                <option value="3" {{$trangthai == "3" ? "selected" : ""}}>Sản Phẩm Sắp Về Hàng</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <!-- Lọc theo danh mục -->
                            <select id="selLoai" name="id_dm" class="form-select" aria-label="Default select example" style="height: 50px;">
                                <option value="all" selected>Lọc theo danh mục</option>
                                @foreach ($loai_arr as $loai)
                                    <option value="{{$loai->id}}" {{$loai->id == $id_dm ? "selected" : ""}}>{{$loai->ten_dm}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <!-- Tìm kiếm theo từ khóa -->
                            <input type="text" id="keyword" name="keyword" class="form-control h-100" value="{{ request()->query('keyword') }}" placeholder="Nhập từ khóa...">
                        </div>
                    </div>
                    <div class="mt-2 d-flex justify-content-end align-content-end ">
                        <button type="submit" class="btn btn-outline-success">Lọc tất cả</button>
                    </div>
            </form>
<script>
    function applyFilters() {
        const trangthai = document.getElementById('trangthai').value;
        const id_dm = document.getElementById('selLoai').value;
        const keyword = document.getElementById('keyword').value.trim();

        const params = new URLSearchParams();

        // Thiết lập giá trị cho trangthai nếu có
        if (trangthai && trangthai !== '0') {
            params.set('trangthai', trangthai);
        }

        // Thiết lập giá trị cho id_dm nếu có
        if (id_dm && id_dm !== 'all') {
            params.set('id_dm', id_dm);
        }

        // Thiết lập giá trị cho keyword nếu có
        if (keyword && keyword !== 'all') {
            params.set('keyword', keyword);
        }

        // Chuyển hướng đến URL mới với các tham số đã thiết lập
        document.location = `/admin/san-pham?${params.toString()}`;
    }

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định của form
        applyFilters(); // Gọi hàm applyFilters để gửi yêu cầu
    });
</script>


                <br>
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 30%;">Sản phẩm</th>
                                <th style="width: 60%;">Kích cỡ : Số lượng</th>
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
                                                        <div class="">
                                                            <img src="{{ asset('/uploads/product/' . $sp->hinh) }}" width="60"
                                                                height="50" onerror="this.src='/imgnew/{{$sp->hinh}}'" alt="" />
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
                                                            Ngừng kinh doanh
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
                                                @if ($sp -> trang_thai == 2)
                                                <form class="d-inline" action="{{ route('san-pham.show', $sp->id) }}" method="POST">
                                                    @csrf
                                                    <button type='submit' onclick="return confirm('Nếu hiện sản phẩm này thì danh mục cũng sẽ được hiện. Bạn có chắc muốn hiện sản phẩm này không ?')" class="btn btn-outline-success">
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