<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class addSetting extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->insert([
            'logo_light' => 'logolight.png',
            'logo_dark' => 'logodark.png',
            'logo_icon' => 'iconlogo.png',
            'site_name' => 'Trendy U',
            'support_email' => 'ducduytv30@gmail.com',
            'phone' => '0979987979',
            'address' => '58 Trần Văn Dư, Phường 13, Tân Bình, TP.Hồ Chí Minh',
            'ship_cost_inner_city' => 30.000,
            'ship_cost_nationwide' => 50.000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
