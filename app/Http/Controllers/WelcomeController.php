<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->take(3)->get();
        $products = Product::all()->take(6); // Show only 6 products on homepage
        
        return view('welcome', compact('featuredProducts', 'products'));
    }
}