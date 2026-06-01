<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@clinic.com',
        ]);

        User::factory(5)->create();

        // Call seeders
        $this->call([
            PatientSeeder::class,
            DoctorSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
