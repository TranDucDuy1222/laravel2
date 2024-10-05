<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class addLoai extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['ten_loai' => 'Áo', 'an_hien' => '1'],
            ['ten_loai' => 'Giày', 'an_hien' => '1'],
            ['ten_loai' => 'Quần', 'an_hien' => '1'],
            ['ten_loai' => 'Nam', 'an_hien' => '1'],
            ['ten_loai' => 'Nữ', 'an_hien' => '1'],
            ['ten_loai' => 'Trẻ em', 'an_hien' => '1'],
        ];
        foreach ($data as &$item) {
            $item['slug'] = Str::slug($item['ten_loai'], '-');
        }
        DB::table('loai')->insert($data);
    }
}
