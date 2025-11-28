<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get basic statistics
        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        $totalProducts = Product::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        
        // Get recent orders with full details
        $recentOrders = Order::with(['customer', 'orderItems.product'])
            ->latest()
            ->take(5)
            ->get();

        // Get top selling products
        $topProducts = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->select(
                'products.id',
                'products.name',
                'products.category',
                DB::raw('SUM(order_items.quantity) as total_sold')
            )
            ->groupBy('products.id', 'products.name', 'products.category')
            ->orderBy('total_sold', 'DESC')
            ->take(5)
            ->get();

        // Get customers with manual order counting (avoid complex relationships for now)
        $customersWithPurchases = Customer::with(['orders' => function($query) {
                $query->where('status', 'completed')
                      ->with('orderItems.product');
            }])
            ->get()
            ->map(function($customer) {
                $customer->total_spent = $customer->orders->where('status', 'completed')->sum('total_amount');
                $customer->completed_orders_count = $customer->orders->where('status', 'completed')->count();
                return $customer;
            })
            ->sortByDesc('total_spent')
            ->take(5);

        return view('dashboard', compact(
            'totalCustomers',
            'totalOrders', 
            'totalRevenue',
            'totalProducts',
            'pendingOrders',
            'recentOrders',
            'topProducts',
            'customersWithPurchases'
        ));
    }
}