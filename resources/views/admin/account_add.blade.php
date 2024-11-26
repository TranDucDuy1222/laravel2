@extends('admin.layoutadmin')
@section('title')
Tài khoản
@endsection

@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12 col-lg-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Tạo tài khoản mới</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     <div class="col-md-3">
                        <ul id="top-tabbar-vertical" class="p-0">
                           <li class="active" id="personal">
                              <a href="javascript:void();">
                              <i class="fa-solid fa-box"></i><span>Thông tin tài khoản</span>
                              </a>
                           </li>
                           <li id="contact">
                              <a href="javascript:void();">
                              <i class="fa-regular fa-file-lines"></i><span>Mật khẩu</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-9">
                        <form id="form-wizard3" action="{{route('tai-khoan.store')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <!-- fieldsets -->
                           <fieldset>
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-12">
                                       <h3 class="mb-4">Thông tin tài khoản:</h3>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label class="form-label fw-semibold">Tên</label>
                                          <input type="text" name="name" class="form-control" required>
                                          @error('name')
                                             <div class="text-danger">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label class="form-label fw-semibold">Email</label>
                                          <input type="email" name="email" class="form-control" required>
                                          @error('email')
                                             <div class="text-danger">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <label for="role" class="form-label fw-semibold">Vai trò</label>
                                       <select id="role" name="role" class="form-select " required>
                                          <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                                       </select>
                                       @error('role')
                                          <div class="invalid-feedback">{{ $message }}</div>
                                       @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="is_hidden" class="form-label fw-semibold">Trạng Thái</label>
                                          <select id="is_hidden" name="is_hidden" class="form-select" required>
                                             <option value="0" {{ old('is_hidden') == 0 ? 'selected' : '' }}>Hiển thị</option>
                                             <option value="1" {{ old('is_hidden') == 1 ? 'selected' : '' }}>Ẩn</option>
                                          </select>
                                          @error('id_dm')
                                             <span class="text-danger">{{$message}}</span>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <button id="submit" type="button" name="next" class="btn btn-primary next action-button float-end" value="Next" >Tiếp tục</button>
                           </fieldset>
                           <fieldset>
                              <div class="form-card text-left">
                                 <div class="row">
                                    <div class="col-12">
                                       <h3 class="mb-4">Mật khẩu tài khoản:</h3>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12 mb-3">
                                       <div class="form-group">
                                          <label class="form-label fw-semibold">Mật khẩu</label>
                                          <input type="password" name="password" class="form-control" required>
                                          @error('password')
                                             <div class="text-danger">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                       <div class="form-group">
                                          <label class="form-label fw-semibold">Xác nhận mật khẩu</label>
                                          <input type="password" name="password_confirmation" class="form-control" required>
                                          @error('password_confirmation')
                                             <div class="text-danger">{{ $message }}</div>
                                          @enderror
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary action-button float-end" value="save" >Thêm tài khoản</button>
                              <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-3" value="Previous" >Quay lại</button>
                           </fieldset>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection