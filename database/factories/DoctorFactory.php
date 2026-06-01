<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specializations = [
            'Cardiology',
            'Dermatology',
            'Neurology',
            'Orthopedics',
            'Pediatrics',
            'Psychiatry',
            'General Surgery',
            'Ophthalmology',
            'Dentistry',
            'ENT',
        ];

        return [
            'name' => fake()->name(),
            'specialization' => fake()->randomElement($specializations),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'bio' => fake()->paragraph(),
        ];
    }
}
