@extends('layouts.app')

@section('title', 'MIKU EXPO 2025 - Customer Management')

@section('styles')
<style>
    /* Customer Table Font Styles - Improved Consistency */
    .customer-table {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* Header Fonts */
    .table-header {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.5px;
        color: #ffffff !important;
        text-transform: uppercase;
    }
    
    /* Customer Data Fonts - Consistent Hierarchy */
    .customer-username {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 700;
        font-size: 1.05rem;
        color: #39c5bb !important; /* Miku teal */
    }
    
    .customer-name {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        color: #ffffff !important;
    }
    
    .customer-email {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 400;
        font-size: 0.9rem;
        color: #e0e0e0 !important; /* Slightly lighter for better readability */
    }
    
    .customer-phone {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 400;
        font-size: 0.9rem;
        color: #e0e0e0 !important;
    }
    
    .customer-items {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 400;
        font-size: 0.85rem;
        color: #cccccc !important;
        font-style: italic;
    }
    
    /* Action buttons font */
    .action-btn {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.3px;
    }
    
    /* Table Styling */
    .table-dark {
        color: #ffffff !important;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(57, 197, 187, 0.1) !important;
        color: #ffffff !important;
    }
    
    
    .btn-view-all:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(156, 89, 217, 0.6);
        color: white !important;
    }
    
    /* Stat Cards */
    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(57, 197, 187, 0.3);
        border-radius: 15px;
        padding: 1rem;
        transition: all 0.3s ease;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(57, 197, 187, 0.3);
    }
    
    .stat-card .h2 {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 700;
        font-size: 2rem;
    }
    
    .stat-card p {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    /* Miku Avatar and Fan Count */
    .miku-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #39c5bb, #4a90e2);
        border-radius: 50%;
        margin: 0 auto;
        border: 3px solid white;
        position: relative;
    }
    
    .miku-avatar::after {
        content: "🎤";
        font-size: 24px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    
    .fan-count {
        background: linear-gradient(45deg, #9c59d9, #ff69b4);
        color: white;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 700;
        font-size: 1.3rem;
        margin: 0 auto;
        border: 3px solid white;
    }
    
    /* Text Colors */
    .text-miku-light {
        color: #ffffff !important;
    }
    
    .text-miku-muted {
        color: #a0a0a0 !important;
    }
    
    .text-miku-teal {
        color: #39c5bb !important;
    }
    
    .text-miku-blue {
        color: #4a90e2 !important;
    }
    
    .text-miku-purple {
        color: #9c59d9 !important;
    }
    
    .text-miku-pink {
        color: #ff69b4 !important;
    }
    
    /* Alert Styling */
    .alert-success {
        background: rgba(57, 197, 187, 0.1);
        border: 1px solid #39c5bb;
        color: #ffffff;
    }
    
    /* Card Styling */
    .miku-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(57, 197, 187, 0.2);
        border-radius: 15px;
        overflow: hidden;
    }
    
    /* Pagination Styling */
    .pagination .page-link {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(57, 197, 187, 0.3);
        color: #39c5bb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(45deg, #39c5bb, #4a90e2);
        border-color: #39c5bb;
        color: white;
    }
    
    .pagination .page-link:hover {
        background: rgba(57, 197, 187, 0.2);
        color: #ffffff;
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- MIKU EXPO Header -->
    <div class="expo-header text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-2 text-center">
                    <div class="fan-count">
                        {{ $customers->total() }}
                    </div>
                    <small class="text-miku-muted">Total Fans</small>
                </div>
                <div class="col-md-8">
                    <h1 class="display-4 text-miku-light mb-2">🎤 Customer Database</h1>
                    <p class="lead text-miku-muted mb-0">Manage your virtual singer's fan community</p>
                </div>
                <div class="col-md-2 text-center">
                    <div class="miku-avatar"></div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong class="text-miku-teal">🎵 Success!</strong> 
            <span class="text-miku-light">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Action Bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="text-miku-teal mb-0">
            <i class="fas fa-users me-2"></i>Customer Management
        </h3>
        <div>
            <!-- Add New Customer Button -->
            <a href="{{ route('customers.create') }}" class="btn btn-miku">
                <i class="fas fa-plus me-2"></i>Add New Customer
            </a>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="h2 text-miku-teal">{{ $customers->total() }}</div>
                <p class="text-miku-muted mb-0">Total Customers</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="h2 text-miku-blue">{{ $customers->count() }}</div>
                <p class="text-miku-muted mb-0">Showing</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="h2 text-miku-purple">{{ $totalOrders }}</div>
                <p class="text-miku-muted mb-0">Total Orders</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="h2 text-miku-pink">₱{{ number_format($totalRevenue, 2) }}</div>
                <p class="text-miku-muted mb-0">Total Revenue</p>
            </div>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="card miku-card">
        <div class="card-header">
            <h4 class="mb-0 text-miku-light table-header"><i class="fas fa-list me-2"></i>Fan List</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive customer-table">
                <table class="table table-dark table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="table-header text-miku-teal">🎤 Username</th>
                            <th class="table-header text-miku-blue">👤 Name</th>
                            <th class="table-header text-miku-purple">📧 Email</th>
                            <th class="table-header text-miku-pink">📞 Phone</th>
                            <th class="table-header text-miku-light">🛍️ Items Purchased</th>
                            <th class="table-header text-miku-teal">⚡ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>
                                <strong class="customer-username">{{ $customer->username }}</strong>
                            </td>
                            <td>
                                <span class="customer-name">{{ $customer->first_name }} {{ $customer->last_name }}</span>
                            </td>
                            <td>
                                <span class="customer-email">{{ $customer->email }}</span>
                            </td>
                            <td>
                                <span class="customer-phone">{{ $customer->phone }}</span>
                            </td>
                            <td>
                                @if($customer->purchased_items)
                                    <small class="customer-items">{{ Str::limit($customer->purchased_items, 50) }}</small>
                                @else
                                    <span class="text-muted customer-items">No purchases yet</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('customers.show', $customer->id) }}" 
                                       class="btn btn-outline-info btn-sm action-btn" title="View Details">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" 
                                       class="btn btn-outline-warning btn-sm action-btn" title="Edit Customer">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm action-btn"
                                                onclick="return confirm('Are you sure you want to delete {{ $customer->username }}?')" 
                                                title="Delete Customer">
                                            <i class="fas fa-trash me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="text-muted">
                                    <h4 class="text-miku-teal">🎵 No Fans Found</h4>
                                    <p class="text-miku-muted">Start building your Miku fan community!</p>
                                    <a href="{{ route('customers.create') }}" class="btn btn-miku mt-2">
                                        <i class="fas fa-plus me-2"></i>Add First Fan
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination and View All Section -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <!-- Pagination Info -->
        <div class="text-miku-muted">
            <small>Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} customers</small>
        </div>
        
        <!-- Pagination Links -->
        @if($customers->hasPages())
        <div class="d-flex justify-content-center">
            {{ $customers->links() }}
        </div>
        @endif
        
    </div>
</div>
@endsection