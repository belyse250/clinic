<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantReportController extends Controller
{
    // Display daily revenue report
    public function dailyRevenue(Request $request)
    {
        $date = $request->input('date', now()->toDateString());
        
        $orders = Order::whereDate('date', $date)
            ->where('status', 'completed')
            ->with('customer', 'orderDetails.menuItem')
            ->get();

        $totalRevenue = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        return view('restaurant.reports.daily-revenue', compact(
            'orders',
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'date'
        ));
    }

    // Display monthly revenue report
    public function monthlyRevenue(Request $request)
    {
        $year = $request->input('year', now()->year);
        $month = $request->input('month', now()->month);

        $orders = Order::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->where('status', 'completed')
            ->with('customer', 'orderDetails.menuItem')
            ->get();

        $totalRevenue = $orders->sum('total_amount');
        $totalOrders = $orders->count();
        $averageOrderValue = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Group by day for daily breakdown
        $dailyBreakdown = $orders->groupBy(function ($order) {
            return $order->date->format('Y-m-d');
        })->map(function ($dayOrders) {
            return [
                'total' => $dayOrders->sum('total_amount'),
                'count' => $dayOrders->count(),
            ];
        });

        return view('restaurant.reports.monthly-revenue', compact(
            'orders',
            'totalRevenue',
            'totalOrders',
            'averageOrderValue',
            'year',
            'month',
            'dailyBreakdown'
        ));
    }

    // Display revenue by menu item
    public function revenueByItem(Request $request)
    {
        $startDate = $request->input('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        $orderDetails = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.order_id')
            ->join('menu', 'order_details.item_id', '=', 'menu.item_id')
            ->whereBetween('orders.date', [$startDate, $endDate])
            ->where('orders.status', 'completed')
            ->select(
                'menu.item_id',
                'menu.item_name',
                'menu.price',
                DB::raw('SUM(order_details.quantity) as total_quantity'),
                DB::raw('SUM(order_details.subtotal) as total_revenue')
            )
            ->groupBy('menu.item_id', 'menu.item_name', 'menu.price')
            ->orderBy('total_revenue', 'desc')
            ->get();

        $totalRevenue = $orderDetails->sum('total_revenue');

        return view('restaurant.reports.revenue-by-item', compact(
            'orderDetails',
            'totalRevenue',
            'startDate',
            'endDate'
        ));
    }

    // Export daily revenue report to CSV
    public function exportDailyRevenue($date)
    {
        $orders = Order::whereDate('date', $date)
            ->where('status', 'completed')
            ->with('customer', 'orderDetails.menuItem')
            ->get();

        $totalRevenue = $orders->sum('total_amount');

        $filename = "daily_revenue_{$date}.csv";
        $handle = fopen('php://memory', 'w');

        fputcsv($handle, ['Daily Revenue Report', date('Y-m-d', strtotime($date))]);
        fputcsv($handle, []);
        fputcsv($handle, ['Order ID', 'Customer Name', 'Items', 'Total Amount', 'Order Time']);

        foreach ($orders as $order) {
            $items = $order->orderDetails->map(function ($detail) {
                return $detail->menuItem->item_name . ' (x' . $detail->quantity . ')';
            })->implode(', ');

            fputcsv($handle, [
                $order->order_id,
                $order->customer->name,
                $items,
                number_format($order->total_amount, 2),
                $order->time,
            ]);
        }

        fputcsv($handle, []);
        fputcsv($handle, ['Total Revenue:', number_format($totalRevenue, 2)]);
        fputcsv($handle, ['Total Orders:', $orders->count()]);

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename=\"$filename\"");
    }
}
