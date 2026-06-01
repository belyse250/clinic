@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Restaurant Management System</h1>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <a href="{{ route('restaurant.orders.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white rounded-lg shadow-md p-6">
            <p class="text-gray-200 text-sm">Total Orders Today</p>
            <p class="text-3xl font-bold">
                @php
                    $todayOrders = \App\Models\Order::whereDate('date', now()->toDateString())->count();
                @endphp
                {{ $todayOrders }}
            </p>
        </a>

        <a href="{{ route('restaurant.customers.index') }}" class="bg-green-500 hover:bg-green-700 text-white rounded-lg shadow-md p-6">
            <p class="text-gray-200 text-sm">Total Customers</p>
            <p class="text-3xl font-bold">
                @php
                    $totalCustomers = \App\Models\Customer::count();
                @endphp
                {{ $totalCustomers }}
            </p>
        </a>

        <a href="{{ route('menu.index') }}" class="bg-purple-500 hover:bg-purple-700 text-white rounded-lg shadow-md p-6">
            <p class="text-gray-200 text-sm">Menu Items</p>
            <p class="text-3xl font-bold">
                @php
                    $menuItems = \App\Models\Menu::count();
                @endphp
                {{ $menuItems }}
            </p>
        </a>

        <a href="{{ route('restaurant.reports.daily-revenue') }}" class="bg-red-500 hover:bg-red-700 text-white rounded-lg shadow-md p-6">
            <p class="text-gray-200 text-sm">Today's Revenue</p>
            <p class="text-2xl font-bold">
                @php
                    $todayRevenue = \App\Models\Order::whereDate('date', now()->toDateString())
                        ->where('status', 'completed')
                        ->sum('total_amount');
                @endphp
                RWF {{ number_format($todayRevenue, 2) }}
            </p>
        </a>
    </div>

    <!-- Main Menu -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Menu Management -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Menu Management</h3>
            <p class="text-gray-600 mb-4">Manage your restaurant menu items, prices, and availability.</p>
            <a href="{{ route('menu.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Manage Menu
            </a>
        </div>

        <!-- Customer Management -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Customer Management</h3>
            <p class="text-gray-600 mb-4">Add and manage your restaurant customers and their contact information.</p>
            <a href="{{ route('restaurant.customers.index') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Manage Customers
            </a>
        </div>

        <!-- Order Management -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Order Management</h3>
            <p class="text-gray-600 mb-4">Create, process, and track customer orders in real-time.</p>
            <a href="{{ route('restaurant.orders.index') }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Manage Orders
            </a>
        </div>

        <!-- Daily Revenue Report -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Daily Revenue</h3>
            <p class="text-gray-600 mb-4">View and export daily sales and revenue reports.</p>
            <a href="{{ route('restaurant.reports.daily-revenue') }}" class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                View Report
            </a>
        </div>

        <!-- Monthly Revenue Report -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Monthly Revenue</h3>
            <p class="text-gray-600 mb-4">Analyze monthly sales trends and performance metrics.</p>
            <a href="{{ route('restaurant.reports.monthly-revenue') }}" class="inline-block bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                View Report
            </a>
        </div>

        <!-- Revenue by Item -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold mb-4">Revenue by Item</h3>
            <p class="text-gray-600 mb-4">Track which menu items generate the most revenue.</p>
            <a href="{{ route('restaurant.reports.revenue-by-item') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                View Report
            </a>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="mt-8 bg-white rounded-lg shadow-md p-6">
        <h3 class="text-xl font-bold mb-4">Recent Orders</h3>
        @php
            $recentOrders = \App\Models\Order::with('customer')->orderBy('date', 'desc')->take(5)->get();
        @endphp
        <table class="w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 text-left">Order ID</th>
                    <th class="px-4 py-2 text-left">Customer</th>
                    <th class="px-4 py-2 text-left">Date</th>
                    <th class="px-4 py-2 text-right">Amount</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">#{{ $order->order_id }}</td>
                        <td class="px-4 py-2">{{ $order->customer->name }}</td>
                        <td class="px-4 py-2">{{ $order->date->format('M d, Y') }}</td>
                        <td class="px-4 py-2 text-right">RWF {{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-2">
                            <span class="px-3 py-1 rounded-full text-sm font-semibold 
                                {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">No orders yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
