@extends('admin.layoutadmin')
@section('title')
Quản lý đơn hàng - TrendyU
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách đơn hàng</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <div class="row justify-content-between">
                        <form id="searchForm" action="{{ route('don-hang.index') }}" method="GET">
                           <div class="row">
                                 <div class="col-auto">
                                    <select name="trang_thai" class="form-select">
                                       <option value="">Tất cả trạng thái</option>
                                       <option value="0" {{ request('trang_thai') == '0' ? 'selected' : '' }}>Chờ xử lý</option>
                                       <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đã xử lý</option>
                                       <option value="2" {{ request('trang_thai') == '2' ? 'selected' : '' }}>Đã giao cho đơn vị vận chuyển</option>
                                       <option value="3" {{ request('trang_thai') == '3' ? 'selected' : '' }}>Giao hàng thành công</option>
                                       <option value="4" {{ request('trang_thai') == '4' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                 </div>
                                 <div class="col-auto">
                                    <button type="submit" class="btn btn-secondary">Lọc</button>
                                 </div>
                           </div>
                        </form>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead class="text-center">
                                 <tr>
                                    <th>ID</th>
                                    <th>Người đặt hàng</th>
                                    <th>Thời gian đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                 </tr>
                        </thead>
                        <tbody>
                           @foreach($donHangs as $donHang)
                           <tr>
                                 <td>{{ $donHang->id }}</td>
                                 <td>{{ $donHang->user->name }}</td>
                                 <td>{{ $donHang->thoi_diem_mua_hang }}</td>
                                 <td>{{ number_format($donHang->tong_donHang, 0, ',', '.') }} đ</td>
                                 <td>{{ $donHang->pttt }}</td>
                                 <td>
                                    <div class="">
                                       @if ($donHang->trang_thai == 0)
                                        <span class="btn bg-warning">Chờ xử lý</span>
                                        @elseif ($donHang->trang_thai == 1)
                                        <span class="btn bg-primary">Đã xác nhận đơn hàng</span>
                                        @elseif ($donHang->trang_thai == 2)
                                        <span class="btn bg-info">Đã giao cho đơn vị vận chuyển</span>
                                        @elseif ($donHang->trang_thai == 3)
                                        <span class="btn bg-success">Đã giao thành công</span>
                                        @elseif ($donHang->trang_thai == 4)
                                        <span class="btn bg-dark">Đã đánh giá sản phẩm</span>
                                        @elseif ($donHang->trang_thai == 5)
                                        <span class="btn bg-danger">Đã hủy</span>
                                        @endif
                                    </div>
                                 </td>
                                 <td>
                                    <div class="d-flex justify-content-center">
                                       <a href="{{ route('don-hang.show', $donHang->id) }}" class="btn btn-outline-primary">Xem chi tiết</a>
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
                        {{$donHangs->links('pagination::bootstrap-5')}}
                        <!-- End phân trang -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection