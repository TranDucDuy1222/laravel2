<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;
class addLoai1 extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ten_loai' => 'Phụ kiện', 'an_hien' => '1']
        ];
        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_loai'], '-');
        }
        DB::table('loai')->insert($data);
    }
}
