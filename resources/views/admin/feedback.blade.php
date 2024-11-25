@extends('admin.layoutadmin')
@section('title')
Đánh giá
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Danh sách đánh Giá</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="table-responsive">
                     <div class="row justify-content-between">
                        <form id="searchForm" action="/admin/san-pham" method="GET">
                           <div class="row">
                                 <div class="col-auto">
                                    <select id="an_hien" class="form-select mb-4" aria-label="Default select example" onchange="loctrangthai(this.value)">
                                       <option value="0" {{$an_hien == "0" ? "selected" : ""}}>Đã ẩn</option>
                                       <option value="1" {{$an_hien == "1" ? "selected" : ""}}>Đang hiện</option>
                                    </select>
                                    <!--Lọc trạng thái bằng JS-->
                                    <script>
                                       function loctrangthai(trang_thai) {
                                             document.location = `/admin/danh-gia?an_hien=${trang_thai}`;
                                       }
                                    </script>
                                 </div>
                           </div>
                        </form>
                        </div>
                        <table id="user-list-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                           <thead class="text-center">
                                 <tr>
                                    <tr>
                                       <th>ID</th>
                                       <th>Khách hàng</th>
                                       <th>Phân loại</th>
                                       <th>Chất lượng</th>
                                       <th>Đánh giá</th>
                                       <th>Ngày</th>
                                       <th>Phản hồi</th>
                                       <th></th>
                                    </tr>
                                 </tr>
                           </thead>
                           <tbody>
                                 @foreach ($showall_review as $item)
                                 <tr>
                                    <td>ID: {{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->size_product}} - {{$item->color}}</td>
                                    <td>
                                       @if ($item->quality_product == 5)
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                       @elseif($item->quality_product == 4)
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                       @elseif($item->quality_product == 3)
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                       @elseif($item->quality_product == 2)
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                       @else
                                             <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                                       @endif
                                    </td>
                                    <td>{{$item->noi_dung}}
                                    <td>{{$item->thoi_diem}}</td>
                                    <td>{{$item->feedback}}</td>
                                    <td>
                                       <!-- <button type="button" data-id="{{ $item->id }}" onclick="toggleForm(this)" style="background-color: white; color: black; border: 2px solid black; border-radius: 10px;">Xem</button> -->
                                       <button type="button" class="btn btn-outline-dark rounded" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">
                                             Xem
                                       </button>
                                       <!-- Form phản hồi -->
                                       <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                             <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                   <form action="{{ route('danh-gia.update', $item->id) }}" method="post">
                                                         @csrf
                                                         @method('PUT')
                                                         <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Phản hồi đánh giá : ID {{$item->id}}</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                            <div class="form-group">
                                                               <label for="inputPH{{ $item->id }}">Phản hồi</label>
                                                               <input type="text" name="feedback" class="form-control" id="inputPH{{$item->id}}" placeholder="Vui lòng nhập phản hồi hoặc chọn từ các phản hồi có sẵn" style="margin-bottom: 10px;">
                                                               <select name="" id="selectOption{{$item->id}}" style="width: 100%; height: 35px;" class="form-control">
                                                                     <option value="">Chọn câu trả lời có sẵn:</option>
                                                                     <option value="">Cảm ơn vì bạn đã mua hàng.</option>
                                                                     <option value="">Xin lỗi vì bạn đã có trải nghiệm không tốt. Nếu bạn cần hỗ trợ, vui lòng liên hệ với tôi:</option>
                                                               </select>
                                                            </div>
                                                            <div class="form-group mt-3">
                                                               <label for="id_user{{ $item->id }}">Đánh giá của người dùng</label>
                                                               <textarea class="form-control" id="id_user{{ $item->id }}" name="id_user" rows="2" readonly >{{ $item->noi_dung }}</textarea>
                                                            </div>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-outline-success">Lưu</button>
                                                         </div>
                                                   </form>
                                                </div>
                                             </div>
                                       </div>
                                    </td>
                                    <td>
                                       @if ($item->an_hien == 1)
                                             <form action="{{route('danh-gia.hide', $item->id)}}" method="post">
                                                @csrf
                                                <button class="btn btn-outline-danger rounded">Ẩn</button>
                                             </form>
                                       @else
                                             <form action="{{route('danh-gia.show', $item->id)}}"  method="post">
                                                @csrf
                                                <button class="btn btn-outline-success rounded">Hiện</button>
                                             </form>
                                       @endif
                                    </td>
                                 </tr>
                                 @endforeach
                           </tbody>
                        </table>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
    // Lấy tất cả các thẻ select
    var selects = document.querySelectorAll('select');

    // Thêm sự kiện cho mỗi thẻ select
    selects.forEach(function(select) {
        select.addEventListener('change', function() {
            // Lấy ID của thẻ select
            var id = this.id.replace('selectOption', '');

            // Tìm thẻ input tương ứng
            var input = document.getElementById('inputPH' + id);

            // Cập nhật giá trị của thẻ input
            if (input) {
                input.value = this.options[this.selectedIndex].innerText;
            }
        });
    });
</script>
@endsection