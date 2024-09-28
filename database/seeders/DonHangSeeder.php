<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tongDonHang1 = DB::table('chi_tiet_don_hang')
            ->where('id_dh', 1)
            ->sum(DB::raw('so_luong * gia'));

        $tongDonHang2 = DB::table('chi_tiet_don_hang')
            ->where('id_dh', 2)
            ->sum(DB::raw('so_luong * gia'));

        $tongDonHang3 = DB::table('chi_tiet_don_hang')
            ->where('id_dh', 3)
            ->sum(DB::raw('so_luong * gia'));

        DB::table('don_hang')->insert([
            [
                'id_user' => 1,
                'thoi_diem_mua_hang' => now(),
                'id_dc' => 1,
                'tong_dh' => $tongDonHang1, // Tổng tiền đơn hàng dựa trên chi tiết
                'pttt' => 'Tiền mặt',
                'trang_thai' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'thoi_diem_mua_hang' => now(),
                'id_dc' => 2,
                'tong_dh' => $tongDonHang2,
                'pttt' => 'Chuyển khoản',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'thoi_diem_mua_hang' => now(),
                'id_dc' => 3,
                'tong_dh' => $tongDonHang3,
                'pttt' => 'Chuyển khoản',
                'trang_thai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
