@extends('layouts.app')

@section('title', 'Add New Customer - MIKU EXPO 2025')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="miku-card p-4">
                <h2 class="text-center text-miku-teal mb-4">
                    <i class="fas fa-user-plus me-2"></i>Add New Customer
                </h2>

                <form method="POST" action="{{ route('customers.store') }}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-miku-light">First Name</label>
                                <input type="text" class="form-control" name="first_name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-miku-light">Last Name</label>
                                <input type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-miku-light">Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-miku-light">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-miku-light">Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-miku-light">Date of Birth</label>
                        <input type="date" class="form-control" name="date_of_birth">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-miku-light">Address</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-miku">
                            <i class="fas fa-save me-2"></i>Create Customer
                        </button>
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-miku">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection