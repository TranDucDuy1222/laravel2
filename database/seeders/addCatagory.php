<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class addCatagory extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ten_dm' => 'Air Force 1', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
            ['ten_dm' => 'Air Max', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
            ['ten_dm' => 'Air Jordan', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
            ['ten_dm' => 'Dunk', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
            ['ten_dm' => 'Blazer', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
            ['ten_dm' => 'Clothing', 'an_hien' => '1' , 'trang_thai' => '0' , 'id_loai' => '2'],
        ];
        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_dm'], '-');
            DB::table('danh_muc')->updateOrInsert(
                ['ten_dm' => $item['ten_dm']], // Điều kiện để tìm bản ghi hiện có
                [
                    'trang_thai' => $item['trang_thai'],
                    'id_loai' => $item['id_loai']
                ] // Dữ liệu để cập nhật hoặc chèn mới
            );
        }
        

        DB::table('danh_muc')->insert($data);
    }
}
