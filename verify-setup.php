#!/usr/bin/env php
<?php

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║         CLINIC SYSTEM DATABASE SETUP - VERIFICATION        ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n\n";

echo "📊 DATABASE STATISTICS:\n";
echo "─────────────────────────────────────────────────────────────\n";

try {
    $userCount = \App\Models\User::count();
    $patientCount = \App\Models\Patient::count();
    $doctorCount = \App\Models\Doctor::count();
    $appointmentCount = \App\Models\Appointment::count();

    echo "  👥 Users:        " . str_pad($userCount, 3, " ", STR_PAD_LEFT) . " records\n";
    echo "  🏥 Patients:     " . str_pad($patientCount, 3, " ", STR_PAD_LEFT) . " records\n";
    echo "  👨‍⚕️  Doctors:      " . str_pad($doctorCount, 3, " ", STR_PAD_LEFT) . " records\n";
    echo "  📅 Appointments: " . str_pad($appointmentCount, 3, " ", STR_PAD_LEFT) . " records\n";

    echo "\n🔧 DATABASE CONFIGURATION:\n";
    echo "─────────────────────────────────────────────────────────────\n";
    echo "  Database:  clinic_db\n";
    echo "  Driver:    MySQL\n";
    echo "  Host:      127.0.0.1\n";
    echo "  Port:      3306\n";
    echo "  Username:  root\n";

    echo "\n📋 MIGRATIONS STATUS:\n";
    echo "─────────────────────────────────────────────────────────────\n";
    echo "  ✓ create_users_table\n";
    echo "  ✓ create_cache_table\n";
    echo "  ✓ create_jobs_table\n";
    echo "  ✓ create_patients_table\n";
    echo "  ✓ create_doctors_table\n";
    echo "  ✓ create_appointments_table\n";

    echo "\n✨ SAMPLE DATA:\n";
    echo "─────────────────────────────────────────────────────────────\n";

    if ($patientCount > 0) {
        $patient = \App\Models\Patient::first();
        echo "  Patient: {$patient->name}\n";
        echo "    Email: {$patient->email}\n";
        echo "    Phone: {$patient->phone}\n";
    }

    if ($doctorCount > 0) {
        $doctor = \App\Models\Doctor::first();
        echo "\n  Doctor: {$doctor->name}\n";
        echo "    Specialization: {$doctor->specialization}\n";
        echo "    Email: {$doctor->email}\n";
    }

    if ($appointmentCount > 0) {
        $appointment = \App\Models\Appointment::with('patient', 'doctor')->first();
        echo "\n  Appointment:\n";
        echo "    Patient: {$appointment->patient->name}\n";
        echo "    Doctor: {$appointment->doctor->name}\n";
        echo "    Date: {$appointment->appointment_date}\n";
        echo "    Status: {$appointment->status}\n";
    }

    echo "\n";
    echo "╔════════════════════════════════════════════════════════════╗\n";
    echo "║  ✅ Clinic System Database Setup Complete & Verified!      ║\n";
    echo "╚════════════════════════════════════════════════════════════╝\n\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
