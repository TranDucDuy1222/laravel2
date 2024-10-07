<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class addSanPham extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data= [
            ['ten_sp' => 'Nike Air Max 1', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 2, 'hinh' => 'nikeair1.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Air Max 1', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 2, 'hinh' => 'nikeair2.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Air Max 1 SE', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 2, 'hinh' => 'nikeair4.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Nike Air 4', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 2, 'hinh' => 'nikeair1.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Nike Air Max 2', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 1, 'hinh' => 'nikeair1.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Air Max 2', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 1, 'hinh' => 'nikeair2.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Air Max 2 SE', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 1, 'hinh' => 'nikeair4.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
            ['ten_sp' => 'Nike Air 2', 'gia' => '4000000', 'gia_km' => '3900000', 'id_dm' => 1, 'hinh' => 'nikeair1.png','color'=>'Đen','tinh_chat'=>0,'ngay' => Now()],
        ];
        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_sp'], '-');
        }
        DB::table('san_pham')->insert($data);

        DB::table('langdingpage')->insert([
            ['content_header' => 'Giao hàng miễn phí', 'imgheader' => 'banner1.png', 'content_1' => 'Áp dụng cho đơn hàng từ 5.000.000₫ trở lên.','content_2' => 'NIKE AIR MAX DN','content_3' => 'Thế hệ tiếp theo của công nghệ Air sắp ra mắt vào ngày 26/03.'],
            ['content_header' => '20 NĂM THỰC HIỆN', 'imgheader' => 'banner3.jpg', 'content_1' => 'Bộ sưu tập EK Umoja','content_2' => 'MUA SẮM NGAY','content_3' => 'Trở thành thành viên của chúng tôi để có những mã giảm giá.'],

        ]);

    }
}
