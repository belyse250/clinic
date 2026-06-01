@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold">Customers</h2>
        <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Add Customer
        </a>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Phone</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $customer->name }}</td>
                        <td class="px-4 py-2">{{ $customer->phone }}</td>
                        <td class="px-4 py-2">{{ $customer->email ?? 'N/A' }}</td>
                        <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                {{ $customer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($customer->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('customers.show', $customer->cust_id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                            <a href="{{ route('customers.edit', $customer->cust_id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                            <form method="POST" action="{{ route('customers.destroy', $customer->cust_id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            No customers yet. <a href="{{ route('customers.create') }}" class="text-blue-500">Add one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
