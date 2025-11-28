@extends('layouts.app')

@section('title', 'MIKU EXPO 2025 - Official Store')

@section('content')
<div class="container">
    <!-- MIKU EXPO Header -->
    <div class="expo-header text-center">
        <div class="container">
            <h1 class="display-3 fw-bold text-white mb-3">🎵 MIKU EXPO 2025 OFFICIAL STORE</h1>
            <p class="lead text-white mb-4">Limited Edition Concert Merchandise - Asia Tour</p>
            <div class="row justify-content-center">
                <div class="col-auto">
                    <span class="featured-badge">🌟 Limited Stock</span>
                </div>
                <div class="col-auto">
                    <span class="featured-badge">🚚 Worldwide Shipping</span>
                </div>
                <div class="col-auto">
                    <span class="featured-badge">⚡ Official Merch</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Shopping Cart Alert Area -->
    <div id="cart-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
        <strong>🎉 Added to Cart!</strong> <span id="cart-message"></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <!-- Featured Products -->
    @if($featuredProducts->count() > 0)
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center text-white mb-4">⭐ Featured Products</h2>
            <div class="row">
                @foreach($featuredProducts as $product)
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            @switch($product->category)
                                @case('Lightsticks') 🌟 @break
                                @case('Apparel') 👘 @break
                                @case('Posters') 🖼️ @break
                                @default 🎵
                            @endswitch
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="category-badge text-white">{{ $product->category }}</span>
                                @if($product->is_featured)
                                <span class="featured-badge">Featured</span>
                                @endif
                            </div>
                            <h5 class="card-title text-white">{{ $product->name }}</h5>
                            <p class="card-text text-white-50">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-tag text-white">₱{{ number_format($product->price, 2) }}</div>
                                <span class="text-white">
                                    <i class="fas fa-box"></i> {{ $product->stock }} in stock
                                </span>
                            </div>
                            <div class="d-grid mt-3">
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-miku w-100">
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- All Products -->
    <div class="row">
        <div class="col-12">
            <h2 class="text-center text-white mb-4">🎵 All Merchandise</h2>
            <div class="row">
                @foreach($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            @switch($product->category)
                                @case('Lightsticks') 💫 @break
                                @case('Apparel') 👕 @break
                                @case('Posters') 🎨 @break
                                @case('Accessories') 🎀 @break
                                @case('Stationery') 📝 @break
                                @default 🎵
                            @endswitch
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="category-badge text-white">{{ $product->category }}</span>
                                @if($product->stock < 10)
                                <span class="badge bg-danger text-white">Low Stock!</span>
                                @endif
                            </div>
                            <h5 class="card-title text-white">{{ $product->name }}</h5>
                            <p class="card-text text-white-50">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-tag text-white">₱{{ number_format($product->price, 2) }}</div>
                                <small class="text-white-50">
                                    <i class="fas fa-box"></i> {{ $product->stock }} available
                                </small>
                            </div>
                            <div class="d-grid mt-3">
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-miku w-100">
                                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Store Info -->
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="miku-card p-4">
                <h3 class="text-white">🎶 About MIKU EXPO 2025</h3>
                <p class="lead text-white-50">Join the virtual sensation! Hatsune Miku continues her world tour with exclusive merchandise available only during the 2025 Asia Expo.</p>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <h5 class="text-white">🏆 Official Merchandise</h5>
                        <p class="text-white-50">Authentic products from Crypton Future Media</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-white">🌍 Worldwide Shipping</h5>
                        <p class="text-white-50">Get your merch delivered anywhere</p>
                    </div>
                    <div class="col-md-4">
                        <h5 class="text-white">⚡ Limited Edition</h5>
                        <p class="text-white-50">Exclusive designs only available during expo</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Simple form submission for add to cart
    document.querySelectorAll('.add-to-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Show success message
            const cartAlert = document.getElementById('cart-alert');
            const cartMessage = document.getElementById('cart-message');
            cartMessage.textContent = 'Product added to your cart!';
            cartAlert.classList.remove('d-none');
            
            // Submit the form
            this.submit();
            
            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                cartAlert.classList.add('d-none');
            }, 5000);
        });
    });
    
    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            if (alert.classList.contains('show')) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    });
});
</script>
@endsection
@endsection