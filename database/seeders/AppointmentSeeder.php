<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        $statuses = ['pending', 'confirmed', 'completed', 'cancelled'];

        foreach (range(1, 30) as $i) {
            Appointment::create([
                'patient_id' => $patients->random()->patient_id,
                'doctor_id' => $doctors->random()->doctor_id,
                'appointment_date' => now()->addDays(rand(1, 60))->setHour(rand(9, 17))->setMinute(0),
                'status' => collect($statuses)->random(),
                'notes' => collect([null, 'Regular checkup', 'Follow-up visit', 'Emergency appointment'])->random(),
            ]);
        }
    }
}
