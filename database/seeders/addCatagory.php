<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class addCatagory extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ten_dm' => 'Áo', 'an_hien' => '1'],
            ['ten_dm' => 'Giày', 'an_hien' => '1'],
            ['ten_dm' => 'Quần', 'an_hien' => '1'],
            ['ten_dm' => 'Nam', 'an_hien' => '1'],
            ['ten_dm' => 'Nữ', 'an_hien' => '1'],
            ['ten_dm' => 'Trẻ em', 'an_hien' => '1'],
        ];

        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_dm'], '-');
        }

        DB::table('danh_muc')->insert($data);
    }
}
