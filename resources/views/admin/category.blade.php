@extends('admin.layoutadmin')
@section('title')
Quản lý danh mục - TrendyU
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách danh mục</h4>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="user-list-files d-flex justify-content-end">
                        <a href="{{route('danh-muc.create')}}" type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           <i class="fa-solid fa-plus"></i> Thêm danh mục mới
                        </a>
                     </div>
                  </div>
               </div>
               <div class="iq-card-body">
                     <div class="table-responsive">
                        <div class="row justify-content-between">
                           <form id="searchForm" action="/admin/san-pham" method="GET">
                                 <div class="row">
                                    <div class="col-auto">
                                       <select name="role" class="form-select" onchange="locLoai(this.value)">
                                             <option value="All" selected>Loại Danh Mục</option>
                                             @foreach ($loai_arr as $loai)
                                                <option value="{{ $loai->slug }}" {{ $loai->slug == $slug ? "selected" : "" }}>
                                                   {{ $loai->ten_loai }}
                                                </option>
                                             @endforeach
                                       </select>
                                    </div>
                                    <div class="col-auto">
                                       <select name="role" class="form-select" onchange="locAnHien(this.value)">
                                             <option selected>Trạng thái</option>
                                             <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Đang Hiện</option>
                                             <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đang Ẩn</option>
                                       </select>
                                    </div>
                                    <!-- <div class="col-auto">
                                       <input type="text" id="keyword" name="keyword" class="form-control" value="{{ request()->query('keyword') }}" placeholder="Nhập từ khóa...">
                                    </div>
                                    <div class="col-auto">
                                       <button type="submit" class="btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div> -->
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
                           </form>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead class="text-center">
                                 <tr>
                                    <th>ID danh mục</th>
                                    <th>Loại</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                 </tr>
                           </thead>
                           <tbody>
                                 @foreach($danhmuc_arr as $dm)
                                 <tr>
                                    <td>ID: {{$dm->id}}</td>
                                    <td>{{ $dm->ten_loai }}</td>
                                    <td>{{$dm->ten_dm}}</td>
                                    <td>{{$dm->slug}}</td>
                                    <td>
                                       <div class="d-flex justify-content-center">
                                             <span class="btn {{ $dm->trang_thai == 0 ? 'btn-success' : 'btn-danger' }}">
                                                {{ $dm->trang_thai == 0 ? 'Hiển thị' : 'Đã Ẩn' }}
                                             </span>
                                       </div>
                                    </td>
                                    <td>
                                       <div class="d-flex justify-content-center">
                                          <a href="{{ route('danh-muc.update', $dm->id) }}" type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#updateCategoryModal{{ $dm->id }}">
                                             Sửa
                                          </a>
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
                  <div class="row align-items-center justify-content-between mt-3">
                     <div id="user-list-page-info" class="col-md-6">
                        <span>Hiển thị</span>
                     </div>
                     <div class="col-md-6 d-flex justify-content-end">
                        <!-- Phân trang -->
                        {{$danhmuc_arr->links('pagination::bootstrap-5')}}
                        <!-- End phân trang -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal hiện hộp thoại thêm danh mục -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm danh mục mới</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('danh-muc.store')}}" method="post" enctype="multipart/form-data" style="height: 100%;" >
            @csrf
               <div class="modal-body">
                     <div class="form-group mb-3">
                        <label for="form-product/short-description" class="form-label fw-semibold">Tên danh mục</label>
                        <input type="text" value="{{old(key: 'ten_dm')}}" name="ten_dm" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label fw-semibold">Chọn loại</label>
                        <select class="sa-select2 form-select " name="id_loai" required>
                           <option value="0">Chọn loại</option>
                           @foreach($loai_arr as $loai)
                           <option value="{{ $loai->id }}">
                                 {{$loai->ten_loai}}
                           </option>
                           @endforeach
                        </select>
                     </div>
               </div>
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <a id="continueButton" href="#">
                     <input type="submit" class="btn btn-primary" name="submit" value="Lưu">
                     </a>
               </div>
            </form>
            <script>
                  document.getElementById('continueButton').addEventListener('click', function() {
                     var selectedValue = document.getElementById('selectLoai').value;
                     this.href = "{{ route('san-pham.create') }}?selection=" + selectedValue;
                  });
            </script>
         </div>
   </div>
</div>
<!-- Modal cập nhật danh mục -->
@foreach($danhmuc_arr as $dm)
<div class="modal fade" id="updateCategoryModal{{ $dm->id }}" tabindex="-1" aria-labelledby="updateCategoryModalLabel{{ $dm->id }}" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="updateCategoryModalLabel{{ $dm->id }}">Cập Nhật Danh Mục</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('danh-muc.update', $dm->id) }}" method="POST">
               @csrf
               @method('PUT')
               <div class="modal-body">
                     <div class="form-group mb-3">
                        <label for="form-product/short-description" class="form-label fw-semibold">Tên danh mục</label>
                        <input type="text" value="{{ $dm->ten_dm }}" name="ten_dm" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="" class="form-label fw-semibold">Chọn loại</label>
                        <select class="sa-select2 form-select " name="id_loai" required>
                           <option value="0">Chọn loại</option>
                           @foreach($loai_arr as $loai)
                           <option value="{{ $loai->id }}" {{ $dm->id_loai == $loai->id ? 'selected' : '' }}>
                                 {{ $loai->ten_loai }}
                           </option>
                           @endforeach
                        </select>
                     </div>
               </div>
               <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                     <a id="continueButton" href="#">
                     <input type="submit" class="btn btn-primary" name="submit" value="Lưu">
                     </a>
               </div>
            </form>
         </div>
   </div>
</div>
@endforeach
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
@endsection