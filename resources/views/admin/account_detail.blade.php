@extends('admin.layoutadmin')
@section('title')
Chi Tiết Tài Khoản
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Chi Tiết Tài Khoản #{{ $user->id }}</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <div class="card-body">
                        <p><strong>Tên:</strong> {{ $user->name }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Vai Trò:</strong> 
                           @if($user->role == 1)
                              <span class="btn bg-primary">Admin</span>
                           @else
                              <span class="btn bg-secondary">Khách Hàng</span>
                           @endif
                        </p>
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
                     <h4 class="card-title">Danh sách địa chỉ giao hàng</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                        <thead class="text-center">
                           <tr>
                              <th>Họ Tên</th>
                              <th>Số Điện Thoại</th>
                              <th>Địa Chỉ chi tiết</th>
                              <th>Quận/Huyện</th>
                              <th>Tỉnh/Thành phố</th>
                           </tr>
                        </thead>
                        <tbody>
                           @forelse($user->diaChi as $diaChi)
                           <tr>
                              <td>{{ $diaChi->ho_ten }}</td>
                              <td>{{ $diaChi->phone }}</td>
                              <td>{{ $diaChi->dc_chi_tiet }}</td>
                              <td>{{ $diaChi->qh }}</td>
                              <td>{{ $diaChi->thanh_pho }}</td>
                           </tr>
                           @empty
                              <p>Người dùng chưa có địa chỉ nào.</p>
                           @endforelse
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
