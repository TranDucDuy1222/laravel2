@extends('admin.layoutadmin')
@section('title')
Mã giảm giá
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách mã giảm giá</h4>
                  </div>
                  <div class="col-sm-12 col-md-6">
                     <div class="user-list-files d-flex justify-content-end">
                        <!-- <button type="button" class="btn btn-dark">
                           <i class="fa-solid fa-plus"></i> Thêm mã giảm giá
                        </button> -->
                        <a href="{{route('magiamgia.create')}}" class="btn btn-dark">
                           <i class="fa-solid fa-plus"></i> Thêm mã giảm giá
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
                                    <select name="type" class="form-select">
                                       <option value="">Tất cả loại mã</option>
                                       <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Mã dùng 1 lần</option>
                                       <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Mã dùng nhiều lần</option>
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
                                 @foreach($discounts as $discount)
                                    <tr>
                                       <td>{{ $discount->id }}</td>
                                       <td>{{ $discount->code }}</td>
                                       <td>{{ $discount->phan_tram }}%</td>
                                       <td>{{ $discount->ma_gioi_han}}</td>
                                       <td>{{ $discount->mo_ta }}</td>
                                       <td>{{ $discount->ngay_het_han ? \Carbon\Carbon::parse($discount->ngay_het_han)->format('d/m/Y') : 'Không có' }}</td>
                                       <td>
                                             <a href="{{ route('magiamgia.edit', $discount->id) }}" class="btn btn-outline-primary btn-sm">Sửa</a>
                                             <form action="{{ route('magiamgia.destroy', $discount->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?')" class="btn btn-outline-danger btn-sm">Xóa</button>
                                             </form>
                                       </td>
                                    </tr>
                                 @endforeach
                           </tbody>
                        </table>
                     </div>
                  <!-- <div class="row justify-content-between mt-3">
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
                  </div> -->
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection