@extends('admin.layoutadmin')
@section('title')
Thống Kê
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách tài khoản Admin</h4>
                  </div>
                  <div class="col-sm-12 col-md-6">
                        <div class="user-list-files d-flex justify-content-end">
                           <a href="{{route('danh-muc.create')}}" type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="fa-solid fa-plus"></i> Thêm tài khoản mới
                           </a>
                        </div>
                     </div>
               </div>
               <div class="iq-card-body">
                     <div class="table-responsive">
                        <div class="row justify-content-between">
                           <form id="searchForm" action="{{ route('tai-khoan.index') }}" method="GET">
                                 <div class="row">
                                    <div class="col-auto">
                                       <select name="role" class="form-select">
                                          <option value="0" {{ request('role') == '0' ? 'selected' : '' }}>Người Dùng</option>
                                          <option value="1" {{ request('role') == '1' ? 'selected' : '' }}>Admin</option>
                                          <option value="">Tất cả vai trò</option>
                                       </select>
                                    </div>
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
                                    <th>Trạng thái</th>  
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
                                          @if($user->role == 1)  <!-- Nếu là Admin -->
                                             <a href="{{ route('tai-khoan.edit', $user->id) }}" class="btn btn-outline-primary me-2">Sửa</a>
                                          @endif
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