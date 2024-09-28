<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class addDiaChi extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = DB::table('users')->get();

        $diaChiData = [
            [
                'dc_chi_tiet' => '123 Đường ABC, Phường 1, Quận 1, TP. HCM',
                'phone' => '0909123456',
                'thanh_pho' => 'TP. HCM',
            ],
            [
                'dc_chi_tiet' => '456 Đường XYZ, Phường 2, Quận 2, Hà Nội',
                'phone' => '0912233445',
                'thanh_pho' => 'Hà Nội',
            ],
            [
                'dc_chi_tiet' => '789 Đường DEF, Phường 3, Quận 3, TP. Đà Nẵng',
                'phone' => '0933344555',
                'thanh_pho' => 'Đà Nẵng',
            ],
        ];

        // Tạo bản ghi địa chỉ cho mỗi người dùng tương ứng
        foreach ($users as $index => $user) {
            DB::table('dia_chi')->insert([
                'id_user' => $user->id,
                'ho_ten' => $user->name,
                'dc_chi_tiet' => $diaChiData[$index]['dc_chi_tiet'],
                'phone' => $diaChiData[$index]['phone'],
                'thanh_pho' => $diaChiData[$index]['thanh_pho'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
