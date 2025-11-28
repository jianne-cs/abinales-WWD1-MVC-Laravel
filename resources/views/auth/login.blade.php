@extends('layouts.app')

@section('title', 'Login - MIKU EXPO 2025')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-miku-teal">🎤 MIKU EXPO 2025</h1>
                <p class="lead text-miku-muted">Admin Portal - Merchandise Management</p>
            </div>

            <div class="card miku-card">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="form-label text-miku-light">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="admin@mikuexpo.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-miku-light">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-miku-light">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   placeholder="Enter password (123)">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong class="text-miku-light">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-miku-muted" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-miku btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login to Dashboard
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-miku-muted">
                    <strong class="text-miku-teal">Demo Credentials:</strong><br>
                    <span class="text-miku-light">Email: admin@mikuexpo.com</span><br>
                    <span class="text-miku-light">Password: 123</span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection