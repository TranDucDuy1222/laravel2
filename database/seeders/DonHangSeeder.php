<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DonHangSeeder extends Seeder
{
    public function run()
    {
        $orders = [];
        $orderDetails = [];
        $products = DB::table('san_pham')->get(); // Lấy tất cả sản phẩm
        $sizes = DB::table('sizes')->get(); // Lấy tất cả kích thước

        // Tạo 100 đơn hàng
        for ($i = 1; $i <= 100; $i++) {
            // Tạo ngày ngẫu nhiên
            $date = Carbon::createFromDate(rand(2021, 2024), rand(1, 12), rand(1, 28));

            $tongDonHang = rand(1000000, 10000000);

            // Thêm đơn hàng vào bảng 'don_hang'
            $orders[] = [
                'id_user' => rand(1, 3), // Lấy ngẫu nhiên ID user
                'thoi_diem_mua_hang' => $date,
                'id_dc' => rand(1, 5), // Địa chỉ giao hàng ngẫu nhiên
                'tong_dh' => $tongDonHang,
                'pttt' => ['COD', 'Chuyển khoản'][rand(0, 1)],
                'trang_thai' => rand(0, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Chèn chi tiết đơn hàng, tạo từ 1 đến 3 sản phẩm cho mỗi đơn hàng
            $numProducts = rand(1, 3);  // Số sản phẩm ngẫu nhiên từ 1 đến 3 cho mỗi đơn hàng

            foreach (range(1, $numProducts) as $j) {
                $product = $products->random(); // Chọn ngẫu nhiên một sản phẩm
                $productSizes = $sizes->where('id_product', $product->id); // Lọc kích thước của sản phẩm

                if ($productSizes->isEmpty()) {
                    continue; // Nếu không có kích thước, bỏ qua sản phẩm này
                }

                $size = $productSizes->random()->size_product ?? 'L'; // Chọn ngẫu nhiên kích thước
                $quantity = rand(1, 5);  // Số lượng ngẫu nhiên từ 1 đến 5
                $price = $product->gia_km; // Lấy giá sản phẩm

                $orderDetails[] = [
                    'id_dh' => $i,  // Mã đơn hàng
                    'id_sp' => $product->id,  // Mã sản phẩm (truyền id sản phẩm)
                    'so_luong' => $quantity,
                    'id_size' => $size,
                    'gia' => $price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Chèn các đơn hàng vào bảng 'don_hang'
        DB::table('don_hang')->insert($orders);

        // Chèn các chi tiết đơn hàng vào bảng 'chi_tiet_don_hang'
        DB::table('chi_tiet_don_hang')->insert($orderDetails);
    }
}
