<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RestaurantCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        // Create 20 customers
        for ($i = 0; $i < 20; $i++) {
            Customer::create([
                'name' => $faker->name(),
                'phone' => '078' . $faker->numerify('#######'),
                'email' => $faker->email(),
                'address' => $faker->address(),
                'status' => 'active',
            ]);
        }
    }
}
