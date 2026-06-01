@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Revenue by Menu Item</h2>

    <!-- Date Range Filter -->
    <form method="GET" action="{{ route('restaurant.reports.revenue-by-item') }}" class="mb-6">
        <div class="flex gap-4">
            <input type="date" name="start_date" value="{{ $startDate }}" class="px-3 py-2 border border-gray-300 rounded-md">
            <input type="date" name="end_date" value="{{ $endDate }}" class="px-3 py-2 border border-gray-300 rounded-md">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Filter
            </button>
        </div>
    </form>

    <!-- Total Revenue -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <p class="text-gray-600 text-sm">Total Revenue (Period)</p>
        <p class="text-3xl font-bold text-green-600">RWF {{ number_format($totalRevenue, 2) }}</p>
    </div>

    <!-- Items Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Item Name</th>
                    <th class="px-4 py-2 text-right">Unit Price</th>
                    <th class="px-4 py-2 text-right">Quantity Sold</th>
                    <th class="px-4 py-2 text-right">Total Revenue</th>
                    <th class="px-4 py-2 text-right">% of Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orderDetails as $item)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $item->item_name }}</td>
                        <td class="px-4 py-2 text-right">RWF {{ number_format($item->price, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ $item->total_quantity }}</td>
                        <td class="px-4 py-2 text-right font-semibold">RWF {{ number_format($item->total_revenue, 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ number_format(($item->total_revenue / $totalRevenue) * 100, 1) }}%</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            No data for this period.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
