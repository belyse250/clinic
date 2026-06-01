<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display list of customers
    public function index()
    {
        $customers = Customer::all();
        return view('restaurant.customers.index', compact('customers'));
    }

    // Show form for creating customer
    public function create()
    {
        return view('restaurant.customers.create');
    }

    // Store customer in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers',
            'email' => 'nullable|email|unique:customers',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer added successfully');
    }

    // Show customer details
    public function show(Customer $customer)
    {
        $customer->load('orders.orderDetails.menuItem');
        return view('restaurant.customers.show', compact('customer'));
    }

    // Show form for editing customer
    public function edit(Customer $customer)
    {
        return view('restaurant.customers.edit', compact('customer'));
    }

    // Update customer in database
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:customers,phone,' . $customer->cust_id . ',cust_id',
            'email' => 'nullable|email|unique:customers,email,' . $customer->cust_id . ',cust_id',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully');
    }

    // Delete customer
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully');
    }
}
