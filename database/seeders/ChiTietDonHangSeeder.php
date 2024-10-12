<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ChiTietDonHangSeeder extends Seeder
{
    public function run(): void
    {
        $products = DB::table('san_pham')->select('id', 'gia_km')->get()->keyBy('id');
        $sizes = DB::table('sizes')->select('id', 'id_product', 'size_product')->get();

        $data = [
            // Chi tiết cho đơn hàng 1
            [
                'id_dh' => 1,
                'id_sp' => 1,
                'so_luong' => 2,
                'gia' => $products[1]->gia_km,
                'size' => $sizes->where('id_product', 1)->random()->size_product,
            ],
            [
                'id_dh' => 1,
                'id_sp' => 2,
                'so_luong' => 1,
                'gia' => $products[2]->gia_km,
                'size' => $sizes->where('id_product', 2)->random()->size_product,
            ],
            // Chi tiết cho đơn hàng 2
            [
                'id_dh' => 2,
                'id_sp' => 3,
                'so_luong' => 3,
                'gia' => $products[3]->gia_km,
                'size' => $sizes->where('id_product', 3)->random()->size_product,
            ],
            [
                'id_dh' => 2,
                'id_sp' => 1,
                'so_luong' => 1,
                'gia' => $products[1]->gia_km,
                'size' => $sizes->where('id_product', 1)->random()->size_product,
            ],
            // Chi tiết cho đơn hàng 3
            [
                'id_dh' => 3,
                'id_sp' => 2,
                'so_luong' => 2,
                'gia' => $products[2]->gia_km,
                'size' => $sizes->where('id_product', 2)->random()->size_product,
            ],
            [
                'id_dh' => 3,
                'id_sp' => 3,
                'so_luong' => 1,
                'gia' => $products[3]->gia_km,
                'size' => $sizes->where('id_product', 3)->random()->size_product,
            ],
            // Chi tiết cho đơn hàng 4
            [
                'id_dh' => 4,
                'id_sp' => 1,
                'so_luong' => 4,
                'gia' => $products[1]->gia_km,
                'size' => $sizes->where('id_product', 1)->random()->size_product,
            ],
            [
                'id_dh' => 4,
                'id_sp' => 3,
                'so_luong' => 2,
                'gia' => $products[3]->gia_km,
                'size' => $sizes->where('id_product', 3)->random()->size_product,
            ],
            // Chi tiết cho đơn hàng 5
            [
                'id_dh' => 5,
                'id_sp' => 2,
                'so_luong' => 1,
                'gia' => $products[2]->gia_km,
                'size' => $sizes->where('id_product', 2)->random()->size_product,
            ],
            [
                'id_dh' => 5,
                'id_sp' => 3,
                'so_luong' => 3,
                'gia' => $products[3]->gia_km,
                'size' => $sizes->where('id_product', 3)->random()->size_product,
            ],
        ];
        
        DB::table('chi_tiet_don_hang')->insert($data);
    }
}
