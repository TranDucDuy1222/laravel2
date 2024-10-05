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
                            <input type="text" class="w-100" ><br>
                            <label for="" >Biểu ngữ phụ </label><br>
                            <input type="text" class="w-100">
                        </div>
                        <div class="col-xl-6">
                            <label for=""  class="h5" >Hình biểu ngữ quảng cáo cuối</label><br>
                            <img src="/uploads/banner/banner2.jpg" alt="" class="mb-2 w-100" style="height: 250px;">
                            <input type="file">
                            <hr>
                            <label for="" >Biểu ngữ chính </label><br>
                            <input type="text" class="w-100" ><br>
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
                        <label for="" class="h5">Giới thiệu dòng sản phẩm</label><br>
                        <input type="text" class="w-100" placeholder="Ví dụ : Bộ sưu tập mới ra mắt">
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
                    <div class="p-4"> 
                        <label for="" class="h5" >Hình xu hướng</label><br>
                        <img src="/uploads/banner/banner1.png" alt="" class="mb-2 w-100" style="height: 250px;">  
                        <input type="file">            
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