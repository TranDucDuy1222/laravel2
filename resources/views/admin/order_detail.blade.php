@extends('admin.layoutadmin')
@section('title')
Đơn hàng
@endsection
@section('content')

<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Chi Tiết Đơn Hàng #{{ $donHang->id }}</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                     <div class="table-responsive">
                        <div class="card-body">
                           <p><strong>Người Mua:</strong> {{ $donHang->user->name }}</p>
                           <p><strong>Địa Chỉ:</strong> {{ $donHang->diaChi->ho_ten ?? "NULL"}} | {{ $donHang->diaChi->phone ?? "NULL"}} | {{ $donHang->diaChi->dc_chi_tiet ?? "NULL"}} , {{ $donHang->diaChi->qh ?? "NULL"}} , {{ $donHang->diaChi->thanh_pho ?? "NULL"}}</p>
                           <p><strong>Thời Điểm Mua:</strong> {{ \Carbon\Carbon::parse($donHang->thoi_diem_mua_hang)->format('d/m/Y H:i') }}</p>
                           <p><strong>Tổng Tiền:</strong> {{ number_format($donHang->tong_dh, 0, ',', '.') }} VND</p>
                           <p><strong>Phương Thức Thanh Toán:</strong> {{ $donHang->pttt }}</p>
                           <p><strong>Trạng Thái:</strong>
                              @if ($donHang->trang_thai == 0)
                                 <span class="btn bg-warning">Chờ xử lý</span>
                              @elseif ($donHang->trang_thai == 1)
                                 <span class="btn bg-primary">Đã xử lý</span>
                              @elseif ($donHang->trang_thai == 2)
                                 <span class="btn bg-info">Đã giao cho đơn vị vận chuyển</span>
                              @elseif ($donHang->trang_thai == 3)
                                 <span class="btn bg-success">Giao hàng thành công</span>
                              @elseif ($donHang->trang_thai == 4)
                                 <span class="btn bg-danger">Đã hủy</span>
                              @endif
                           </p>
                           <!-- Form cập nhật trạng thái -->
                           <form action="{{ route('don-hang.update-trang-thai', $donHang->id) }}" method="POST">
                                 @csrf
                                 @method('PUT')
                                 <label for="trang_thai" class="mb-3"><strong>Thay Đổi Trạng Thái:</strong></label>
                                 <div class="row">
                                    <div class="col-md-2 mb-3" >
                                       <select name="trang_thai" id="trang_thai" class="form-control">
                                          <option value="1" {{ $donHang->trang_thai == '1' ? 'selected' : '' }}>Đã xử lý</option>
                                          <option value="2" {{ $donHang->trang_thai == '2' ? 'selected' : '' }}>Đã giao cho đơn vị vận chuyển</option>
                                          <option value="3" {{ $donHang->trang_thai == '3' ? 'selected' : '' }}>Giao hàng thành công</option>
                                       </select>
                                    </div>
                                    <div class="col-md-2 mb-3" >
                                       <button type="submit" class="btn btn-outline-primary">Cập Nhật</button>
                                    </div>
                                 </div>
                           </form>
                        </div>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid">
         <div class="row">
            <div class="col-sm-12">
               <div class="iq-card">
                  <div class="iq-card-header row py-4">
                     <div class="iq-header-title col-sm-12 col-md-6">
                        <h4 class="card-title">Sản Phẩm Đã Mua</h4>
                     </div>
                  </div>
                  <div class="iq-card-body">
                     <div class="table-responsive">
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead class="text-center">
                                 <tr>
                                    <th>Mã Sản Phẩm</th>
                                    <th>Hình Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Size</th>
                                    <th>Giá</th>
                                    <th>Tổng Giá</th>
                                 </tr>
                           </thead>
                           <tbody>
                                 @if($donHang->chiTietDonHangs->isNotEmpty())
                                 @foreach($donHang->chiTietDonHangs as $ct)
                                    <tr>
                                        <td>{{ $ct->id_sp }}</td>
                                        
                                        <td>
                                            <img src="{{ asset('/uploads/product/' . $ct->sanPham->hinh) }}" alt="{{ $ct->sanPham->ten_sp }}" style="width: 50px; height: auto;">
                                        </td>
                                        <td>{{ $ct->sanPham->ten_sp }}</td>
                                        <td>{{ $ct->so_luong }}</td>
                                        <td>{{ $ct->size->size_product ?? 'N/A' }}</td>
                                        <td>{{ number_format($ct->gia, 0, ',', '.') }} đ</td>
                                        <td>{{ number_format($ct->so_luong * $ct->gia, 0, ',', '.') }} đ</td>
                                    </tr>
                                 @endforeach
                           @else
                           <tr>
                                 <td colspan="7">Không có sản phẩm nào trong đơn hàng này.</td>
                           </tr>
                        @endif
                           </tbody>
                        </table>
                     </div>
                     <div class="row justify-content-between mt-3">
                        <div id="user-list-page-info" class="col-md-6">
                           <span>Hiển thị</span>
                        </div>
                        <div class="col-md-6">
                           <nav aria-label="Page navigation example">
                              <ul class="pagination justify-content-end mb-0">
                                 <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                 <li class="page-item"><a class="page-link" href="#">1</a></li>
                                 <li class="page-item"><a class="page-link" href="#">2</a></li>
                                 <li class="page-item"><a class="page-link" href="#">3</a></li>
                                 <li class="page-item"><a class="page-link" href="#">Next</a></li>
                              </ul>
                           </nav>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
</div>
@endsection