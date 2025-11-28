<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $featuredProducts = Product::where('is_featured', true)->get();
        
        return view('products.index', compact('products', 'featuredProducts'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // Cart Functions


public function viewCart()
{
    $cart = session()->get('cart', []);
    $total = 0;
    
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    return view('cart.index', compact('cart', 'total'));
}

public function addToCart(Request $request)
{
    $product = Product::findOrFail($request->product_id);
    
    $cart = session()->get('cart', []);
    
    // Check if product already in cart
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity'] += $request->quantity;
    } else {
        $cart[$product->id] = [
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "image" => $product->image,
            "category" => $product->category
        ];
    }
    
    session()->put('cart', $cart);
    
    return response()->json([
        'success' => true,
        'message' => 'Product added to cart successfully!',
        'cart_count' => array_sum(array_column($cart, 'quantity'))
    ]);
}

public function removeFromCart($id)
{
    $cart = session()->get('cart');
    
    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }
    
    return redirect()->route('cart.view')->with('success', 'Item removed from cart!');
}

public function updateCart(Request $request, $id)
{
    $cart = session()->get('cart');
    
    if (isset($cart[$id]) && $request->quantity > 0) {
        $cart[$id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);
    }
    
    return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
}

public function clearCart()
{
    session()->forget('cart');
    return redirect()->route('cart.view')->with('success', 'Cart cleared successfully!');
}


    // Admin CRUD functions
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Implementation for storing products
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Implementation for updating products
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    
}