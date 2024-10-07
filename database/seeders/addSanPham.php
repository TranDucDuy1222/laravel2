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
        ];
        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_sp'], '-');
        }
        DB::table('san_pham')->insert($data);


    }
}
