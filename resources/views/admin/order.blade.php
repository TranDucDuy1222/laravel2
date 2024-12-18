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
                     <div class="row d-flex align-items-center">
                        <div class="col-start">
                           <form id="searchForm" action="{{ route('don-hang.index') }}" method="GET">
                              <div class="row">
                                 <div class="col-auto">
                                    <select name="trang_thai" class="form-select" onchange="loctrangthai(this.value)">
                                       <option value="0" {{ request('trang_thai' ) == '0' ? 'selected' : '' }} >Chờ xử lý</option>
                                       <option value="1" {{ request('trang_thai') == '1' ? 'selected' : '' }}>Đã xử lý</option>
                                       <option value="2" {{ request('trang_thai') == '2' ? 'selected' : '' }}>Đã giao cho đơn vị vận chuyển</option>
                                       <option value="3" {{ request('trang_thai') == '3' ? 'selected' : '' }}>Đã giao thành công</option>
                                       <option value="4" {{ request('trang_thai') == '4' ? 'selected' : '' }}>Đã đánh giá</option>
                                       <option value="5" {{ request('trang_thai') == '5' ? 'selected' : '' }}>Đã hủy</option>
                                       <!-- <option value="" {{ request('trang_thai') === null ? 'selected' : '' }}>Tất cả trạng thái</option> -->
                                    </select>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="col-end">
                           
                           @if ($allValid)
                              <form action="{{ route('don-hang.update-all') }}" method="POST" id="donHangForm" class="">
                                 @csrf
                                 @method('PUT')
                                 <!-- Input ẩn để lưu các ID đơn hàng đã chọn -->
                                 <input type="hidden" name="selectedDonHangIds" id="selectedDonHangIds" value="">
                                 <button type="submit" class="btn btn-outline-primary mt-3">Cập nhật đơn hàng đã chọn</button>
                              </form>
                           @endif
                           <div id="textStatus"></div>
                        </div>
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
                                 <td>
                                    <div class="d-flex align-items-center">
                                       @if ($donHang->trang_thai === 1 || $donHang->trang_thai === 2 )
                                       <input type="checkbox" class="form-check-input" value="{{ $donHang->id }}" style="width: 20px; height: 20px;" onclick="updateSelectedDonHangIds()">
                                       @endif
                                       <span class="ms-2">{{ $donHang->id }}</span>
                                    </div>
                                 </td>
                                 <td>{{ $donHang->user->name }}</td>
                                 <td>{{ $donHang->thoi_diem_mua_hang }}</td>
                                 <td>{{ number_format($donHang->tong_dh, 0, ',', '.') }} đ</td>
                                 <td>{{ $donHang->pttt }}</td>
                                 <td>
                                    <div class="">
                                       @if ($donHang->trang_thai == 0)
                                        <span class="btn bg-warning">Chờ xử lý</span>
                                        @elseif ($donHang->trang_thai == 1)
                                        <span class="btn bg-primary">Đã xử lý</span>
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
<script>
function updateSelectedDonHangIds() {
    // Lấy tất cả các checkbox
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var selectedIds = [];

    // Duyệt qua tất cả các checkbox và thêm ID vào mảng nếu được chọn
    checkboxes.forEach(function(checkbox) {
        if (checkbox.checked) {
            selectedIds.push(checkbox.value);
        }
    });

    // Cập nhật giá trị của input ẩn
    document.getElementById('selectedDonHangIds').value = selectedIds.join(',');
}

function loctrangthai(trang_thai) {
    // Chuyển hướng đến URL mới với giá trị trang_thai
    document.location = `/admin/don-hang?trang_thai=${trang_thai}`;
}

document.addEventListener("DOMContentLoaded", function() {
    // Lấy giá trị của tham số 'trang_thai' từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const trang_thai = urlParams.get('trang_thai');

    // Kiểm tra giá trị của 'trang_thai' và cập nhật nội dung của thẻ 'textStatus'
    if (trang_thai == 1) {
        document.getElementById('textStatus').innerText = 'Cập nhật trạng thái sang: Đã giao cho đơn vị vận chuyển';
    } else if (trang_thai == 2) {
        document.getElementById('textStatus').innerText = 'Cập nhật trạng thái sang: Đã giao hàng thành công';
    }
});
</script>

@endsection