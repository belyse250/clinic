@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('restaurant.orders.index') }}" class="text-blue-500 hover:text-blue-700">← Back to Orders</a>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="col-span-2 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">Order #{{ $order->order_id }}</h2>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-gray-600 text-sm">Customer</p>
                    <p class="font-semibold">{{ $order->customer->name }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Date</p>
                    <p class="font-semibold">{{ $order->date->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Time</p>
                    <p class="font-semibold">{{ $order->time }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Status</p>
                    <p class="font-semibold">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold 
                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- Order Items -->
            <h3 class="text-lg font-bold mb-4">Items</h3>
            <div class="space-y-2 mb-6">
                @foreach($order->orderDetails as $detail)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-semibold">{{ $detail->menuItem->item_name }}</p>
                            <p class="text-sm text-gray-600">Qty: {{ $detail->quantity }} x RWF {{ number_format($detail->unit_price, 2) }}</p>
                            @if($detail->special_instructions)
                                <p class="text-sm text-gray-500 italic">{{ $detail->special_instructions }}</p>
                            @endif
                        </div>
                        <div class="text-right">
                            <p class="font-semibold">RWF {{ number_format($detail->subtotal, 2) }}</p>
                            <form method="POST" action="{{ route('restaurant.order-items.remove', $detail->id) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Remove this item?')">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="border-t-2 pt-4">
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold">Total Amount:</p>
                    <p class="text-2xl font-bold text-green-600">RWF {{ number_format($order->total_amount, 2) }}</p>
                </div>
            </div>

            @if($order->notes)
                <div class="mt-6 p-4 bg-gray-100 rounded">
                    <p class="text-gray-700 text-sm"><strong>Notes:</strong> {{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-4">Actions</h3>

            <a href="{{ route('restaurant.orders.edit', $order->order_id) }}" class="block w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 text-center">
                Edit Order
            </a>

            <form method="POST" action="{{ route('restaurant.orders.destroy', $order->order_id) }}" class="mb-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">
                    Delete Order
                </button>
            </form>

            <div class="mt-6 border-t pt-4">
                <p class="text-gray-600 text-sm mb-2"><strong>Staff:</strong> {{ $order->staff ? $order->staff->name : 'N/A' }}</p>
                <p class="text-gray-600 text-sm"><strong>Created:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
