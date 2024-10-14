@extends('admin.layoutadmin')
@section('title')
Quản Trị Trang Chủ
@endsection

@section('content')
<div class="sa-app__body bg-white" style="height: 100%;">
    <div class="p-5">
        <h3>
            Trang chủ
        </h3>
        <div class="row">
            <div class="col-xl-2">
                <button class="btclick w-100 border border-light-subtle rounded "
                    style="height: 45px; background-color: white;" onclick="scrollToSection('banner-section')">
                    Biểu ngữ
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('slogan-section')">
                    Khẩu hiệu
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('gioithieu-section')">
                    Giới thiệu sản phẩm
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('xuhuong-section')">
                    Xu hướng
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('danhmuc-section')">
                    Danh mục
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('khuyenmai-section')">
                    Khuyến mãi
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('productnew-section')">
                    Sản phẩm mới
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('bieunguphu-section')">
                    Biểu ngữ phụ
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('commingsoon-section')">
                    Sản phẩm sắp về hàng
                </button>
                <button class="btclick w-100 border border-light-subtle rounded"
                    style="height: 45px; background-color: white;" onclick="scrollToSection('member-section')">
                    Lợi ích thành viên
                </button>
                <button class="btclick w-100 border border-warning rounded mt-4"
                    style="height: 45px; background-color: white;">
                    <i class="fa-solid fa-hand-point-down"></i>
                    Xem trước trang chủ
                </button>
            </div>
            <div class="col-xl-10 scrollable-content">
                <!-- Banner -->
                <div id="banner-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Biểu ngữ
                    </div>
                    <hr>
                    <div class="row p-4">               
                        <div class="col-xl-6">
                            <label for="" class="h5" >Hình biểu ngữ quảng cáo đầu</label><br>
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <label for="" >Biểu ngữ chính </label><br>
                            <input type="text" class="w-100" >
                            <div class="d-flex justify-content-start align-items-center p-2">
                                <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                <input type="color" id="favcolor" name="favcolor" value="#ff0000">
                            </div>
                            <br>
                            <label for="" >Biểu ngữ phụ </label><br>
                            <input type="text" class="w-100">
                        </div>
                        <div class="col-xl-6">
                            <label for=""  class="h5" >Hình biểu ngữ quảng cáo cuối</label><br>
                            <img src="/uploads/banner/banner2.jpg" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <label for="" >Biểu ngữ chính </label><br>
                            <input type="text" class="w-100" >
                            <div class="d-flex justify-content-start align-items-center p-2">
                                <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                <input type="color" id="favcolor" name="favcolor" value="#ff0000">
                            </div>
                            <br>
                            <label for="" >Biểu ngữ phụ </label><br>
                            <input type="text" class="w-100">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End banner -->
                <!-- Khẩu hiệu -->
                <div id="slogan-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Khẩu hiệu
                    </div>
                    <hr>
                    <div class="p-4">               
                        <label for="" class="h5">Khẩu hiệu chính</label><br>
                        <input type="text" class="w-100 mb-4" placeholder="Nhập khẩu hiệu chính của website">
                        <label for=""><strong>Khẩu hiệu phụ</strong></label><br>
                        <input type="text" class="w-100" placeholder="Nhập khẩu hiệu phụ của website"><br>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End khẩu hiệu -->
                <!-- Giới thiệu sản phẩm -->
                <div id="gioithieu-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Giới thiệu sản phẩm
                    </div>
                    <hr>
                    <div class="p-4">               
                        <label for="" class="h5">Tiêu đề chính</label><br>
                        <input type="text" class="w-100" placeholder="Ví dụ : Bộ sưu tập mới ra mắt">
                    </div>
                    <div class="row p-4">               
                        <div class="col-xl-6">
                            <label for="" class="h5" >Ảnh chính</label><br>
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                        </div>
                        <div class="col-xl-6">
                            <label for=""  class="h5" >Hình phụ (Hình chữ nhật)</label><br>
                            <img src="/uploads/banner/banner2.jpg" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End giới thiệu sản phẩm -->
                <!-- Xu hướng -->
                <div id="xuhuong-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Xu hướng
                    </div>
                    <hr>
                    <div class="row p-4"> 
                        <div class="col-xl-6 col-md-12">
                        <h5>Tiêu Đề Chính</h5>
                        <input type="text" class="w-100" placeholder="SẢN PHẨM XU HƯỚNG">
                        </div>
                        <div class="col-xl-6 col-md-12">
                        <h5>Tiêu Đề Phụ</h5>
                        <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
                        </div>
                        
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End xu hướng -->
                <!-- Danh mục sản phẩm -->
                <div id="danhmuc-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Danh mục sản phẩm
                    </div>
                    <hr>
                    <div class="row p-4"> 
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="SẢN PHẨM XU HƯỚNG">
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM BÁN CHẠY NHẤT NĂM">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End danh mục sản phẩm -->
                <!-- Khuyến mãi sản phẩm -->
                <div id="khuyenmai-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Chương trình khuyến mãi
                    </div>
                    <hr>
                    <div class="row p-4"> 
                        <div class="col-xl-6 col-md-12">
                        <h5>Tiêu Đề Chính</h5>
                        <input type="text" class="w-100" placeholder="SẢN PHẨM CÓ KHUYẾN MÃI">
                        </div>
                        <div class="col-xl-6 col-md-12">
                        <h5>Tiêu Đề Phụ</h5>
                        <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
                        </div>
                        
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End khuyến mãi sản phẩm -->
                <!-- Sản phẩm mới -->
                <div id="productnew-section" class=" border rounded p-0">
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;">
                        Sản phẩm mới
                    </div>
                    <hr>
                    <div class="row p-4">
                        <div class="col-xl-6 col-md-12">
                            <h5>Tiêu Đề Chính</h5>
                            <input type="text" class="w-100" name="tieu_de_san_pham_moi_chinh" placeholder="SẢN PHẨM MỚI" value="{{ $landingPage->tieu_de_san_pham_moi_chinh ?? '' }}">
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <h5>Tiêu Đề Phụ</h5>
                            <input type="text" class="w-100" name="tieu_de_san_pham_moi_phu" placeholder="CÁC SẢN PHẨM MỚI VỀ HÀNG" value="{{ $landingPage->tieu_de_san_pham_moi_phu ?? '' }}">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-outline-warning rounded">Lưu thiết lập</button>
                    </div>
                </div>
                <br>
                <!-- End sản phẩm mới -->
                <!-- Banner phụ -->
                <div id="bieunguphu-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Biểu ngữ phụ
                    </div>
                    <hr>
                    <div class="row p-4">
                        <div class="col-xl-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                        </div>
                        
                        <div class="col-xl-12 col-md-12">
                            <hr>
                            <h5>Tiêu Đề Chính</h5>
                            <input type="text" class="w-100" placeholder="SẢN PHẨM CÓ KHUYẾN MÃI">
                            <div class="d-flex justify-content-start align-items-center p-2">
                                <label for="favcolor" class="me-2"> <strong>Chọn màu cho tiêu đề chính :</strong> </label>
                                <input type="color" id="favcolor" name="favcolor" value="#ff0000">
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-12 mt-3">
                            <h5>Tiêu Đề Phụ</h5>
                            <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
                        </div>
                        <div class="col-xl-12 col-md-12 mt-3">
                            <h5>Mô tả</h5>
                            <input type="text" class="w-100" placeholder="CÁC SẢN PHẨM KHUYẾN MÃI 10/10">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End banner phụ -->
                <!-- Sản phẩm sắp về hàng -->
                <div id="commingsoon-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Sản phẩm sắp về hàng
                    </div>
                    <hr>
                    <div class="row p-4">
                    <div class="col-xl-6 col-md-12">
                            <h5>Tiêu Đề Chính</h5>
                            <input type="text" class="w-100" placeholder="SẢN PHẨM SẮP VỀ HÀNG">
                        </div>
                        <div class="col-xl-6 col-md-12">
                            <h5>Tiêu Đề Phụ</h5>
                            <input type="text" class="w-100" placeholder="BỘ SƯU TẬP NIKE THU ĐÔNG">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End sản phẩm sắp về hàng -->
                <!-- Lợi ích thành viên -->
                <div id="member-section" class=" border rounded p-0" >
                    <div class="mt-3 p-2 h4" style="border-left: 3px solid #ffd434;" >
                        Lợi ích thành viên
                    </div>
                    <hr>
                    <div class="row p-4"> 
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="Ngày kỉ niệm">
                            <h5>Nội dung nút</h5>
                            <input type="text" class="w-100" placeholder="Tìm hiểu thêm">
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="Dịch vụ cho bạn">
                            <h5>Nội dung nút</h5>
                            <input type="text" class="w-100" placeholder="Xem thêm">
                        </div>
                        <div class="col-xl-4 col-md-12">
                            <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <h5>Tiêu Đề</h5>
                            <input type="text" class="w-100" placeholder="Cộng đồng sneaker cho bạn">
                            <h5>Nội dung nút</h5>
                            <input type="text" class="w-100" placeholder="Khám phá">
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="d-flex justify-content-end p-4" >
                        <button class="btn btn-outline-warning rounded "> 
                            Lưu thiết lập
                        </button>
                    </div>
                </div>
                <br>
                <!-- End lợi ích thành viên -->
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll(".btclick").forEach(function (button) {
        button.addEventListener("click", function () {
            // Đặt tất cả các nút về màu trắng
            document.querySelectorAll(".btclick").forEach(function (btn) {
                btn.style.backgroundColor = "white";
                btn.style.color = "black";
            });
            // Đổi màu nút được nhấp
            this.style.backgroundColor = "black";
            this.style.color = "white";
        });
    });
    function scrollToSection(sectionId) {
        const section = document.getElementById(sectionId);
        const container = section.closest('.scrollable-content');
        container.scrollTo({
            top: section.offsetTop,
            behavior: 'smooth'
        });
    }
</script>
@endsection