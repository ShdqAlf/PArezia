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
    }
}
