<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([[
            'banner_dung_sale' => 'bannerd2.png', 
            'banner_dung_cms' => 'bannercms4.png', 
            'logo_sale' => 'sale.png', 
            'logo_cms' => 'logocs1.png',
            ],
        ]);
    }
}
