@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6">Monthly Revenue Report</h2>

    <!-- Month Filter -->
    <form method="GET" action="{{ route('restaurant.reports.monthly-revenue') }}" class="mb-6">
        <div class="flex gap-4">
            <select name="month" class="px-3 py-2 border border-gray-300 rounded-md">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                        {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                    </option>
                @endfor
            </select>
            <select name="year" class="px-3 py-2 border border-gray-300 rounded-md">
                @for ($y = now()->year - 5; $y <= now()->year; $y++)
                    <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
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

    <!-- Daily Breakdown -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="p-6 border-b">
            <h3 class="text-xl font-bold">Daily Breakdown</h3>
        </div>
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-right">Total Revenue</th>
                    <th class="px-4 py-2 text-right">Orders</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dailyBreakdown as $date => $data)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ date('M d, Y', strtotime($date)) }}</td>
                        <td class="px-4 py-2 text-right font-semibold">RWF {{ number_format($data['total'], 2) }}</td>
                        <td class="px-4 py-2 text-right">{{ $data['count'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-500">
                            No data for this period.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
