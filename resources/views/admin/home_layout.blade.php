@extends('admin.layoutadmin')
@section('title')
Trang chủ
@endsection
@section('content')
<div id="content-page" class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="iq-card">
                    <div class="iq-card-header d-flex justify-content-between">
                        <div class="iq-header-title">
                            <h4 class="card-title">Trang chủ</h4>
                        </div>
                    </div>
                    <div class="iq-card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="banner-section')">
                                    Biểu ngữ
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="slogan-section">
                                    Khẩu hiệu
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="gioithieu-section">
                                    Giới thiệu sản phẩm
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="xuhuong-section">
                                    Xu hướng
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="danhmuc-section">
                                    Danh mục
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="khuyenmai-section">
                                    Khuyến mãi
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="productnew-section">
                                    Sản phẩm mới
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="bieunguphu-section">
                                    Biểu ngữ phụ
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="commingsoon-section">
                                    Sản phẩm sắp về hàng
                                </button>
                                <button class="btclick w-100 border border-light-subtle rounded mb-3"
                                    style="height: 45px; background-color: white;" data-section-id="member-section">
                                    Lợi ích thành viên
                                </button>
                                <!-- Xem trước trang chủ -->
                                <button type="button" id="showModalBtn" class="btclick w-100 border border-warning rounded mt-4"
                                        style="height: 45px; background-color: white;">
                                    <i class="fa-solid fa-hand-point-down"></i>
                                    Xem trước trang chủ
                                </button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" id="modalBodyContent">
                                                <!-- Nội dung sẽ được tải vào đây -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 overflow-y-scroll" style="height: 700px;" >
                                <div class="scrollable-content">
                                    <form action="{{route('trang-chu.update', ['trang_chu' => $home_page->id])}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $home_page->id }}">
                                        <!-- Banner -->
                                        <div id="banner-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Biểu ngữ
                                            </div>
                                            <hr>
                                            <div class="row px-4">               
                                                <div class="col-xl-6">
                                                    <label for="" class="h5" >Hình biểu ngữ quảng cáo đầu</label><br>
                                                    <img src="{{ asset('/uploads/banner/'.$home_page->anh_bieu_ngu_1) }}"
                                                        onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_bieu_ngu_1">
                                                    <hr>
                                                    <label for="" >Biểu ngữ chính </label><br>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_chinh_1" value="{{$home_page->tieu_de_chinh_1}}">
                                                    <div class="d-flex justify-content-start align-items-center p-2">
                                                        <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                                        <input type="color" name="mau_tieu_de_chinh_1" value="{{$home_page->mau_tieu_de_chinh_1}}">
                                                    </div>
                                                    <br>
                                                    <label for="" >Biểu ngữ phụ </label><br>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_phu_1" value="{{$home_page->tieu_de_phu_1}}">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for=""  class="h5" >Hình biểu ngữ quảng cáo cuối</label><br>
                                                    <img src="{{ asset('/uploads/banner/'.$home_page->anh_bieu_ngu_2) }}"
                                                        onerror="this.src='{{ asset('/imgnew/banner1.png') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_bieu_ngu_2">
                                                    <hr>
                                                    <label for="" >Biểu ngữ chính </label><br>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_chinh_2" value="{{$home_page->tieu_de_chinh_2}}">
                                                    <div class="d-flex justify-content-start align-items-center p-2">
                                                        <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                                        <input type="color" name="mau_tieu_de_chinh_2" value="{{$home_page->mau_tieu_de_chinh_2}}">
                                                    </div>
                                                    <br>
                                                    <label for="" >Biểu ngữ phụ </label><br>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_phu_2" value="{{$home_page->tieu_de_phu_2}}">
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
                                        <!-- End banner -->
                                        <!-- Khẩu hiệu -->
                                        <div id="slogan-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Khẩu hiệu
                                            </div>
                                            <hr>
                                            <div class="p-4">               
                                                <label for="" class="h5">Khẩu hiệu chính</label><br>
                                                <input type="text" class="form-control mb-3" name="slogan_chinh" value="{{$home_page->slogan_chinh}}" placeholder="Nhập khẩu hiệu chính của website" >
                                                <label for=""><strong>Khẩu hiệu phụ</strong></label><br>
                                                <input type="text" class="form-control mb-3" name="slogan_phu" value="{{$home_page->slogan_phu}}" placeholder="Nhập khẩu hiệu phụ của website"><br>
                                            </div>
                                            <hr class="m-0">
                                            <div class="d-flex justify-content-end p-4" >
                                                <button type="submit" class="btn btn-outline-primary"> 
                                                    Lưu thiết lập
                                                </button>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- End khẩu hiệu -->
                                        <!-- Giới thiệu sản phẩm -->
                                        <div id="gioithieu-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Giới thiệu sản phẩm
                                            </div>
                                            <hr>
                                            <div class="p-4">               
                                                <label for="" class="h5">Tiêu đề chính</label><br>
                                                <input type="text" class="form-control mb-3" name="tieu_de_gioi_thieu_san_pham" value="{{$home_page->tieu_de_gioi_thieu_san_pham}}" placeholder="Ví dụ : Bộ sưu tập mới ra mắt">
                                            </div>
                                            <div class="row px-4">               
                                                <div class="col-xl-6">
                                                    <label for="" class="h5" >Ảnh chính</label><br>
                                                    <img src="{{ asset('/uploads/banner/'.$home_page->anh_chinh_gioi_thieu_san_pham) }}"
                                                        onerror="this.src='{{ asset('/uploads/banner/bannerspnew.png') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_chinh_gioi_thieu_san_pham">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for=""  class="h5" >Hình phụ (Hình chữ nhật)</label><br>
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_phu_gioi_thieu_san_pham) }}"
                                                        onerror="this.src='{{ asset('/uploads/banner/bannerphu.png') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_phu_gioi_thieu_san_pham">
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
                                        <!-- End giới thiệu sản phẩm -->
                                        <!-- Xu hướng -->
                                        <div id="xuhuong-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Xu hướng
                                            </div>
                                            <hr>
                                            <div class="row px-4"> 
                                                <div class="col-xl-6 col-md-12">
                                                <h5>Tiêu Đề Chính</h5>
                                                <input type="text" class="form-control mb-3" name="tieu_de_chinh_xu_huong" value="{{$home_page->tieu_de_chinh_xu_huong}}" placeholder="SẢN PHẨM XU HƯỚNG">
                                                </div>
                                                <div class="col-xl-6 col-md-12">
                                                <h5>Tiêu Đề Phụ</h5>
                                                <input type="text" class="form-control mb-3" name="tieu_de_phu_xu_huong" value="{{$home_page->tieu_de_phu_xu_huong}}" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
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
                                        <!-- End xu hướng -->
                                        <!-- Danh mục sản phẩm -->
                                        <div id="danhmuc-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Danh mục sản phẩm
                                            </div>
                                            <hr>
                                            <div class="row px-4"> 
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_1) }}"
                                                        onerror="this.src='{{ asset('/uploads/banner/dmnike1.jpg') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_danh_muc_1">
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_danh_muc_1" value="{{$home_page->tieu_de_danh_muc_1}}" placeholder="SẢN PHẨM XU HƯỚNG">
                                                </div>
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_2) }}"
                                                        onerror="this.src='{{ asset('/uploads/banner/dmnike2.png') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_danh_muc_2" >
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_danh_muc_2" value="{{$home_page->tieu_de_danh_muc_2}}" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
                                                </div>
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_danh_muc_3) }}"
                                                        onerror="this.src='{{ asset('/uploads/banner/dmnike3.jpeg') }}'" alt="" class="mb-2 w-100" style="height: 250px;">
                                                    <input type="file" name="anh_danh_muc_3">
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_danh_muc_3" value="{{$home_page->tieu_de_danh_muc_3}}" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
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
                                        <!-- End danh mục sản phẩm -->
                                        <!-- Khuyến mãi sản phẩm -->
                                        <div id="khuyenmai-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Chương trình khuyến mãi
                                            </div>
                                            <hr>
                                            <div class="row px-4"> 
                                                <div class="col-xl-6 col-md-12">
                                                <h5>Tiêu Đề Chính</h5>
                                                <input type="text" class="form-control mb-3" name="tieu_de_khuyen_mai_chinh" value="{{$home_page->tieu_de_khuyen_mai_chinh}}" placeholder="SẢN PHẨM CÓ KHUYẾN MÃI">
                                                </div>
                                                <div class="col-xl-6 col-md-12">
                                                <h5>Tiêu Đề Phụ</h5>
                                                <input type="text" class="form-control mb-3" name="tieu_de_khuyen_mai_phu" value="{{$home_page->tieu_de_khuyen_mai_phu}}" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
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
                                        <!-- End khuyến mãi sản phẩm -->
                                        <!-- Sản phẩm mới -->
                                        <div id="productnew-section" class="shadow m-1 rounded">
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;">
                                                Sản phẩm mới
                                            </div>
                                            <hr>
                                            <div class="row px-4">
                                                <div class="col-xl-6 col-md-12">
                                                    <h5>Tiêu Đề Chính</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_san_pham_moi_chinh" value="{{$home_page->tieu_de_san_pham_moi_chinh}}" name="tieu_de_san_pham_moi_chinh" placeholder="SẢN PHẨM MỚI" value="{{ $landingPage->tieu_de_san_pham_moi_chinh ?? '' }}">
                                                </div>
                                                <div class="col-xl-6 col-md-12">
                                                    <h5>Tiêu Đề Phụ</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_san_pham_moi_phu" value="{{$home_page->tieu_de_san_pham_moi_phu}}" name="tieu_de_san_pham_moi_phu" placeholder="CÁC SẢN PHẨM MỚI VỀ HÀNG" value="{{ $landingPage->tieu_de_san_pham_moi_phu ?? '' }}">
                                                </div>
                                            </div>
                                            <hr class="m-0">
                                            <div class="d-flex justify-content-end p-4">
                                                <button type="submit" class="btn btn-outline-warning rounded">Lưu thiết lập</button>
                                            </div>
                                        </div>
                                        <br>
                                        <!-- End sản phẩm mới -->
                                        <!-- Banner phụ -->
                                        <div id="bieunguphu-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Biểu ngữ phụ
                                            </div>
                                            <hr>
                                            <div class="row px-4">
                                                <div class="col-xl-12">
                                                    <img src="{{ asset('uploads/banner/'.$home_page->anh_bieu_ngu_phu) }}" alt="" class="mb-2 w-100" style="height: 500px;">
                                                    <input type="file" name="anh_bieu_ngu_phu">
                                                </div>
                                                
                                                <div class="col-xl-12 col-md-12">
                                                    <hr>
                                                    <h5>Tiêu Đề Chính</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_chinh_bieu_ngu_phu" value="{{$home_page->tieu_de_chinh_bieu_ngu_phu}}" placeholder="SẢN PHẨM CÓ KHUYẾN MÃI">
                                                    <div class="d-flex justify-content-start align-items-center p-2">
                                                        <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                                        <input type="color" name="mau_tieu_de_chinh_bieu_ngu_phu" value="{{$home_page->mau_tieu_de_chinh_bieu_ngu_phu}}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-md-12 mt-3">
                                                    <h5>Tiêu Đề Phụ</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_phu_bieu_ngu_phu" value="{{$home_page->tieu_de_phu_bieu_ngu_phu}}" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
                                                </div>
                                                <div class="col-xl-12 col-md-12 mt-3">
                                                    <h5>Mô tả</h5>
                                                    <input type="text" class="form-control mb-3" name="mo_ta_bieu_ngu_phu" value="{{$home_page->mo_ta_bieu_ngu_phu}}" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
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
                                        <!-- End banner phụ -->
                                        <!-- Sản phẩm sắp về hàng -->
                                        <div id="commingsoon-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Sản phẩm sắp về hàng
                                            </div>
                                            <hr>
                                            <div class="row px-4">
                                                <div class="col-xl-6 col-md-12">
                                                    <h5>Tiêu Đề Chính</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_san_pham_sap_ve" value="{{$home_page->tieu_de_san_pham_sap_ve}}" placeholder="SẢN PHẨM SẮP VỀ HÀNG">
                                                </div>
                                                <div class="col-xl-6 col-md-12">
                                                    <h5>Tiêu Đề Phụ</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_phu_san_pham_sap_ve" value="{{$home_page->tieu_de_phu_san_pham_sap_ve}}" placeholder="BỘ SƯU TẬP NIKE THU ĐÔNG">
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
                                        <!-- End sản phẩm sắp về hàng -->
                                        <!-- Lợi ích thành viên -->
                                        <div id="member-section" class="shadow m-1 rounded" >
                                            <div class="mt-3 p-3 h4" style="border-left: 5px solid #964B58;" >
                                                Lợi ích thành viên
                                            </div>
                                            <hr>
                                            <div class="row px-4">
                                                <div class="row mb-4">
                                                    <div class="col-xl-6 col-md-12">
                                                        <h5>Tiêu Đề Chính</h5>
                                                        <input type="text" class="form-control mb-3" name="tieu_de_thanh_vien" value="{{$home_page->tieu_de_thanh_vien}}" placeholder="Ví dụ: LỢI ÍCH THÀNH VIÊN">
                                                    </div>
                                                    <div class="col-xl-6 col-md-12">
                                                        <h5>Tiêu Đề Phụ</h5>
                                                        <input type="text" class="form-control mb-3" name="tieu_de_phu_thanh_vien" value="{{$home_page->tieu_de_phu_thanh_vien}}" placeholder="Ví dụ: Mua sắm 0đ">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_1) }}"
                                                        onerror="this.src='{{ asset('/imgnew/litv1.png') }}'" alt="" class="mb-2 w-100" style="height: 350px;">
                                                    <input type="file" name="anh_loi_ich_thanh_vien_1">
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_loi_ich_thanh_vien_1" value="{{$home_page->tieu_de_loi_ich_thanh_vien_1}}" placeholder="Ngày kỉ niệm">
                                                    <h5>Nội dung nút</h5>
                                                    <input type="text" class="form-control mb-3" name="noi_dung_nut_1" value="{{$home_page->noi_dung_nut_1}}" placeholder="Tìm hiểu thêm">
                                                </div>
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_2) }}"
                                                        onerror="this.src='{{ asset('/imgnew/litv2.png') }}'" alt="" class="mb-2 w-100" style="height: 350px;">
                                                    <input type="file" name="anh_loi_ich_thanh_vien_2">
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_loi_ich_thanh_vien_2" value="{{$home_page->tieu_de_loi_ich_thanh_vien_2}}" placeholder="Dịch vụ cho bạn">
                                                    <h5>Nội dung nút</h5>
                                                    <input type="text" class="form-control mb-3" name="noi_dung_nut_2" value="{{$home_page->noi_dung_nut_2}}" placeholder="Xem thêm">
                                                </div>
                                                <div class="col-xl-4 col-md-12">
                                                    <img src="{{ asset('/uploads/banner/'. $home_page->anh_loi_ich_thanh_vien_3) }}"
                                                        onerror="this.src='{{ asset('/imgnew/litv3.jpg') }}'" alt="" class="mb-2 w-100" style="height: 350px;">
                                                    <input type="file" name="anh_loi_ich_thanh_vien_3">
                                                    <hr>
                                                    <h5>Tiêu Đề</h5>
                                                    <input type="text" class="form-control mb-3" name="tieu_de_loi_ich_thanh_vien_3" value="{{$home_page->tieu_de_loi_ich_thanh_vien_3}}" placeholder="Cộng đồng sneaker cho bạn">
                                                    <h5>Nội dung nút</h5>
                                                    <input type="text" class="form-control mb-3" name="noi_dung_nut_3" value="{{$home_page->noi_dung_nut_3}}" placeholder="Khám phá">
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
                                        <!-- End lợi ích thành viên -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Gắn sự kiện btclick
