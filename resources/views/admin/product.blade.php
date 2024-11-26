@extends('admin.layoutadmin')
@section('title')
Quản lý sản phẩm - TrendyU
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách sản phẩm</h4>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="user-list-files d-flex justify-content-end">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#new_product">
                           <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                        </button>
                     </div>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <div class="row justify-content-between">
                        <form id="searchForm" action="/admin/san-pham" method="GET">
                           <div class="row">
                              <div class="col-auto">
                                 <select id="trangthai" name="trangthai" class="form-select" aria-label="Default select example">
                                    <option value="all" {{$trangthai == "all" ? "selected" : ""}}>Tất cả</option>
                                    <option value="0" {{$trangthai == "0" ? "selected" : ""}}>Sản Phẩm Đang Kinh Doanh</option>
                                    <option value="1" {{$trangthai == "1" ? "selected" : ""}}>Sản Phẩm Sắp Hết Hàng</option>
                                    <option value="2" {{$trangthai == "2" ? "selected" : ""}}>Sản Phẩm Ngừng Kinh Doanh</option>
                                 </select>
                              </div>
                              <div class="col-auto">
                                 <select id="selLoai" name="id_dm" class="form-select" aria-label="Default select example">
                                    <option value="all" selected>Lọc theo danh mục</option>
                                    @foreach ($loai_arr as $loai)
                                          <option value="{{$loai->id}}" {{$loai->id == $id_dm ? "selected" : ""}}>{{$loai->ten_dm}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-auto">
                                 <input type="text" id="keyword" name="keyword" class="form-control" value="{{ request()->query('keyword') }}" placeholder="Nhập từ khóa...">
                              </div>
                              <div class="col-auto">
                                 <button type="submit" class="btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                              </div>
                           </div>
                        </form>
                     </div>
                     <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                        <thead class="text-center">
                              <tr>
                                 <th>Ảnh</th>
                                 <th>Tên</th>
                                 <th>Màu</th>
                                 <th>Kích thước : Số lượng</th>
                                 <th>Hành động</th>
                              </tr>
                        </thead>
                        <tbody>
                           @foreach($sanpham_arr as $sp)
                              <tr>
                                 <td class="text-center">
                                    <img class="rounded img-fluid avatar-70" src="{{ asset('/uploads/product/' . $sp->hinh) }}" onerror="this.src='/imgnew/{{$sp->hinh}}'" alt="">
                                 </td>
                                 <td>{{$sp->ten_sp}}</td>
                                 <td>{{$sp -> color}}</td>
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
                                    <div class="d-flex justify-content-center">
                                       <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter{{$sp->id}}">
                                          Xem
                                       </button>
                                       <a class="btn btn-outline-primary me-2" href="{{route('san-pham.edit', $sp->id)}}">Sửa</a>
                                       @if ($sp -> trang_thai == 2)
                                       <form class="d-inline" action="{{ route('san-pham.show', $sp->id) }}" method="POST">
                                             @csrf
                                             <button type='submit' onclick="return confirm('Nếu hiện sản phẩm này thì danh mục cũng sẽ được hiện. Bạn có chắc muốn hiện sản phẩm này không ?')" class="btn btn-outline-success">
                                                Hiện
                                             </button>
                                       </form>
                                       @elseif ($sp -> trang_thai == 0)
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
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <div class="row align-items-center justify-content-between mt-3">
                     <div id="user-list-page-info" class="col-md-6">
                        <span>Hiển thị</span>
                     </div>
                     <div class="col-md-6 d-flex justify-content-end">
                        <!-- Phân trang -->
                        {{$sanpham_arr->links('pagination::bootstrap-5')}}
                        <!-- End phân trang -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@foreach($sanpham_arr as $sp)
   <div class="modal fade" id="exampleModalCenter{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle{{$sp->id}}" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle{{$sp->id}}">Chi tiết sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="accordion-body text-black">
               <div class="row">
                  <div class="col-6">
                        <img class="rounded img-fluid avatar-70" src="{{ asset('/uploads/product/' . $sp->hinh) }}" onerror="this.src='/imgnew/{{$sp->hinh}}'" alt="">
                  </div>
                  <div class="col-6">
                     <div class="danh-muc">
                        <label for="" class="fw-semibold">{{$sp -> ten_sp}}</label>
                     </div>
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
                        </label>
                     </div>
                  </div>
                  <div class="col-12">
                     <label for="" class="fw-semibold">Mô tả ngắn:</label>
                     <div class="motangan">
                        {{$sp -> mo_ta_ngan}}
                     </div>
                  </div>
                  <div class="col-12"> 
                     <label for="" class="fw-semibold">Kích thước và số lượng:</label>
                     <div class="size_soluong">
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
                  </div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
            <a id="continueButton" href="{{route('san-pham.edit', $sp->id)}}">
               <button type="button" class="btn btn-primary">Chỉnh sửa <i class="fa-solid fa-arrow-right fa-beat"></i></button>
            </a>
         </div>
      </div>
   </div>
   </div>
@endforeach

<!-- Modal hiện hộp thoại chọn loại sản phẩm -->
<div class="modal fade" id="new_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Chọn loại sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="selectLoai" name="selection" aria-label="Default select example" class="form-select">
                    <option value="giay">Giày</option>
                    <option value="ao">Áo</option>
                    <option value="quan">Quần</option>
                    <option value="phu-kien">Phụ kiện</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="redirectToProductPage()">Tiếp tục <i class="fa-solid fa-arrow-right fa-beat"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
   function redirectToProductPage() {
      var selectLoai = document.getElementById('selectLoai');
      var selectedValue = selectLoai.value;
      var url = new URL("/admin/san-pham/create", window.location.origin);
      url.searchParams.set('selection', selectedValue);
      window.location.href = url.toString();

      // Kiểm tra URL được tạo
      console.log('Redirecting to:', window.location.href);
   }
   function applyFilters() {
      const trangthai = document.getElementById('trangthai').value;
      const id_dm = document.getElementById('selLoai').value;
      const keyword = document.getElementById('keyword').value.trim();

      const params = new URLSearchParams();

      // Thiết lập giá trị cho trangthai nếu có
      if (trangthai && trangthai !== 'all') {
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
@endsection