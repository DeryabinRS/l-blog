<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserRole;
use App\UserStatus;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('qweqweqwe'),
            'role' => UserRole::SUPER_ADMIN,
            'status' => UserStatus::ACTIVE,
        ]);
    }
}
