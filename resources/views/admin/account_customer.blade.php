@extends('admin.layoutadmin')
@section('title')
Quản Lý Tài Khoản
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách tài khoản khách hàng</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                     <div class="table-responsive">
                        <div class="row justify-content-between">
                           <form id="searchForm" action="{{ route('tai-khoan.index') }}" method="GET">
                                 <div class="row">
                                    <div class="col-auto">
                                       <select name="is_hidden" class="form-select">
                                          <option value="0" {{ request('is_hidden') == '0' ? 'selected' : '' }}>Hiện</option>
                                          <option value="1" {{ request('is_hidden') == '1' ? 'selected' : '' }}>Đã ẩn</option>
                                          <option value="">Tất cả trạng thái</option>
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
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>  
                                    <th>Hành động</th>
                                 </tr>
                           </thead>
                           <tbody>
                              @foreach($users as $user)
                                 <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                       <div class="d-flex justify-content-center">
                                          {{ $user->role == 1 ? 'Admin' : 'Người Dùng' }}
                                       </div>
                                    </td>
                                    <td>
                                       <div class="d-flex justify-content-center">
                                          <a href="{{ route('tai-khoan.show', $user->id) }}" class="btn btn-outline-dark me-2">Xem</a>
                                          @if($user->is_hidden)
                                             <form action="{{ route('tai-khoan.restore', $user->id) }}" method="POST" style="display:inline-block;">
                                                   @csrf
                                                   <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn hiện lại tài khoản này?')" class="btn btn-outline-success">Hiện lại</button>
                                             </form>
                                          @else
                                             <form action="{{ route('tai-khoan.hide', $user->id) }}" method="POST" style="display:inline-block;">
                                                   @csrf
                                                   <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn ẩn tài khoản này?')" class="btn btn-outline-danger">Ẩn</button>
                                             </form>
                                          @endif
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                           </tbody>
                        </table>
                  </div>
                  <div class="row justify-content-between mt-3">
                     <div id="user-list-page-info" class="col-md-6">
                        <span>Hiển thị</span>
                     </div>
                     <div class="col-md-6 d-flex justify-content-end">
                        <!-- Phân trang -->
                        {{$users->links('pagination::bootstrap-5')}}
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