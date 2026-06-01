<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::with('appointments')->paginate(10);
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:patients',
            'email' => 'nullable|email|unique:patients',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        Patient::create($validated);

        return redirect()->route('patients.index')
                        ->with('success', 'Patient created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load('appointments.doctor');
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:patients,phone,' . $patient->patient_id . ',patient_id',
            'email' => 'nullable|email|unique:patients,email,' . $patient->patient_id . ',patient_id',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
        ]);

        $patient->update($validated);

        return redirect()->route('patients.show', $patient)
                        ->with('success', 'Patient updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
                        ->with('success', 'Patient deleted successfully.');
    }
}
