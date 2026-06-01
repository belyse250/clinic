@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6">Edit Order #{{ $order->order_id }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('restaurant.orders.update', $order->order_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Order Status</label>
                <select id="status" name="status" required
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                    <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="preparing" {{ $order->status === 'preparing' ? 'selected' : '' }}>Preparing</option>
                    <option value="ready" {{ $order->status === 'ready' ? 'selected' : '' }}>Ready</option>
                    <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                <textarea id="notes" name="notes" rows="4"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">{{ old('notes', $order->notes) }}</textarea>
            </div>

            <h3 class="text-lg font-bold mb-4">Current Items</h3>
            <div class="mb-6">
                @foreach($order->orderDetails as $detail)
                    <div class="flex justify-between items-center border-b pb-2 mb-2">
                        <div>
                            <p class="font-semibold">{{ $detail->menuItem->item_name }}</p>
                            <p class="text-sm text-gray-600">Qty: {{ $detail->quantity }} x RWF {{ number_format($detail->unit_price, 2) }}</p>
                        </div>
                        <div class="text-right">
                            <p>RWF {{ number_format($detail->subtotal, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update Order
                </button>
                <a href="{{ route('restaurant.orders.show', $order->order_id) }}" class="flex-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
