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
                        <p><strong>Họ Tên:</strong> {{ $user->diaChi->ho_ten ?? 'Chưa cập nhật' }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Số Điện Thoại:</strong> {{ $user->diaChi->phone ?? 'Chưa cập nhật' }}</p>
                        <p><strong>Địa Chỉ:</strong>
                           {{ $user->diaChi->dc_chi_tiet ?? 'Chưa cập nhật' }},
                           {{ $user->diaChi->qh ?? 'Chưa cập nhật' }},
                           {{ $user->diaChi->thanh_pho ?? 'Chưa cập nhật' }}
                        </p>
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

   <!-- Hiển thị các đơn hàng liên quan -->
   
</div>
@endsection
