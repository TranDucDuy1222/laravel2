@extends('admin.layoutadmin')
@section('title')
Cài Đặt Hệ Thống
@endsection
@section('content')
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header row py-4">
                  <div class="iq-header-title col-sm-12 col-md-6">
                     <h4 class="card-title">Cài Đặt Hệ Thống</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                     <div class="table-responsive">
                        <form action="{{route('cai-dat.update', $setting->id)}}" method="post" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="id" value="{{ $setting->id }}">
                           <!-- Thiết Lập logo -->
                           <div id="" class="shadow m-1 rounded">
                                 <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                    Thiết lập Logo
                                 </div>
                                 <hr>
                                 <div class="row px-4">               
                                    <div class="col-xl-4">
                                       <label for="" class="h5" >Logo cho nền sáng</label><br>
                                       <div class="border mb-2 ">
                                       <img src="{{ asset('/uploads/logo/'.$setting->logo_light) }}"
                                       onerror="this.src='{{ asset('/uploads/logo/logolight.png') }}'" alt="" class="w-100" style="height: 200px;">
                                       </div>
                                       <input type="file" name="logo_light">
                                    </div>
                                    <div class="col-xl-4">
                                       <label for=""  class="h5" >Logo cho nền tối</label><br>
                                       <div class="border mb-2 ">
                                             <img src="{{ asset('/uploads/logo/'. $setting->logo_dark) }}"
                                                onerror="this.src='{{ asset('/uploads/logo/logodark.png') }}'" alt="" class="w-100" style="height: 200px;">
                                       </div>
                                       <input type="file" name="logo_dark">
                                    </div>
                                    <div class="col-xl-4">
                                       <label for=""  class="h5" >Icon</label><br>
                                       <div class="border mb-2 p-5 text-center" style="height: 200px;">
                                       <img src="{{ asset('/uploads/logo/'. $setting->logo_icon) }}"
                                             onerror="this.src='{{ asset('/uploads/logo/iconlogo.png') }}'" alt="">
                                       </div>
                                       <input type="file" name="logo_icon">
                                    </div>
                                 </div>
                                 <br>
                                 
                                 <div class="row px-4">
                                    <div class="col-lg-8">
                                       <div class="row">
                                          <div class="col-lg-6">
                                             <label for=""  class="h5" >Biểu ngữ mục khuyến mãi</label><br>
                                             <div class="border mb-2 p-5 text-center" style="">
                                             <img src="{{ asset('/uploads/logo/'. $setting->banner_dung_sale) }}"
                                                   onerror="this.src='{{ asset('/uploads/logo/iconlogo.png') }}'" alt="">
                                             </div>
                                             <input type="file" name="banner_dung_sale">
                                          </div>
                                          <div class="col-lg-6">
                                             <label for=""  class="h5" >Biểu ngữ mục sắp về hàng</label><br>
                                             <div class="border mb-2 p-5 text-center" style="">
                                             <img src="{{ asset('/uploads/logo/'. $setting->banner_dung_cms) }}"
                                                   onerror="this.src='{{ asset('/uploads/logo/iconlogo.png') }}'" alt="">
                                             </div>
                                             <input type="file" name="banner_dung_cms">
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-lg-4">
                                       <label for=""  class="h5" >Logo giảm giá</label><br>
                                       <div class="border mb-2 p-5 text-center" style="height: 200px;">
                                       <img src="{{ asset('/uploads/logo/'. $setting->logo_sale) }}"
                                             onerror="this.src='{{ asset('/uploads/logo/iconlogo.png') }}'" class="h-100" alt="">
                                       </div>
                                       <input type="file" name="logo_sale">
                                       <hr>
                                       <label for=""  class="h5" >Logo sắp về hàng</label><br>
                                       <div class="border mb-2 p-5 text-center" style="height: 200px;">
                                       <img src="{{ asset('/uploads/logo/'. $setting->logo_cms) }}"
                                             onerror="this.src='{{ asset('/uploads/logo/iconlogo.png') }}'" class="h-100" alt="">
                                       </div>
                                       <input type="file" name="logo_cms">
                                    </div>
                                 </div>
                                 <hr class="m-0">
                                 <div class="d-flex justify-content-end p-4" >
                                    <button type="submit" class="btn btn-outline-primary"> 
                                       Lưu thiết lập
                                    </button>
                                 </div>
                           </div>
                           <br>
                           <!-- End thiết lập logo -->
                           <!-- Thông tin quản trị -->
                           <div id="" class="shadow m-1 rounded" >
                                 <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                    Thông tin 
                                 </div>
                                 <hr>
                                 <div class="row px-4">               
                                    <div class="col-xl-6">
                                       <label for="" class="h5" >Tên thương hiệu</label><br>
                                       <input type="text" class="form-control mb-4" name="site_name" value="{{$setting->site_name}}" placeholder="Nhập tên thương hiệu của website" >
                                    </div>
                                    <div class="col-xl-6">
                                       <label for=""  class="h5" >Email quản trị</label><br>
                                       <input type="email" class="form-control mb-4" name="support_email" value="{{$setting->support_email}}" placeholder="Nhập email quản trị của website" >
                                    </div>
                                    <div class="col-xl-6">
                                       <label for="" class="h5" >Số điện thoại</label><br>
                                       <input type="text" class="form-control mb-4" name="phone" value="{{$setting->phone}}" placeholder="Nhập số điện thoại liên hệ cho quản trị" >
                                    </div>
                                    <div class="col-xl-6">
                                       <label for="" class="h5" >Địa chỉ cửa hàng</label><br>
                                       <input type="text" class="form-control mb-4" name="address" value="{{$setting->address}}" placeholder="Địa chỉ cửa hàng" >
                                    </div>
                                 </div>
                                 <hr class="m-0">
                                 <div class="d-flex justify-content-end p-4" >
                                    <button type="submit" class="btn btn-outline-primary"> 
                                       Lưu thiết lập
                                    </button>
                                 </div>
                           </div>
                           <br>
                           <!-- End thông tin quản trị -->
                           <!-- Phí ship -->
                           <div id="" class="shadow m-1 rounded" >
                                 <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                    Phí vận chuyển đơn hàng
                                 </div>
                                 <hr>
                                 <div class="row px-4">               
                                    <div class="col-xl-6">
                                       <label for="" class="h5" >Vận chuyển cho đơn hàng : trong tỉnh</label><br>
                                       <div class="input-group">
                                             <input type="number" class="form-control w-80 " name="ship_cost_inner_city" value="{{ $setting->ship_cost_inner_city }}" placeholder="Phí vận chuyển trong thành phố">
                                             <span class="input-group-text w-20 ">.000 đ</span>
                                       </div>
                                    </div>
                                    <div class="col-xl-6">
                                       <label for=""  class="h5" >Vận chuyển cho đơn : toàn quốc</label><br>
                                       <div class="input-group">
                                             <input type="number" class="form-control w-80 " name="ship_cost_nationwide" value="{{$setting->ship_cost_nationwide}}" placeholder="Phí vận chuyển toàn quốc">
                                             <span class="input-group-text w-20 ">.000 đ</span>
                                       </div>
                                    </div>
                                 </div>
                                 <hr class="m-0">
                                 <div class="d-flex justify-content-end p-4" >
                                    <button type="submit" class="btn btn-outline-primary"> 
                                       Lưu thiết lập
                                    </button>
                                 </div>
                           </div>
                           <br>
                           <!-- End phí ship -->
                        </form>
                     </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection