@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card overflow-hidden">
            <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=1200&h=350&fit=crop" class="card-img" alt="Clinic Services" style="height: 350px; object-fit: cover;">
            <div class="card-img-overlay d-flex align-items-center">
                <div class="card-body text-white">
                    <h1 class="card-title mb-2">Clinic Management Dashboard</h1>
                    <p class="card-text">Comprehensive Healthcare Management System</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Patients</h5>
                <h2 class="text-primary">{{ \App\Models\Patient::count() }}</h2>
                <a href="{{ route('patients.index') }}" class="btn btn-primary btn-sm mt-2">View Patients</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Doctors</h5>
                <h2 class="text-success">{{ \App\Models\Doctor::count() }}</h2>
                <a href="{{ route('doctors.index') }}" class="btn btn-success btn-sm mt-2">View Doctors</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Total Appointments</h5>
                <h2 class="text-warning">{{ \App\Models\Appointment::count() }}</h2>
                <a href="{{ route('appointments.index') }}" class="btn btn-warning btn-sm mt-2">View Appointments</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Today's Appointments</h5>
                <h2 class="text-info">{{ \App\Models\Appointment::whereDate('appointment_date', now())->count() }}</h2>
                <a href="{{ route('appointments.daily') }}" class="btn btn-info btn-sm mt-2">View Today</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <h3>Quick Actions</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="{{ route('patients.create') }}" class="btn btn-primary w-100">
            <i class="bi bi-person-plus"></i> Add New Patient
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('doctors.create') }}" class="btn btn-success w-100">
            <i class="bi bi-person-badge"></i> Add New Doctor
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('appointments.create') }}" class="btn btn-warning w-100">
            <i class="bi bi-calendar-plus"></i> Schedule Appointment
        </a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('appointments.daily') }}" class="btn btn-info w-100">
            <i class="bi bi-calendar-day"></i> Daily Schedule
        </a>
    </div>
</div>
@endsection
