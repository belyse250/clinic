@extends('layouts.app')

@section('title', 'Appointment Details')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Appointment Details</h1>
            <div>
                <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Appointment Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Appointment ID:</strong> {{ $appointment->appointment_id }}</p>
                        <p><strong>Date & Time:</strong> {{ $appointment->appointment_date->format('M d, Y H:i') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : ($appointment->status == 'completed' ? 'info' : 'warning')) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Patient Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $appointment->patient->name }}</p>
                        <p><strong>Phone:</strong> {{ $appointment->patient->phone }}</p>
                        <p><strong>Email:</strong> {{ $appointment->patient->email ?? 'N/A' }}</p>
                        <a href="{{ route('patients.show', $appointment->patient) }}" class="btn btn-sm btn-info">View Patient</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5>Doctor Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $appointment->doctor->name }}</p>
                        <p><strong>Specialization:</strong> {{ $appointment->doctor->specialization }}</p>
                        <p><strong>Phone:</strong> {{ $appointment->doctor->phone ?? 'N/A' }}</p>
                        <a href="{{ route('doctors.show', $appointment->doctor) }}" class="btn btn-sm btn-info">View Doctor</a>
                    </div>
                </div>
            </div>
        </div>

        @if($appointment->notes)
            <div class="card">
                <div class="card-header">
                    <h5>Notes</h5>
                </div>
                <div class="card-body">
                    {{ $appointment->notes }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
