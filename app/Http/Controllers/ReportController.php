<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a daily report of the clinic's operations.
     */
    public function daily(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        $carbonDate = Carbon::parse($date);

        // Fetch all appointments for the date
        $appointments = Appointment::with('patient', 'doctor')
            ->whereDate('appointment_date', $date)
            ->orderBy('appointment_date')
            ->get();

        // Calculate summary stats
        $totalAppointments = $appointments->count();
        $completedAppointments = $appointments->where('status', 'completed')->count();
        $confirmedAppointments = $appointments->where('status', 'confirmed')->count();
        $pendingAppointments = $appointments->where('status', 'pending')->count();
        $cancelledAppointments = $appointments->where('status', 'cancelled')->count();
        
        // Unique patients served today
        $uniquePatients = $appointments->pluck('patient_id')->unique()->count();

        // Doctors workload (appointments count per doctor)
        $doctorActivity = Appointment::whereDate('appointment_date', $date)
            ->select('doctor_id', DB::raw('count(*) as total'))
            ->groupBy('doctor_id')
            ->with('doctor')
            ->orderBy('total', 'desc')
            ->get();

        // Specializations seen today
        $specializationActivity = DB::table('appointments')
            ->join('doctors', 'appointments.doctor_id', '=', 'doctors.doctor_id')
            ->whereDate('appointments.appointment_date', $date)
            ->select('doctors.specialization', DB::raw('count(*) as total'))
            ->groupBy('doctors.specialization')
            ->orderBy('total', 'desc')
            ->get();

        return view('reports.daily', compact(
            'appointments',
            'date',
            'carbonDate',
            'totalAppointments',
            'completedAppointments',
            'confirmedAppointments',
            'pendingAppointments',
            'cancelledAppointments',
            'uniquePatients',
            'doctorActivity',
            'specializationActivity'
        ));
    }
}
