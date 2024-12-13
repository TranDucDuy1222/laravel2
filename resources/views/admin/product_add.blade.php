@extends('admin.layoutadmin')
@section('title')
Thêm sản phẩm
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12 col-lg-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Thêm sản phẩm mới</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     <div class="col-md-3">
                        <ul id="top-tabbar-vertical" class="p-0">
                           <li class="active" id="personal">
                              <a href="javascript:void();">
                              <i class="fa-solid fa-box"></i><span>Thông tin sản phẩm</span>
                              </a>
                           </li>
                           <li id="contact">
                              <a href="javascript:void();">
                              <i class="fa-regular fa-file-lines"></i><span>Mô tả sản phẩm</span>
                              </a>
                           </li>
                           <li id="official">
                              <a href="javascript:void();">
                              <i class="fa-solid fa-layer-group"></i><span>Kích thước & số lượng</span>
                              </a>
                           </li>
                        </ul>
                     </div>
                     <div class="col-md-9">
                        <form id="form-wizard3" action="{{route('san-pham.store')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <!-- fieldsets -->
                           <fieldset>
                              <div class="form-card">
                                 <div class="row">
                                    <div class="col-12">
                                       <h3 class="mb-4">Thông tin sản phẩm:</h3>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="form-product/name" class="form-label fw-semibold">Tên</label>
                                          <input value="{{old('ten_sp')}}" type="text" class="form-control" id="form-product/name" name="ten_sp" required />
                                       </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="" class="form-label fw-semibold">Màu</label>
                                          <input type="text" class="form-control" value="{{old('color')}}" id="" name="color" required />
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="" class="form-label fw-semibold">Danh mục</label>
                                          <select class="sa-select2 form-select " name="id_dm" required>
                                             <option value="0">Chọn danh mục</option>
                                             @foreach($loai_arr as $dm)
                                             <option value="{{ $dm->id }}" {{ old('id_dm') == $dm->id ? 'selected' : '' }}>
                                                   {{$dm->ten_dm}}
                                             </option>
                                             @endforeach
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="" class="form-label fw-semibold">Trạng Thái</label>
                                          <select class="sa-select2 form-select " name="trang_thai" required>
                                             <option value="0">Sản Phẩm Đang Kinh Doanh</option>
                                             <option value="2">Sản Phẩm Sắp Về Hàng</option>
                                          </select>
                                          
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="form-product/price" class="form-label fw-semibold">Giá khuyến mãi</label>
                                          <input value="{{old('gia_km')}}" type="number" class="form-control" id="form-product/price" name="gia_km" />
                                          
                                       </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="form-product/old-price" class="form-label fw-semibold">Giá gốc</label>
                                          <input value="{{old('gia')}}" type="number" class="form-control" id="form-product/old-price" name="gia" required />
                                          
                                       </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6 mb-3">
                                       <div class="form-group">
                                          <label for="" class="form-label fw-semibold">Ảnh</label>
                                          <!-- <input value="{{old('hinh')}}" class="form-select" name="hinh" type="file" class="upload-button btn iq-bg-primary" accept="image/*" required> -->
                                          <img class="profile-pic img-fluid mb-3" src="images/camera.png" alt="profile-pic">
                                          <a href="javascript:void();" class="">
                                          <input value="{{old('hinh')}}" name="hinh" class="file-up form-control" type="file" accept="image/*"></a>
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
                                       <h3 class="mb-4">Mô tả sản phẩm:</h3>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-12 mb-3">
                                       <div class="form-group">
                                          <label for="form-product/description" class="form-label fw-semibold">Mô tả chi tiết</label>
                                          <textarea id="description" class="form-control" rows="8" name="mo_ta_ct" style="display: none;">{{ old('mo_ta_ct') }}</textarea>
                                          <div class="errors" style="color: red; margin-top: 5px;"></div>
                                       </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                       <div class="form-group">
                                          <label for="form-product/short-description" class="form-label fw-semibold">Mô tả ngắn</label>
                                          <textarea id="form-product/short-description" class="form-control" rows="4" name="mo_ta_ngan" required>{{old('mo_ta_ngan')}}</textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <button type="button" name="next" class="btn btn-primary next action-button float-end" value="Next" >Tiếp tục</button>
                              <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-3" value="Previous" >Quay lại</button>
                           </fieldset>
                           <fieldset>
                              <div class="form-card text-left">
                                 <div class="row">
                                    <div class="col-12">
                                       <h3 class="mb-4">Hàng nhập vào kho:</h3>
                                    </div>
                                 </div>
                                 @if(session('selected_option') == 'giay')
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="37" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="38.5" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="39" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="39.5" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="40" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="40.5" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="41" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="41.5" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                    </div>
                                 @elseif(session('selected_option') == 'ao' || session('selected_option') == 'quan' )
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="S" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="M" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="L" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input class="form-control"  readonly value="XL" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                    </div>
                                 @elseif(session('selected_option') == 'phu-kien')
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="S/M" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="M/L" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="L/XL" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                    </div>
                                 @elseif(session('selected_option') == 'one-size')
                                    <div class="row">
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/size" class="form-label fw-semibold">Kích thước</label>
                                             <input class="form-control"  readonly value="One size" name="size_product[]" />
                                          </div>
                                       </div>
                                       <div class="col-md-6 mb-3">
                                          <div class="form-group">
                                             <label for="form-product/quantity" class="form-label fw-semibold">Số lượng</label>
                                             <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                          </div>
                                       </div>
                                    </div>
                                 @endif
                                 <div id="containerSize" class="row">
                                 </div>
                                 @if(session('selected_option') == 'one-size')
                                    <div class="text-center">Sản phẩm có 1 size</div>
                                 @else
                                    <button id="addSizeButton" class="btn btn-outline-dark " type="button">Thêm size mới</button>
                                 @endif
                              </div>
                              <button type="submit" name="submit" class="btn btn-primary action-button float-end" value="save" >Thêm sản phẩm</button>
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
<style>
   .ck-editor__editable_inline {
      height: 400px;
   }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/translations/vi.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function () {
      ClassicEditor.create(document.querySelector('#description'), { language: 'vi' })
         .then(editor => {
            const form = document.querySelector('form');
            const errorDiv = document.querySelector('.errors');
            errorDiv.style.display = 'none'; // Ẩn thông báo lỗi khi tải trang

            form.addEventListener('submit', function (event) {
                  // Cập nhật nội dung từ CKEditor vào textarea
                  document.querySelector('#description').value = editor.getData();

                  // Kiểm tra nếu mô tả trống
                  if (!document.querySelector('#description').value.trim()) {
                     event.preventDefault();
                     errorDiv.textContent = 'Yêu cầu nhập mô tả';
                     errorDiv.style.display = 'block';
                  } else {
                     errorDiv.style.display = 'none';
                  }
            });

            // Thêm sự kiện click cho nút button
            const addButton = document.querySelector('#addSizeButton');
            addButton.addEventListener('click', function () {
               const container = document.querySelector('#containerSize');

               // Tạo HTML mới
               const newSizeInput = document.createElement('div');
               newSizeInput.className = 'col-md-6 mb-3';
               newSizeInput.innerHTML = `
                  <div class="form-group">
                     <input class="form-control" required name="size_product[]" />
                  </div>
               `;

               const newQuantityInput = document.createElement('div');
               newQuantityInput.className = 'col-md-6 mb-3';
               newQuantityInput.innerHTML = `
                  <div class="form-group">
                     <input value="{{old('so_luong[]')}}" type="number" class="form-control" name="so_luong[]" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                  </div>
               `;

               // Chèn HTML mới vào container
               container.appendChild(newSizeInput);
               container.appendChild(newQuantityInput);

               // Kiểm tra điều kiện đường dẫn
               const currentURL = window.location.href;
               if (currentURL.includes('selection=giay')) {
                  newSizeInput.querySelector('input[name="size_product[]"]').addEventListener('input', function (event) {
                     // Chỉ cho phép nhập số và dấu chấm
                     this.value = this.value.replace(/[^0-9.]/g, '');
                  });
               }
            });
         })
         .catch(error => {
            console.error("Không thể tạo editor", error);
         });
   });
</script>



@endsection