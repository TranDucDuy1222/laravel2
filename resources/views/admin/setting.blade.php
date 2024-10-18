@extends('admin.layoutadmin')
@section('title')
Cài đặt hệ thống
@endsection

@section('content')
    <!-- sa-app__body -->
    <div id="top" class="sa-app__body px-2 px-lg-4">
        <div class="container pb-6">
            <div class="py-5">
                <div class="row g-4 align-items-center">
                    <div class="col">
                        <h1 class="h3 m-0">Cài Đặt Hệ Thống</h1>
                    </div>
                    <div class="col-auto d-flex">
                        <select class="form-select me-3">
                            <option selected="">7 October, 2024</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row g-4 g-xl-5">
                <form action="{{route('cai-dat.update', $setting->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $setting->id }}">
                    <!-- Thiết Lập logo -->
                    <div id="" class=" border border-black rounded p-0" >
                        <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                            Thiết lập Logo
                        </div>
                        <hr>
                        <div class="row p-4">               
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
                        <hr class="m-0">
                        <div class="d-flex justify-content-end p-4" >
                            <button type="submit" class="btn btn-outline-warning rounded "> 
                                Lưu thiết lập
                            </button>
                        </div>
                    </div>
                    <br>
                    <!-- End thiết lập logo -->
                    <!-- Thông tin quản trị -->
                    <div id="" class=" border border-black rounded p-0" >
                        <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                            Thông tin 
                        </div>
                        <hr>
                        <div class="row p-4">               
                            <div class="col-xl-6">
                                <label for="" class="h5" >Tên thương hiệu</label><br>
                                <input type="text" class="w-100 mb-4" name="site_name" value="{{$setting->site_name}}" placeholder="Nhập tên thương hiệu của website" >
                            </div>
                            <div class="col-xl-6">
                                <label for=""  class="h5" >Email quản trị</label><br>
                                <input type="email" class="w-100 mb-4" name="support_email" value="{{$setting->support_email}}" placeholder="Nhập email quản trị của website" >
                            </div>
                            <div class="col-xl-6">
                                <label for="" class="h5" >Số điện thoại</label><br>
                                <input type="text" class="w-100 mb-4" name="phone" value="{{$setting->phone}}" placeholder="Nhập số điện thoại liên hệ cho quản trị" >
                            </div>
                            <div class="col-xl-6">
                                <label for="" class="h5" >Địa chỉ cửa hàng</label><br>
                                <input type="text" class="w-100 mb-4" name="address" value="{{$setting->address}}" placeholder="Địa chỉ cửa hàng" >
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-end p-4" >
                            <button type="submit" class="btn btn-outline-warning rounded "> 
                                Lưu thiết lập
                            </button>
                        </div>
                    </div>
                    <br>
                    <!-- End thông tin quản trị -->
                    <!-- Phí ship -->
                    <div id="" class=" border border-black rounded p-0" >
                        <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                            Phí vận chuyển đơn hàng
                        </div>
                        <hr>
                        <div class="row p-4">               
                            <div class="col-xl-6">
                                <label for="" class="h5" >Vận chuyển cho đơn hàng : trong tỉnh</label><br>
                                <div class="input-group w-100 mb-4">
                                    <input type="number" class="form-control w-80 " name="ship_cost_inner_city" value="{{ $setting->ship_cost_inner_city }}" placeholder="Phí vận chuyển trong thành phố">
                                    <span class="input-group-text w-20 ">.000 đ</span>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <label for=""  class="h5" >Vận chuyển cho đơn : toàn quốc</label><br>
                                <div class="input-group w-100 mb-4">
                                    <input type="number" class="form-control w-80 " name="ship_cost_nationwide" value="{{$setting->ship_cost_nationwide}}" placeholder="Phí vận chuyển toàn quốc">
                                    <span class="input-group-text w-20 ">.000 đ</span>
                                </div>
                            </div>
                        </div>
                        <hr class="m-0">
                        <div class="d-flex justify-content-end p-4" >
                            <button type="submit" class="btn btn-outline-warning rounded "> 
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
    <!-- sa-app__body / end -->

@endsection