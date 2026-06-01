@extends('layouts.app')

@section('title', 'Doctor Details')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Doctor Details</h1>
            <div>
                <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('doctors.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Professional Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> {{ $doctor->name }}</p>
                        <p><strong>Specialization:</strong> {{ $doctor->specialization }}</p>
                        <p><strong>Phone:</strong> {{ $doctor->phone ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Email:</strong> {{ $doctor->email ?? 'N/A' }}</p>
                        <p><strong>Member Since:</strong> {{ $doctor->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
                @if($doctor->bio)
                    <div class="mt-3">
                        <p><strong>Biography:</strong></p>
                        <p>{{ $doctor->bio }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5>Appointments</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctor->appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                                <td>{{ $appointment->patient->name }}</td>
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
