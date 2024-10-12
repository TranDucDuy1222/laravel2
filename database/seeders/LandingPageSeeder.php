<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('landing_page')->insert([
            'anh_bieu_ngu_1' => 'banner1.png',
            'tieu_de_chinh_1' => 'NIKE AIR MAX DN',
            'mau_tieu_de_chinh_1' => 'white',
            'tieu_de_phu_1' => 'Thế hệ tiếp theo của công nghệ Air sắp ra mắt vào ngày 26/03.',

            'anh_bieu_ngu_2' => 'banner3.jpg',
            'tieu_de_chinh_2' => 'MUA SẮM NGAY',
            'mau_tieu_de_chinh_2' => 'white',
            'tieu_de_phu_2' => 'Trở thành thành viên của chúng tôi để có những mã giảm giá.',

            'slogan_chinh' => 'Mua sắm ngay hôm nay!',
            'slogan_phu' => 'Đừng bỏ lỡ cơ hội!',

            'tieu_de_gioi_thieu_san_pham' => 'Giới thiệu sản phẩm mới',
            'anh_chinh_gioi_thieu_san_pham' => 'bannerspnew.png',
            'anh_phu_gioi_thieu_san_pham' => 'bannerphu.png',

            'tieu_de_chinh_xu_huong' => 'Xu hướng mới',
            'tieu_de_phu_xu_huong' => 'Những sản phẩm hot nhất',

            'anh_danh_muc_1' => 'dmnike1.jpg',
            'tieu_de_danh_muc_1' => 'Danh mục P900',
            'anh_danh_muc_2' => 'dmnike2.png',
            'tieu_de_danh_muc_2' => 'Nike Pegasus',
            'anh_danh_muc_3' => 'dmnike3.jpeg',
            'tieu_de_danh_muc_3' => 'For playtime',

            'tieu_de_khuyen_mai_chinh' => 'Khuyến mãi tháng này',
            'tieu_de_khuyen_mai_phu' => 'Giảm giá đặc biệt ngày 10/10',

            'tieu_de_san_pham_moi_chinh' => 'Sản phẩm mới nhất',
            'tieu_de_san_pham_moi_phu' => 'Chỉ có tại cửa hàng chúng tôi',

            'anh_bieu_ngu_phu' => 'bannerp1.jpg',
            'tieu_de_chinh_bieu_ngu_phu' => 'Khuyến mãi đặc biệt',
            'mau_tieu_de_chinh_bieu_ngu_phu' => '#0000ff',
            'tieu_de_phu_bieu_ngu_phu' => 'Chính thức ra mắt',
            'mo_ta_bieu_ngu_phu' => 'Đừng bỏ lỡ!',
            'mau_nut_bieu_ngu_phu' => 'red',

            'tieu_de_san_pham_sap_ve' => 'SẢN PHẨM SẮP VỀ HÀNG',
            'tieu_de_phu_san_pham_sap_ve' => 'BỘ SƯU TẬP NIKE THU ĐÔNG',

            'tieu_de_thanh_vien' => 'LỢI ÍCH THÀNH VIÊN',
            'tieu_de_phu_thanh_vien' => 'Cùng nhau giảm giá',
            'anh_loi_ich_thanh_vien_1' => 'litv1.png',
            'tieu_de_loi_ich_thanh_vien_1' => 'Ngày thành viên. Kỉ niệm của bạn',
            'noi_dung_nut_1' => 'Tìm Hiểu Thêm',
            'anh_loi_ich_thanh_vien_2' => 'litv2.png',
            'tieu_de_loi_ich_thanh_vien_2' => 'Dịch vụ cho bạn',
            'noi_dung_nut_2' => 'Xem chi tiết',
            'anh_loi_ich_thanh_vien_3' => 'litv3.jpg',
            'tieu_de_loi_ich_thanh_vien_3' => 'Cộng đồng sneaker của bạn',
            'noi_dung_nut_3' => 'Khám phá',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
