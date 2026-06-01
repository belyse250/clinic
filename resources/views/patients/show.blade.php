@extends('layouts.app')

@section('title', 'Patient Details')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Patient Details</h1>
            <div>
                <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('patients.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Personal Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $patient->name }}</p>
                        <p><strong>Phone:</strong> {{ $patient->phone }}</p>
                        <p><strong>Email:</strong> {{ $patient->email ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth?->format('M d, Y') ?? 'N/A' }}</p>
                        <p><strong>Address:</strong> {{ $patient->address ?? 'N/A' }}</p>
                        <p><strong>Member Since:</strong> {{ $patient->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Appointment History</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($patient->appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($appointment->notes, 30) ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No appointments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
