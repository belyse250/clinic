@extends('layouts.app')

@section('title', 'Patients')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Patients</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Add New Patient</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Appointments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->patient_id }}</td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->email ?? 'N/A' }}</td>
                        <td>{{ $patient->appointments->count() }}</td>
                        <td>
                            <a href="{{ route('patients.show', $patient) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('patients.edit', $patient) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('patients.destroy', $patient) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No patients found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $patients->links() }}
</div>
@endsection
