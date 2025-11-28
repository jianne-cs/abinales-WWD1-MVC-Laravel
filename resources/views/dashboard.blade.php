<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MIKU EXPO 2025 - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --miku-teal: #39c5bb;
            --miku-dark-teal: #00a9a3;
            --miku-blue: #4a90e2;
            --miku-purple: #9c59d9;
            --miku-pink: #ff69b4;
            --miku-bg-dark: #0a0a2a;
            --miku-bg-light: #1a1a4a;
        }

        body {
            background: linear-gradient(135deg, var(--miku-bg-dark) 0%, var(--miku-bg-light) 100%);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .dashboard-header {
            background: linear-gradient(45deg, var(--miku-teal), var(--miku-purple));
            color: white;
            padding: 2rem 0;
            border-radius: 0 0 25px 25px;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(57, 197, 187, 0.3);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(57, 197, 187, 0.3);
        }

        .miku-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(57, 197, 187, 0.3);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-miku {
            background: linear-gradient(45deg, var(--miku-teal), var(--miku-blue));
            color: white;
            border: none;
            font-weight: 600;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .btn-miku:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(57, 197, 187, 0.6);
            color: white;
        }

        .table-dark {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .price-tag {
            background: linear-gradient(45deg, #ff6b6b, #ffa500);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                🎤 MIKU EXPO 2025 Admin
            </a>
            <div class="navbar-nav ms-auto">
                <span class="nav-link">Welcome, {{ Auth::user()->name }}!</span>
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Header -->
    <div class="dashboard-header">
        <div class="container">
            <h1 class="display-4 fw-bold">Admin Dashboard</h1>
            <p class="lead">MIKU EXPO 2025 Merchandise Sales Analytics</p>
        </div>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>🎵 Success!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="h1 text-warning">{{ $totalCustomers }}</div>
                    <p class="mb-0">Total Fans</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="h1 text-info">{{ $totalOrders }}</div>
                    <p class="mb-0">Total Orders</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="h1 text-success">₱{{ number_format($totalRevenue, 2) }}</div>
                    <p class="mb-0">Total Revenue</p>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="h1 text-primary">{{ $totalProducts }}</div>
                    <p class="mb-0">Products</p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Recent Orders -->
            <div class="col-lg-8 mb-4">
                <div class="miku-card p-4">
                    <h3 class="mb-4"><i class="fas fa-shopping-cart me-2"></i>Recent Orders</h3>
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>
                                        <strong>{{ $order->customer->username }}</strong>
                                        <br><small>{{ $order->customer->email }}</small>
                                    </td>
                                    <td>
                                        <span class="price-tag">₱{{ number_format($order->total_amount, 2) }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">No orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="col-lg-4 mb-4">
                <div class="miku-card p-4">
                    <h3 class="mb-4"><i class="fas fa-chart-line me-2"></i>Top Selling Products</h3>
                    @forelse($topProducts as $product)
                    <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded" style="background: rgba(255,255,255,0.1);">
                        <div>
                            <strong>{{ $product->name }}</strong>
                            <br>
                            <small class="text-muted">Sold: {{ $product->total_sold }}</small>
                        </div>
                        <span class="badge bg-success">{{ $product->total_sold }} units</span>
                    </div>
                    @empty
                    <p class="text-center">No sales data</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <a href="{{ route('customers.index') }}" class="btn btn-miku w-100 py-3">
                    <i class="fas fa-users fa-2x mb-2"></i><br>
                    Manage Customers
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('products.index') }}" class="btn btn-miku w-100 py-3">
                    <i class="fas fa-store fa-2x mb-2"></i><br>
                    Online Store
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('store') }}" class="btn btn-miku w-100 py-3">
                    <i class="fas fa-shopping-cart fa-2x mb-2"></i><br>
                    View Store
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>