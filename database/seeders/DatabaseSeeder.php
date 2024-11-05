<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            addCatagory::class,
            addDiaChi::class,
            addLoai::class,
            addLoai1::class,
            addSanPham::class,
            addSetting::class,
            addSizes::class,
            adduser::class,
            ChiTietDonHangSeeder::class,
            DonHangSeeder::class,
            LandingPageSeeder::class,
            MaGiamGiaSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
