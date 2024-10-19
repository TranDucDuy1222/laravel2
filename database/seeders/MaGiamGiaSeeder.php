<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class MaGiamGiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('magiamgia')->insert([
            [
                'code' => 'MAKM01',
                'phan_tram' => 10.00,
                'mo_ta' => 'Giảm 10% cho đơn hàng đầu tiên',
                'id_kh' => null, // Mã giảm giá này áp dụng cho tất cả
                'ma_gioi_han' => null, // Không giới hạn số lần
                'mot_nhieu' => false, // Mỗi khách hàng dùng 1 lần
                'ngay_het_han' => now()->addDays(30),
                'is_active' => true,
            ],
            [
                'code' => 'MAKM02',
                'phan_tram' => 5.00,
                'mo_ta' => 'Giảm 5% cho khách hàng thân thiết',
                'id_kh' => null, // Mã giảm giá này áp dụng cho tất cả
                'ma_gioi_han' => 5, // Chỉ sử dụng được 5 lần
                'mot_nhieu' => true, // Có thể dùng nhiều lần
                'ngay_het_han' => now()->addDays(30),
                'is_active' => true,
            ],
        ]);
    }
}
