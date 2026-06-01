@extends('layouts.app')

@section('title', 'Doctors')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h1>Doctors</h1>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('doctors.create') }}" class="btn btn-success">Add New Doctor</a>
    </div>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Specialization</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Appointments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->doctor_id }}</td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialization }}</td>
                        <td>{{ $doctor->phone ?? 'N/A' }}</td>
                        <td>{{ $doctor->email ?? 'N/A' }}</td>
                        <td>{{ $doctor->appointments->count() }}</td>
                        <td>
                            <a href="{{ route('doctors.show', $doctor) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('doctors.edit', $doctor) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No doctors found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center mt-4">
    {{ $doctors->links() }}
</div>
@endsection
