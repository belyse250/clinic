<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        $totalPatients = Patient::count();
        $totalDoctors = Doctor::count();
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        
        $recentAppointments = Appointment::with('patient', 'doctor')
            ->latest('appointment_date')
            ->limit(5)
            ->get();
        
        $upcomingAppointments = Appointment::with('patient', 'doctor')
            ->where('appointment_date', '>=', now())
            ->where('status', '!=', 'cancelled')
            ->orderBy('appointment_date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalPatients',
            'totalDoctors',
            'totalAppointments',
            'pendingAppointments',
            'recentAppointments',
            'upcomingAppointments'
        ));
    }
}
