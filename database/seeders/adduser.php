<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class adduser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(1)->create([
            'name' => 'Duy',
            'email' => 'ducduytv30@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 1
        ]);
        User::factory(1)->create([
            'name' => 'Đức Duy',
            'email' => 'ducduytdd30@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 0
        ]);
        User::factory(1)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 1
        ]);
    }
}
