<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Menu;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display list of orders
    public function index()
    {
        $orders = Order::with('customer', 'orderDetails.menuItem')
            ->orderBy('date', 'desc')
            ->paginate(15);
        
        return view('restaurant.orders.index', compact('orders'));
    }

    // Show form for creating order
    public function create()
    {
        $customers = Customer::where('status', 'active')->get();
        $menuItems = Menu::where('status', 'available')->get();
        
        return view('restaurant.orders.create', compact('customers', 'menuItems'));
    }

    // Store order in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cust_id' => 'required|exists:customers,cust_id',
            'date' => 'required|date',
            'time' => 'nullable|date_format:H:i',
            'status' => 'required|in:pending,confirmed,preparing,ready,completed,cancelled',
            'notes' => 'nullable|string',
            'items' => 'required|array',
            'items.*.item_id' => 'required|exists:menu,item_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.special_instructions' => 'nullable|string',
        ]);

        try {
            $order = new Order();
            $order->cust_id = $validated['cust_id'];
            $order->date = $validated['date'];
            $order->time = $validated['time'] ?? now()->format('H:i');
            $order->status = $validated['status'];
            $order->notes = $validated['notes'];
            $order->user_id = auth('restaurant')->id();
            $order->save();

            $totalAmount = 0;

            foreach ($validated['items'] as $item) {
                $menuItem = Menu::find($item['item_id']);
                
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->order_id;
                $orderDetail->item_id = $item['item_id'];
                $orderDetail->quantity = $item['quantity'];
                $orderDetail->unit_price = $menuItem->price;
                $orderDetail->subtotal = $item['quantity'] * $menuItem->price;
                $orderDetail->special_instructions = $item['special_instructions'] ?? null;
                $orderDetail->save();

                $totalAmount += $orderDetail->subtotal;
            }

            $order->total_amount = $totalAmount;
            $order->save();

            return redirect()->route('orders.show', $order->order_id)
                ->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error creating order: ' . $e->getMessage());
        }
    }

    // Show order details
    public function show(Order $order)
    {
        $order->load('customer', 'orderDetails.menuItem', 'staff');
        return view('restaurant.orders.show', compact('order'));
    }

    // Show form for editing order
    public function edit(Order $order)
    {
        $customers = Customer::where('status', 'active')->get();
        $menuItems = Menu::where('status', 'available')->get();
        $order->load('orderDetails');
        
        return view('restaurant.orders.edit', compact('order', 'customers', 'menuItems'));
    }

    // Update order in database
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('orders.show', $order->order_id)
            ->with('success', 'Order updated successfully');
    }

    // Delete order
    public function destroy(Order $order)
    {
        $order->orderDetails()->delete();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully');
    }

    // Add item to order
    public function addItem(Request $request, Order $order)
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:menu,item_id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menuItem = Menu::find($validated['item_id']);
        
        $orderDetail = OrderDetail::where('order_id', $order->order_id)
            ->where('item_id', $validated['item_id'])
            ->first();

        if ($orderDetail) {
            $orderDetail->quantity += $validated['quantity'];
            $orderDetail->subtotal = $orderDetail->quantity * $orderDetail->unit_price;
            $orderDetail->save();
        } else {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->order_id;
            $orderDetail->item_id = $validated['item_id'];
            $orderDetail->quantity = $validated['quantity'];
            $orderDetail->unit_price = $menuItem->price;
            $orderDetail->subtotal = $validated['quantity'] * $menuItem->price;
            $orderDetail->save();
        }

        $order->calculateTotal();
        $order->save();

        return redirect()->route('orders.show', $order->order_id)
            ->with('success', 'Item added to order');
    }

    // Remove item from order
    public function removeItem(OrderDetail $orderDetail)
    {
        $orderId = $orderDetail->order_id;
        $orderDetail->delete();

        $order = Order::find($orderId);
        $order->calculateTotal();
        $order->save();

        return redirect()->route('orders.show', $orderId)
            ->with('success', 'Item removed from order');
    }
}
