<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Guest',
            'email' => 'guest@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Super User',
            'email' => 'superuser@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Super Guest',
            'email' => 'superguest@test.com',
            'password' => Hash::make('123456789'),
            'role' => 'user'
        ]);
    }
}
