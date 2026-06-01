<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with('patient', 'doctor')
                                   ->orderBy('appointment_date', 'desc')
                                   ->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    /**
     * Show daily appointments scheduling.
     */
    public function daily(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        $appointments = Appointment::with('patient', 'doctor')
                                   ->whereDate('appointment_date', $date)
                                   ->orderBy('appointment_date')
                                   ->get();
        return view('appointments.daily', compact('appointments', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'nullable|string',
        ]);

        $validated['status'] = 'pending';
        Appointment::create($validated);

        return redirect()->route('appointments.index')
                        ->with('success', 'Appointment scheduled successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load('patient', 'doctor');
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,patient_id',
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'appointment_date' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return redirect()->route('appointments.show', $appointment)
                        ->with('success', 'Appointment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
                        ->with('success', 'Appointment deleted successfully.');
    }
}
