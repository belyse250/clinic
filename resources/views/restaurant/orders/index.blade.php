@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold">Orders</h2>
        <a href="{{ route('restaurant.orders.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + New Order
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
                    <th class="px-4 py-2 text-left">Order ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-left">Total Amount</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">#{{ $order->order_id }}</td>
                        <td class="px-4 py-2">{{ $order->customer->name }}</td>
                        <td class="px-4 py-2">{{ $order->date->format('M d, Y') }}</td>
                        <td class="px-4 py-2">RWF {{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : ($order->status === 'pending' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="{{ route('restaurant.orders.show', $order->order_id) }}" class="text-blue-500 hover:text-blue-700 mr-2">View</a>
                            <a href="{{ route('restaurant.orders.edit', $order->order_id) }}" class="text-yellow-500 hover:text-yellow-700 mr-2">Edit</a>
                            <form method="POST" action="{{ route('restaurant.orders.destroy', $order->order_id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-8 text-gray-500">
                            No orders yet. <a href="{{ route('restaurant.orders.create') }}" class="text-blue-500">Create one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $orders->links() }}
    </div>
</div>
@endsection
