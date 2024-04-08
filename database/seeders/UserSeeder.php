<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AdminModel;
use App\Models\PelamarModel;
use App\Models\PimpinanModel;
use App\Models\StaffModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Admin'
        ]);
        User::create([
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Staff'
        ]);
        User::create([
            'email' => 'pimpinan@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'Pimpinan'
        ]);
        User::create([
            'email' => 'pelamar@gmail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => '2024-03-28 11:07:30',
            'role' => 'Pelamar'
        ]);
        AdminModel::create([
            'nama' => 'Admin 1',
            'user_id' => 1,
        ]);
        StaffModel::create([
            'nama' => 'Staff 1',
            'user_id' => 2,
        ]);
        PimpinanModel::create([
            'nama' => 'Pimpinan 1',
            'user_id' => 3,
        ]);
        PelamarModel::create([
            'nama' => 'Pelamar 1',
            'user_id' => 4,
        ]);
    }
}
