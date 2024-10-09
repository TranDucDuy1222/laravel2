<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class addBinhLuan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $randtime = mt_rand(2023, 2024).'-'. mt_rand(1,9) .'-'. mt_rand(1,28) ." 23:59:59";
        $randIdsp = mt_rand(51,59);
        $randIdUser = Arr::random([1,3]);
        $comments = [
            'Sản phẩm rất tốt, tôi rất hài lòng.',
            'Giao hàng nhanh chóng, chất lượng sản phẩm tuyệt vời.',
            'Đóng gói cẩn thận, sản phẩm đúng như mô tả.',
            'Giá cả hợp lý, sẽ ủng hộ lần sau.',
            'Sản phẩm không như mong đợi, cần cải thiện.',
            'Dịch vụ khách hàng tốt, phản hồi nhanh.',
            'Sản phẩm bị lỗi, nhưng đã được đổi trả nhanh chóng.',
            'Màu sắc đẹp, chất liệu tốt.',
            'Sản phẩm dễ sử dụng, rất tiện lợi.',
            'Giao hàng chậm, nhưng sản phẩm ổn.',
            'Sản phẩm không đúng màu, nhưng chất lượng tốt.',
            'Rất hài lòng với sản phẩm này.',
            'Sản phẩm bị hỏng khi nhận, nhưng đã được hỗ trợ đổi trả.',
            'Chất lượng sản phẩm vượt mong đợi.',
            'Sản phẩm đẹp, đúng như hình ảnh.',
            'Giao hàng nhanh, sản phẩm chất lượng.',
            'Sản phẩm không như mô tả, nhưng vẫn chấp nhận được.',
            'Dịch vụ tốt, sản phẩm chất lượng.',
            'Sản phẩm rất đáng tiền.',
            'Sẽ tiếp tục mua hàng ở đây.'
        ];

        $commentsData = [
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
            ['id_sp' => $randIdsp, 'id_user' => $randIdUser, 'noi_dung' => Arr::random($comments), 'thoi_diem' => $randtime, 'an_hien' => Arr::random([1, 0])],
        ];

        DB::table('danh_gia')->insert($commentsData);
    }
}
