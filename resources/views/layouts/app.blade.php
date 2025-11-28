<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'MIKU EXPO 2025') - Hatsune Miku Merchandise</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
<style>
    :root {
        --miku-teal: #39c5bb;
        --miku-dark-teal: #00a9a3;
        --miku-blue: #7eb2fe;
        --miku-purple: #b881d4;
        --miku-pink: #df3d8d;
        --miku-bg-dark: #0a0a2a;
        --miku-bg-light: #1a1a4a;
        --text-light: #ffffff;
        --text-muted: rgba(255, 255, 255, 0.8);
        --text-dark: #2c2c2c;
    }

    body {
        font-family: 'Noto Sans JP', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, var(--miku-bg-dark) 0%, var(--miku-bg-light) 100%);
        color: var(--text-light); /* Default text color */
        min-height: 100vh;
    }

    /* Text Color Classes */
    .text-miku-teal { color: var(--miku-teal) !important; }
    .text-miku-blue { color: var(--miku-blue) !important; }
    .text-miku-purple { color: var(--miku-purple) !important; }
    .text-miku-pink { color: var(--miku-pink) !important; }
    .text-miku-light { color: var(--text-light) !important; }
    .text-miku-muted { color: var(--text-muted) !important; }
    .text-miku-dark { color: var(--text-dark) !important; }

    /* Navigation Styles */
    .navbar {
        background: linear-gradient(45deg, var(--miku-teal), var(--miku-purple)) !important;
        box-shadow: 0 4px 15px rgba(57, 197, 187, 0.3);
    }

    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--text-light) !important;
    }

    .navbar-nav .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-link:hover {
        color: var(--text-light) !important;
        transform: translateY(-1px);
    }

    .dropdown-menu {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid var(--miku-teal);
        color: var(--text-dark);
    }

    .dropdown-item {
        color: var(--text-dark) !important;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: var(--miku-teal);
        color: var(--text-light) !important;
    }

    /* Main Content Area */
    main {
        min-height: calc(100vh - 200px);
        color: var(--text-light);
    }

    /* Miku Card Styles */
    .miku-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(57, 197, 187, 0.3);
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        color: var(--text-light);
    }

    .miku-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(57, 197, 187, 0.4);
    }

    .miku-card .text-muted {
        color: var(--text-muted) !important;
    }

    /* Button Styles */
    .btn-miku {
        background: linear-gradient(45deg, var(--miku-teal), var(--miku-blue));
        color: var(--text-light);
        border: none;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-miku:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(57, 197, 187, 0.6);
        color: var(--text-light);
    }

    .btn-outline-miku {
        border: 2px solid var(--miku-teal);
        color: var(--miku-teal);
        background: transparent;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-outline-miku:hover {
        background: var(--miku-teal);
        color: var(--text-light);
        transform: translateY(-1px);
    }

    /* Alert Styles */
    .alert-miku {
        background: linear-gradient(45deg, rgba(57, 197, 187, 0.1), rgba(74, 144, 226, 0.1));
        border: 1px solid var(--miku-teal);
        color: var(--text-light);
        border-radius: 10px;
    }

    /* Table Styles */
    .table-dark {
        background: rgba(0, 0, 0, 0.3);
        border-radius: 10px;
        color: var(--text-light);
    }

    .table-dark .text-muted {
        color: var(--text-muted) !important;
    }

    .table-hover tbody tr:hover {
        background: rgba(57, 197, 187, 0.2);
        transform: scale(1.01);
        transition: all 0.2s ease;
    }

    /* Utility Classes */
    /* Text Color Classes */
.text-miku-teal { color: var(--miku-teal) !important; }
.text-miku-blue { color: var(--miku-blue) !important; }
.text-miku-purple { color: var(--miku-purple) !important; }
.text-miku-pink { color: var(--miku-pink) !important; }
.text-miku-light { color: #ffffff !important; }
.text-miku-muted { color: rgba(255, 255, 255, 0.8) !important; }
.text-miku-dark { color: #2c2c2c !important; }

/* Specific Element Text Colors */
.navbar-brand { color: white !important; }
.navbar-nav .nav-link { color: rgba(255, 255, 255, 0.9) !important; }
.navbar-nav .nav-link:hover { color: white !important; }

.dropdown-item { color: #333 !important; }
.dropdown-item:hover { color: white !important; }

body { color: white; } /* Default text color */

/* Card text colors */
.miku-card { color: white; }
.miku-card .text-muted { color: rgba(255, 255, 255, 0.7) !important; }

/* Table text colors */
.table-dark { color: white; }
.table-dark .text-muted { color: rgba(255, 255, 255, 0.7) !important; }

/* Footer text colors */
.footer { color: rgba(255, 255, 255, 0.8); }

    .bg-miku {
        background: linear-gradient(45deg, var(--miku-teal), var(--miku-blue));
    }

    .price-tag {
        background: linear-gradient(45deg, #ff6b6b, #ffa500);
        color: var(--text-light);
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-weight: bold;
    }

    .featured-badge {
        background: linear-gradient(45deg, var(--miku-pink), var(--miku-purple));
        color: var(--text-light);
        padding: 0.3rem 1rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Animation for headers */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .gradient-header {
        background: linear-gradient(45deg, var(--miku-teal), var(--miku-purple), var(--miku-pink));
        background-size: 400% 400%;
        animation: gradientShift 8s ease infinite;
        color: var(--text-light);
    }

    /* Form Elements */
    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: var(--text-light);
    }

    .form-control::placeholder {
        color: var(--text-muted);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--miku-teal);
        color: var(--text-light);
        box-shadow: 0 0 0 0.2rem rgba(57, 197, 187, 0.25);
    }

    .form-label {
        color: var(--text-light);
    }

    /* Footer Styles */
    .footer {
        background: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(10px);
        border-top: 1px solid rgba(57, 197, 187, 0.3);
        margin-top: auto;
        color: var(--text-muted);
    }

    /* Add to Cart Modal Styles */
.product-image-modal {
    width: 80px;
    height: 80px;
    background: linear-gradient(45deg, var(--miku-teal), var(--miku-blue));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    font-size: 2rem;
    color: white;
}

/* Action Button Styles */
.action-btn {
    transition: all 0.3s ease;
    border-radius: 8px !important;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.btn-group .dropdown-toggle::after {
    margin-left: 0.5rem;
}

/* Customer Avatar */
.customer-avatar {
    background: linear-gradient(45deg, var(--miku-teal), var(--miku-purple));
}

/* Quantity Input Styles */
.input-group .btn {
    border-color: var(--miku-teal);
    color: var(--miku-teal);
}

.input-group .btn:hover {
    background: var(--miku-teal);
    color: white;
}

/* Modal Backdrop */
.modal-backdrop {
    backdrop-filter: blur(5px);
}

/* Responsive Table */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }
        
        .btn-miku {
            padding: 0.6rem 1.5rem;
        }
    }

    /* Cart Styles */
.cart-item {
    transition: all 0.3s ease;
    border: 1px solid rgba(57, 197, 187, 0.2);
}

.cart-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(57, 197, 187, 0.2);
}

.cart-item-image {
    font-size: 1.5rem;
}

.quantity-input {
    width: 70px;
    text-align: center;
}

/* Badge styles */
.badge.bg-miku-teal {
    background: linear-gradient(45deg, var(--miku-teal), var(--miku-blue)) !important;
}

/* Responsive cart */
@media (max-width: 768px) {
    .cart-item .row > div {
        margin-bottom: 1rem;
    }
    
    .cart-item .row > div:last-child {
        margin-bottom: 0;
    }
}

</style>
    
    @yield('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    🎤 VOCALOID EXPO 2025
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('customers.index') }}">
                                <i class="fas fa-users me-1"></i>Customers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">
                                <i class="fas fa-store me-1"></i>Products
                            </a>
                        </li>
                        <!-- In the navbar section -->
<!-- Add this to the navbar with other menu items -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('cart.view') }}">
        <i class="fas fa-cart-plus me-1"></i>Add To Cart
        @if(session('cart'))
            <span class="badge bg-danger ms-1">
                {{ array_sum(array_column(session('cart'), 'quantity')) }}
            </span>
        @endif
    </a>
</li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fas fa-sign-in-alt me-1"></i>{{ __('Login') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                                    </a>
                                    <a class="dropdown-item" href="{{ route('store') }}">
                                        <i class="fas fa-store me-1"></i>Online Store
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-1"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="footer py-4 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0">
                            🎤 Hatsune Miku EXPO 2025 Asia • Official Merchandise Store
                        </p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">
                            Powered by Vocaloid Technology • Crypton Future Media
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert.classList.contains('show')) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });

            // Add hover effects to table rows
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.01)';
                    this.style.transition = 'all 0.2s ease';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Add smooth scrolling to anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>