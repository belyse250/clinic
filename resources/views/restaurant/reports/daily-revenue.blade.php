@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold">Daily Revenue Report</h2>
        <a href="{{ route('restaurant.reports.export-daily', $date) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Export CSV
        </a>
    </div>

    <!-- Date Filter -->
    <form method="GET" action="{{ route('restaurant.reports.daily-revenue') }}" class="mb-6">
        <div class="flex gap-4">
            <input type="date" name="date" value="{{ $date }}" class="px-3 py-2 border border-gray-300 rounded-md">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filter
            </button>
        </div>
    </form>

    <!-- Summary Cards -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm">Total Revenue</p>
            <p class="text-3xl font-bold text-green-600">RWF {{ number_format($totalRevenue, 2) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm">Total Orders</p>
            <p class="text-3xl font-bold text-blue-600">{{ $totalOrders }}</p>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">
            <p class="text-gray-600 text-sm">Average Order Value</p>
            <p class="text-3xl font-bold text-purple-600">RWF {{ number_format($averageOrderValue, 2) }}</p>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Order ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Items</th>
                    <th class="px-4 py-2 text-right">Total</th>
                    <th class="px-4 py-2 text-left">Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">#{{ $order->order_id }}</td>
                        <td class="px-4 py-2">{{ $order->customer->name }}</td>
                        <td class="px-4 py-2">
                            <div class="text-sm">
                                @foreach($order->orderDetails as $detail)
                                    <p>{{ $detail->menuItem->item_name }} x{{ $detail->quantity }}</p>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-2 text-right font-semibold">RWF {{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-2">{{ $order->time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            No completed orders for this date.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
