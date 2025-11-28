<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Use simple count instead of withCount for now
        $customers = Customer::paginate(10);
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalOrders = Order::count();

        return view('customers.index', compact('customers', 'totalRevenue', 'totalOrders'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'required|string',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        // Load orders with their items and products
        $customer->load(['orders.orderItems.product']);
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username,' . $customer->id,
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date',
            'address' => 'required|string',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer deleted successfully.');
    }
}