@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('customers.index') }}" class="text-blue-500 hover:text-blue-700">← Back to Customers</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Customer Info -->
        <div class="md:col-span-1 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $customer->name }}</h2>
            <div class="space-y-2">
                <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                <p><strong>Email:</strong> {{ $customer->email ?? 'N/A' }}</p>
                <p><strong>Address:</strong> {{ $customer->address ?? 'N/A' }}</p>
                <p><strong>Status:</strong> 
                    <span class="px-3 py-1 rounded-full text-sm font-semibold 
                        {{ $customer->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                </p>
            </div>
            <div class="mt-6 space-y-2">
                <a href="{{ route('customers.edit', $customer->cust_id) }}" class="block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded text-center">
                    Edit
                </a>
                <form method="POST" action="{{ route('customers.destroy', $customer->cust_id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>

        <!-- Customer Orders -->
        <div class="md:col-span-2 bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Order History</h3>
            @if($customer->orders->count() > 0)
                <div class="space-y-4">
                    @foreach($customer->orders as $order)
                        <div class="border rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <strong>Order #{{ $order->order_id }}</strong>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                    {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $order->date->format('M d, Y') }} at {{ $order->time }}</p>
                            <div class="mt-2">
                                @foreach($order->orderDetails as $detail)
                                    <p class="text-sm">{{ $detail->menuItem->item_name }} x{{ $detail->quantity }} - RWF {{ number_format($detail->subtotal, 2) }}</p>
                                @endforeach
                            </div>
                            <div class="mt-2 text-right">
                                <strong>Total: RWF {{ number_format($order->total_amount, 2) }}</strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No orders yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
