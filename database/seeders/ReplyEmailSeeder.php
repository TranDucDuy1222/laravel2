<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReplyEmailSeeder extends Seeder
{
    public function run()
    {
        DB::table('reply_email')->insert([
            [
                'email' => 'hungnnps30324@fpt.edu.vn',
                'ho_ten' => 'Ngọc Hưng',
                'noi_dung' => 'Nội dung phản hồi của Hưng.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'tuannguyen.pham120104@gmail.com',
                'ho_ten' => 'Pham Tuan Nguyen',
                'noi_dung' => 'Nội dung phản hồi của Tuấn Nguyên.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Thêm nhiều dữ liệu mẫu hơn nếu cần
        ]);
    }
}
