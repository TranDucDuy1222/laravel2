<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class addSanPham extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sanpham')->insert([
            ['tensp' => 'Nike Air Max 1', 'gia' => '4000000', 'giakhuyenmai' => '3900000','soluong' => '390','anhsp' => 'nikeair1.png','ngay' => Now(), 'madm' => 2],
            ['tensp' => 'Nike Air Max 1 SE', 'gia' => '2800000', 'giakhuyenmai' => '2700000','soluong' => '100','anhsp' => 'nikeair3.png','ngay' => Now(), 'madm' => 2],
            ['tensp' => 'Air Max 1', 'gia' => '2550000', 'giakhuyenmai' => '2500000','soluong' => '90','anhsp' => 'nikeair2.png','ngay' => Now(), 'madm' => 2],
            ['tensp' => 'Air Max 1 SE', 'gia' => '2550000', 'giakhuyenmai' => '2500000','soluong' => '120','anhsp' => 'nikeair4.png','ngay' => Now(), 'madm' => 2]
        ]);

    }
}
