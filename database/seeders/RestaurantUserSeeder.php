<?php

namespace Database\Seeders;

use App\Models\RestaurantUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RestaurantUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        RestaurantUser::create([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'name' => 'Administrator',
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Create manager user
        RestaurantUser::create([
            'username' => 'manager',
            'password' => Hash::make('password123'),
            'name' => 'Manager',
            'role' => 'manager',
            'status' => 'active',
        ]);

        // Create staff users
        RestaurantUser::create([
            'username' => 'staff1',
            'password' => Hash::make('password123'),
            'name' => 'John Staff',
            'role' => 'staff',
            'status' => 'active',
        ]);

        RestaurantUser::create([
            'username' => 'staff2',
            'password' => Hash::make('password123'),
            'name' => 'Jane Staff',
            'role' => 'staff',
            'status' => 'active',
        ]);
    }
}
