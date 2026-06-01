@extends('layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Appointments</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('appointments.create') }}" class="btn btn-warning">Schedule New Appointment</a>
        <a href="{{ route('appointments.daily') }}" class="btn btn-info">Daily Schedule</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient</th>
                    <th>Doctor</th>
                    <th>Date & Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>{{ $appointment->appointment_id }}</td>
                        <td>{{ $appointment->patient->name }}</td>
                        <td>{{ $appointment->doctor->name }}</td>
                        <td>{{ $appointment->appointment_date->format('M d, Y H:i') }}</td>
                        <td>
                            <span class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : ($appointment->status == 'completed' ? 'info' : 'warning')) }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $appointments->links() }}
</div>
@endsection
