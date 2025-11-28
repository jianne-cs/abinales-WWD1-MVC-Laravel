@extends('layouts.app')

@section('title', 'MIKU EXPO 2025 - Official Store')

@section('content')
<div class="container">
    <!-- MIKU EXPO Header -->
    <div class="expo-header text-center">
        <div class="container">
            <h1 class="display-3 fw-bold text-miku-light mb-3">🎵 MIKU EXPO 2025 OFFICIAL STORE</h1>
            <p class="lead text-miku-muted mb-4">Limited Edition Concert Merchandise - Asia Tour</p>
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
            <h2 class="text-center text-miku-teal mb-4">⭐ Featured Products</h2>
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
                                <span class="category-badge text-miku-teal">{{ $product->category }}</span>
                                @if($product->is_featured)
                                <span class="featured-badge">Featured</span>
                                @endif
                            </div>
                            <h5 class="card-title text-miku-light">{{ $product->name }}</h5>
                            <p class="card-text text-miku-muted">{{ Str::limit($product->description, 80) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-tag text-miku-light">₱{{ number_format($product->price, 2) }}</div>
                                <span class="text-miku-teal">
                                    <i class="fas fa-box"></i> {{ $product->stock }} in stock
                                </span>
                            </div>
                            <div class="d-grid mt-3">
                                <button class="btn btn-miku add-to-cart" 
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-stock="{{ $product->stock }}">
                                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                </button>
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
            <h2 class="text-center text-miku-blue mb-4">🎵 All Merchandise</h2>
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
                                <span class="category-badge text-miku-teal">{{ $product->category }}</span>
                                @if($product->stock < 10)
                                <span class="badge bg-danger text-miku-light">Low Stock!</span>
                                @endif
                            </div>
                            <h5 class="card-title text-miku-light">{{ $product->name }}</h5>
                            <p class="card-text text-miku-muted">{{ Str::limit($product->description, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price-tag text-miku-light">₱{{ number_format($product->price, 2) }}</div>
                                <small class="text-miku-muted">
                                    <i class="fas fa-box"></i> {{ $product->stock }} available
                                </small>
                            </div>
                            <div class="d-grid mt-3">
                                <button class="btn btn-miku add-to-cart" 
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->name }}"
                                        data-product-price="{{ $product->price }}"
                                        data-product-stock="{{ $product->stock }}">
                                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Shopping Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content miku-card">
                <div class="modal-header">
                    <h5 class="modal-title text-miku-teal" id="cartModalLabel">
                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <div class="product-image-modal mb-3">
                            <i class="fas fa-check-circle text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h4 class="text-miku-light" id="modal-product-name">Product Name</h4>
                        <p class="text-miku-muted" id="modal-product-price">₱0.00</p>
                    </div>
                    
                    <div class="mb-3">
                        <label for="quantity" class="form-label text-miku-light">Quantity:</label>
                        <div class="input-group">
                            <button class="btn btn-outline-miku" type="button" id="decrease-qty">-</button>
                            <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="10">
                            <button class="btn btn-outline-miku" type="button" id="increase-qty">+</button>
                        </div>
                        <small class="text-miku-muted" id="stock-info">Max 10 items per order</small>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-miku-light">Subtotal:</span>
                        <span class="price-tag" id="subtotal">₱0.00</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-miku" data-bs-dismiss="modal">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </button>
                    <button type="button" class="btn btn-miku" id="confirm-add-to-cart">
                        <i class="fas fa-cart-plus me-2"></i>Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentProduct = null;
    
    // Add to Cart button click handler
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = parseFloat(this.getAttribute('data-product-price'));
            const productStock = parseInt(this.getAttribute('data-product-stock'));
            
            currentProduct = {
                id: productId,
                name: productName,
                price: productPrice,
                stock: productStock
            };
            
            // Update modal content
            document.getElementById('modal-product-name').textContent = productName;
            document.getElementById('modal-product-price').textContent = `₱${productPrice.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
            document.getElementById('quantity').value = 1;
            document.getElementById('quantity').max = Math.min(productStock, 10);
            document.getElementById('stock-info').textContent = `Max ${Math.min(productStock, 10)} items available`;
            updateSubtotal();
            
            // Show modal
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            cartModal.show();
        });
    });
    
    // Quantity controls
    document.getElementById('increase-qty').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        const maxQty = parseInt(quantityInput.max);
        if (parseInt(quantityInput.value) < maxQty) {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateSubtotal();
        }
    });
    
    document.getElementById('decrease-qty').addEventListener('click', function() {
        const quantityInput = document.getElementById('quantity');
        if (parseInt(quantityInput.value) > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
            updateSubtotal();
        }
    });
    
    document.getElementById('quantity').addEventListener('change', function() {
        const maxQty = parseInt(this.max);
        if (parseInt(this.value) > maxQty) {
            this.value = maxQty;
        } else if (parseInt(this.value) < 1) {
            this.value = 1;
        }
        updateSubtotal();
    });
    
    // Update subtotal
    function updateSubtotal() {
        if (currentProduct) {
            const quantity = parseInt(document.getElementById('quantity').value);
            const subtotal = currentProduct.price * quantity;
            document.getElementById('subtotal').textContent = `₱${subtotal.toLocaleString('en-PH', {minimumFractionDigits: 2})}`;
        }
    }
    
    // Confirm add to cart
    document.getElementById('confirm-add-to-cart').addEventListener('click', function() {
        if (currentProduct) {
            const quantity = parseInt(document.getElementById('quantity').value);
            
            // Show success message
            const cartAlert = document.getElementById('cart-alert');
            const cartMessage = document.getElementById('cart-message');
            cartMessage.textContent = `${quantity}x ${currentProduct.name} added to your cart!`;
            cartAlert.classList.remove('d-none');
            
            // Hide modal
            const cartModal = bootstrap.Modal.getInstance(document.getElementById('cartModal'));
            cartModal.hide();
            
            // Auto-hide alert after 5 seconds
            setTimeout(() => {
                cartAlert.classList.add('d-none');
            }, 5000);
            
            // Here you would normally send to server
            console.log('Added to cart:', {
                product: currentProduct,
                quantity: quantity
            });
        }
    });
    
    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
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