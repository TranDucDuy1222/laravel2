<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class addSizes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        $sizes = [37, 38, 39, 39.5, 40, 40.5, 41, 41.5, 42, 43];
        $products = [1, 2, 3]; // Giả sử bạn có 3 sản phẩm với ID là 1, 2, 3

        foreach ($products as $product) {
            foreach ($sizes as $size) {
                DB::table('sizes')->insert([
                    'id_product' => $product,
                    'size_product' => $size,
                    'so_luong' => $faker->numberBetween(1, 100), // Số lượng ngẫu nhiên từ 1 đến 100
                ]);
            }
        }
    }
}
