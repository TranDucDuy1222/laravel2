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
                       
                           <div class="row">
                              <div class="col-auto">
                                 <select name="type" class="form-select">
                                    <option value="3">Tất cả</option>
                                    <option value="0" {{ request('type') == '0' ? 'selected' : '' }}>Chưa phản hồi
                                    </option>
                                    <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Đã phản hồi</option>
                                 </select>
                              </div>
                           </div>
                        
                     </div>
                     <table id="" class="table-rps table table-striped table-bordered mt-4">
                        <thead class="text-center">
                           <tr>
                              <th class="col-id">ID</th>
                              <th class="col-sender">Tên người gởi</th>
                              <th class="col-email">Email</th>
                              <th class="col-content">Nội dung</th>
                              <th class="col-feedback">Phản hồi</th>
                              <th class="col-action">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($email_arr as $item )
                              <tr>
                                 <td class="text-center col-id-td">{{ $item->id }}</td>
                                 <td class="text-center text-truncate col-sender-td">
                                    {{ $item->ho_ten }}
                                 </td>
                                 <td class="text-start text-truncate col-email-td"> 
                                    {{ $item->email }}    
                                 </td>
                                 <td class="text-start text-truncate col-content-td">
                                    {{ $item->noi_dung }}
                                 </td>
                                 <td class="text-start text-truncate col-content-td">
                                    {{ $item->feedback }}
                                 </td>
                                 <td class="col-action-td">
                                    <div class="text-center">
                                       <button type="button" class="btn btn-outline-dark rounded " data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"> 
                                          Xem 
                                       </button> 
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-centered modal-lg">
                                          <div class="modal-content">
                                             <form action="{{route('admin.contact', $item->id)}}" method="post">
                                                @csrf
                                                <div class="modal-header">
                                                <h6 class="modal-title fs-6" id="exampleModalLabel">Phản hồi email : {{$item->email}}</h6>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="form-group">
                                                      <label class="">Người gửi: {{$item->ho_ten}}</label><br/>
                                                      <label>Ngày gửi: {{$item->created_at->format('d-m-Y H:i:s')}}</label>
                                                   </div>
                                                   <div class="form-group mt-2">
                                                      <label for="id_user{{ $item->id }}">Nội dung của người dùng</label>
                                                      <textarea class="form-control" id="id_user" name="" rows="3" readonly >{{ $item->noi_dung }}</textarea>
                                                   </div>
                                                   @if($item->an_hien === 1)
                                                      <div class="form-group">
                                                         <label for="inputPH{{ $item->id }}">Phản hồi</label>
                                                         <input type="text" required name="feedback" class="form-control" id="inputPH{{$item->id}}" placeholder="Vui lòng nhập phản hồi hoặc chọn từ các phản hồi có sẵn" style="margin-bottom: 10px;">
                                                         <select name="" id="selectOption{{$item->id}}" style="width: 100%; height: 35px;" class="form-control">
                                                               <option value="">Chọn câu trả lời có sẵn</option>
                                                               <option value="">Nếu bạn cần hỗ trợ, vui lòng liên hệ với tôi thông qua Zalo : {{ $setting->phone }} hoặc Facebook : {{ $setting->site_name }}.</option>
                                                               <option value="">Xin lỗi vì bạn đã có trải nghiệm không tốt.</option>
                                                         </select>
                                                      </div>
                                                   @else
                                                      <div class="form-group">
                                                         <label for="">Đã phản hồi</label>
                                                         <textarea class="form-control" id="id_user" name="" rows="3" readonly >{{ $item->feedback }}</textarea>
                                                      </div>
                                                   @endif
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                   @if ($item->an_hien === 1)                                                   
                                                      <button type="submit" class="btn btn-primary">Gửi</button>
                                                   @endif
                                                </div>
                                             </form>
                                          </div>
                                          </div>
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
                        {{$email_arr->links('pagination::bootstrap-5')}}
                        <!-- End phân trang -->
                     </div>
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