@extends('layouts.app')

@section('title', 'Daily Schedule')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Daily Schedule</h1>
    </div>
    <div class="col-md-6 text-end">
        <form action="{{ route('appointments.daily') }}" method="GET" class="d-flex gap-2 justify-content-end">
            <input type="date" name="date" class="form-control" style="width: auto;" value="{{ $date }}" required>
            <button type="submit" class="btn btn-primary">View</button>
            <a href="{{ route('appointments.daily') }}" class="btn btn-info">Today</a>
        </form>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="alert alert-info">
            Showing appointments for <strong>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('l, F d, Y') }}</strong>
        </div>
    </div>
</div>

<div class="row">
    @forelse($appointments as $appointment)
        <div class="col-md-4 mb-3">
            <div class="card border-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="card-title">{{ $appointment->appointment_date->format('H:i') }}</h5>
                            <p class="card-text">
                                <strong>Patient:</strong> {{ $appointment->patient->name }}<br>
                                <strong>Doctor:</strong> {{ $appointment->doctor->name }}<br>
                                <strong>Specialization:</strong> {{ $appointment->doctor->specialization }}
                            </p>
                        </div>
                        <span class="badge badge-{{ $appointment->status == 'confirmed' ? 'success' : ($appointment->status == 'cancelled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($appointment->status) }}
                        </span>
                    </div>
                    @if($appointment->notes)
                        <p class="card-text small text-muted">{{ Str::limit($appointment->notes, 50) }}</p>
                    @endif
                    <div class="mt-3">
                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-info">Details</a>
                        <a href="{{ route('appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-md-12">
            <div class="alert alert-info">
                No appointments scheduled for this day.
            </div>
        </div>
    @endforelse
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <a href="{{ route('appointments.create') }}" class="btn btn-warning">Schedule New Appointment</a>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Back to All Appointments</a>
    </div>
</div>
@endsection