document.querySelectorAll(".btclick").forEach(function(button) {
    button.addEventListener("click", function() {
        // Đặt tất cả các nút về màu trắng
        document.querySelectorAll(".btclick").forEach(function(btn) {
            btn.style.backgroundColor = "white";
            btn.style.color = "black";
        });
        // Đổi màu nút được nhấp
        this.style.backgroundColor = "black";
        this.style.color = "white";
        
        // Cuộn tới section tương ứng
        console.log(`Button clicked: ${this.getAttribute('data-section-id')}`);
        scrollToSection(this.getAttribute('data-section-id'));
    });
});

function scrollToSection(sectionId) {
    console.log(`Scrolling to section: ${sectionId}`);
    const section = document.getElementById(sectionId);
    if (!section) {
        console.error(`Section with ID ${sectionId} not found.`);
        return;
    }
    console.log(`Section found. Offset top: ${section.offsetTop}`);

    const container = document.querySelector('.scrollable-content');
    if (!container) {
        console.error('Scrollable content container not found.');
        return;
    }
    console.log(`Container found. Container offset top: ${container.offsetTop}`);

    container.scrollTo({
        top: section.offsetTop - container.offsetTop,
        behavior: 'smooth'
    });

    // Log thêm
    console.log(`Scrolling to: ${section.offsetTop - container.offsetTop}`);
    console.log(`Container height: ${container.clientHeight}`);
    console.log(`Section height: ${section.clientHeight}`);
}



document.getElementById('showModalBtn').addEventListener('click', function() {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    });
    myModal.show();

    // Tải nội dung cho modal khi button được nhấn
    fetch('/')
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalBodyContent').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('modalBodyContent').innerHTML = 'Có lỗi xảy ra khi tải nội dung.';
            console.error('Error:', error);
        });
});

// Dọn dẹp nội dung của modal khi nó bị đóng
document.getElementById('exampleModal').addEventListener('hidden.bs.modal', function () {
    document.getElementById('modalBodyContent').innerHTML = '';
});

</script>
@endsection
