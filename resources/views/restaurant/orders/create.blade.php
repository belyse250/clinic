@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('restaurant.orders.index') }}" class="text-blue-500 hover:text-blue-700">← Back to Orders</a>
    </div>

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-8">
        <h2 class="text-2xl font-bold mb-6">Create New Order</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('restaurant.orders.store') }}" id="orderForm">
            @csrf

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="cust_id" class="block text-gray-700 text-sm font-bold mb-2">Customer *</label>
                    <select id="cust_id" name="cust_id" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                        <option value="">Select Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->cust_id }}">{{ $customer->name }} ({{ $customer->phone }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-gray-700 text-sm font-bold mb-2">Date *</label>
                    <input type="date" id="date" name="date" value="{{ old('date', now()->toDateString()) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="time" class="block text-gray-700 text-sm font-bold mb-2">Time</label>
                    <input type="time" id="time" name="time" value="{{ old('time', now()->format('H:i')) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                </div>

                <div>
                    <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status *</label>
                    <select id="status" name="status" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="preparing">Preparing</option>
                        <option value="ready">Ready</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label for="notes" class="block text-gray-700 text-sm font-bold mb-2">Notes</label>
                <textarea id="notes" name="notes" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500">{{ old('notes') }}</textarea>
            </div>

            <!-- Order Items -->
            <div class="mb-6">
                <h3 class="text-lg font-bold mb-4">Order Items</h3>
                <div id="itemsContainer">
                    <div class="itemRow mb-4 p-4 border rounded-lg bg-gray-50">
                        <div class="grid grid-cols-12 gap-2">
                            <div class="col-span-5">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Item *</label>
                                <select name="items[0][item_id]" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    <option value="">Select Item</option>
                                    @foreach($menuItems as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_name }} - RWF {{ $item->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-3">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Quantity *</label>
                                <input type="number" name="items[0][quantity]" value="1" min="1" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Special Instructions</label>
                                <input type="text" name="items[0][special_instructions]"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            </div>
                        </div>
                        <button type="button" class="mt-2 text-red-500 hover:text-red-700 text-sm" onclick="removeItem(this)">Remove</button>
                    </div>
                </div>

                <button type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" onclick="addItem()">
                    + Add Item
                </button>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Create Order
                </button>
                <a href="{{ route('restaurant.orders.index') }}" class="flex-1 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
let itemCount = 1;

function addItem() {
    const container = document.getElementById('itemsContainer');
    const html = `
        <div class="itemRow mb-4 p-4 border rounded-lg bg-gray-50">
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-5">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Item *</label>
                    <select name="items[${itemCount}][item_id]" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        <option value="">Select Item</option>
                        @foreach($menuItems as $item)
                            <option value="{{ $item->item_id }}">{{ $item->item_name }} - RWF {{ $item->price }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-3">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Quantity *</label>
                    <input type="number" name="items[${itemCount}][quantity]" value="1" min="1" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
                <div class="col-span-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Special Instructions</label>
                    <input type="text" name="items[${itemCount}][special_instructions]"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md">
                </div>
            </div>
            <button type="button" class="mt-2 text-red-500 hover:text-red-700 text-sm" onclick="removeItem(this)">Remove</button>
        </div>
    `;
    container.insertAdjacentHTML('beforeend', html);
    itemCount++;
}

function removeItem(btn) {
    btn.closest('.itemRow').remove();
}
</script>
@endsection
