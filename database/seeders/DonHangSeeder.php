<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = [];
        $numOrders = 100; // Số lượng đơn hàng cần tạo

        for ($i = 1; $i <= $numOrders; $i++) {
            // Tạo ngày tháng năm ngẫu nhiên
            $year = rand(2021, 2024); // Năm ngẫu nhiên từ 2021 đến 2024
            $month = rand(1, 12); // Tháng từ 1 đến 12
            $day = rand(1, 28); // Ngày từ 1 đến 28 (để tránh lỗi ngày)

            $date = \Carbon\Carbon::createFromDate($year, $month, $day);

            $tongDonHang = rand(1000000, 10000000);
            $orders[] = [
                'id_user' => rand(1, 5),
                'thoi_diem_mua_hang' => $date,
                'id_dc' => rand(1, 5),
                'tong_dh' => $tongDonHang,
                'pttt' => ['Tiền mặt', 'Chuyển khoản'][rand(0, 1)],
                'trang_thai' => rand(0, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('don_hang')->insert($orders);
    }
}
