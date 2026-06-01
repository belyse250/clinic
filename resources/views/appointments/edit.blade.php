@extends('layouts.app')

@section('title', 'Edit Appointment')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <h1 class="mb-4">Edit Appointment</h1>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('appointments.update', $appointment) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="patient_id" class="form-label">Patient</label>
                        <select class="form-control @error('patient_id') is-invalid @enderror" 
                                id="patient_id" name="patient_id" required>
                            <option value="">-- Select Patient --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->patient_id }}" {{ old('patient_id', $appointment->patient_id) == $patient->patient_id ? 'selected' : '' }}>
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
                                <option value="{{ $doctor->doctor_id }}" {{ old('doctor_id', $appointment->doctor_id) == $doctor->doctor_id ? 'selected' : '' }}>
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
                               id="appointment_date" name="appointment_date" 
                               value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d\TH:i')) }}" required>
                        @error('appointment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                            <option value="pending" {{ old('status', $appointment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $appointment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ old('status', $appointment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('status', $appointment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="4">{{ old('notes', $appointment->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning">Update Appointment</button>
                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
