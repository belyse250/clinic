@extends('layouts.app')

@section('title', 'Schedule Appointment')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1 class="mb-4">Schedule New Appointment</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient</label>
                        <select class="form-control @error('patient_id') is-invalid @enderror" 
                                id="patient_id" name="patient_id" required>
                            <option value="">-- Select Patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->patient_id }}" {{ old('patient_id') == $patient->patient_id ? 'selected' : '' }}>
                                    {{ $patient->name }} ({{ $patient->phone }})
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="doctor_id" class="form-label">Doctor</label>
                        <select class="form-control @error('doctor_id') is-invalid @enderror" 
                                id="doctor_id" name="doctor_id" required>
                            <option value="">-- Select Doctor --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->doctor_id }}" {{ old('doctor_id') == $doctor->doctor_id ? 'selected' : '' }}>
                                    {{ $doctor->name }} ({{ $doctor->specialization }})
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="appointment_date" class="form-label">Appointment Date & Time</label>
                        <input type="datetime-local" class="form-control @error('appointment_date') is-invalid @enderror" 
                               id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                        @error('appointment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Schedule Appointment</button>
                        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
