@extends('admin.layoutadmin')
@section('title')
Phản hồi email
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Phản hồi email khách hàng</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <div class="row justify-content-between">
                        <form id="searchForm" action="/admin/san-pham" method="GET">
                           <div class="row">
                                 <div class="col-auto">
                                    <select name="type" class="form-select">
                                       <option value="3">Tất cả</option>
                                       <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Chưa phản hồi</option>
                                       <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Đã phản hồi</option>
                                    </select>
                                 </div>
                           </div>
                        </form>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead class="text-center">
                                 <tr>
                                    <th>ID</th>
                                    <th>Mã giảm giá</th>
                                    <th>Phần trăm giảm</th>
                                    <th>Số lượng</th>
                                    <th>Mô tả</th>
                                    <th>Ngày hết hạn</th>
                                    <th>Hành động</th>
                                 </tr>
                           </thead>
                           <tbody>
                                 
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