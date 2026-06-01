@extends('layouts.app')

@section('title', 'Daily Operations Report')

@section('content')
<div class="row mb-4 align-items-center no-print">
    <div class="col-md-6">
        <h1 class="page-title"><i class="fas fa-chart-line"></i> Daily Operations Report</h1>
    </div>
    <div class="col-md-6 text-end">
        <form action="{{ route('reports.daily') }}" method="GET" class="d-inline-flex gap-2 align-items-center me-2">
            <label for="date" class="form-label mb-0 text-nowrap me-2">Report Date:</label>
            <input type="date" id="date" name="date" class="form-control" style="width: auto;" value="{{ $date }}" required>
            <button type="submit" class="btn btn-primary">Generate</button>
        </form>
        <button onclick="window.print()" class="btn btn-success">
            <i class="fas fa-print me-1"></i> Print Report
        </button>
    </div>
</div>

<!-- Print-Only Header -->
<div class="d-none d-print-block mb-5">
    <div class="row border-bottom pb-4">
        <div class="col-8">
            <h2 class="fw-bold text-primary mb-1"><i class="fas fa-hospital me-2"></i>Clinic Management System</h2>
            <p class="text-muted mb-0">Daily Performance & Operational Metrics Report</p>
        </div>
        <div class="col-4 text-end">
            <h5 class="fw-semibold text-secondary mb-1">Report Date</h5>
            <h4 class="fw-bold mb-0 text-dark">{{ $carbonDate->format('F d, Y') }}</h4>
            <span class="text-muted small">Generated on {{ now()->format('M d, Y H:i') }}</span>
        </div>
    </div>
</div>

<!-- Stats Row -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <div class="stat-number">{{ $totalAppointments }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="fas fa-user-check"></i>
            <div class="stat-number">{{ $completedAppointments + $confirmedAppointments }}</div>
            <div class="stat-label">Active / Attended</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <div class="stat-number">{{ $uniquePatients }}</div>
            <div class="stat-label">Patients Served</div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <div class="stat-number">{{ $pendingAppointments }}</div>
            <div class="stat-label">Pending Review</div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <!-- Doctor Activity -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fs-5 fw-bold"><i class="fas fa-user-md me-2"></i> Doctor Workload</span>
                <span class="badge bg-white text-primary rounded-pill">{{ $doctorActivity->count() }} Active</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 border-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="border-0 ps-4">Doctor Name</th>
                                <th class="border-0">Specialization</th>
                                <th class="border-0 text-end pe-4">Appointments</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($doctorActivity as $activity)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $activity->doctor->name }}</td>
                                    <td>{{ $activity->doctor->specialization }}</td>
                                    <td class="text-end pe-4"><span class="badge bg-primary rounded-pill">{{ $activity->total }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">No active doctors today.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Specializations Seen -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fs-5 fw-bold"><i class="fas fa-lungs me-2"></i> Specialization Breakdown</span>
                <span class="badge bg-white text-primary rounded-pill">{{ $specializationActivity->count() }} Areas</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 border-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="border-0 ps-4">Specialization</th>
                                <th class="border-0 text-end pe-4">Consultations Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($specializationActivity as $activity)
                                <tr>
                                    <td class="ps-4 fw-semibold">{{ $activity->specialization }}</td>
                                    <td class="text-end pe-4"><span class="badge bg-info rounded-pill">{{ $activity->total }}</span></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted py-4">No data reported for this date.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Ledger -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span class="fs-5 fw-bold"><i class="fas fa-list me-2"></i> Patient Schedule & Log</span>
                <span class="badge bg-white text-primary rounded-pill">{{ $appointments->count() }} Appointments</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 border-0">
                        <thead>
                            <tr class="bg-light">
                                <th class="ps-4">Time</th>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>Status</th>
                                <th>Notes Summary</th>
                                <th class="text-end pe-4 no-print">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">{{ $appointment->appointment_date->format('H:i') }}</td>
                                    <td>
                                        <div class="fw-semibold">{{ $appointment->patient->name }}</div>
                                        <div class="text-muted small">
                                            @if($appointment->patient->date_of_birth)
                                                {{ $appointment->patient->date_of_birth->age }} yrs
                                            @endif
                                            | {{ $appointment->patient->phone }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold">{{ $appointment->doctor->name }}</div>
                                        <div class="text-muted small">{{ $appointment->doctor->specialization }}</div>
                                    </td>
                                    <td>
                                        <span class="badge badge-{{ $appointment->status }}">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </td>
                                    <td class="text-muted small text-wrap" style="max-width: 250px;">
                                        {{ $appointment->notes ? Str::limit($appointment->notes, 75) : '—' }}
                                    </td>
                                    <td class="text-end pe-4 no-print">
                                        <a href="{{ route('appointments.show', $appointment) }}" class="btn btn-sm btn-outline-primary py-1 px-2">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-5">
                                        <i class="fas fa-calendar-times fs-2 mb-3 d-block text-secondary"></i>
                                        No appointments scheduled for {{ $carbonDate->format('l, F d, Y') }}.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
