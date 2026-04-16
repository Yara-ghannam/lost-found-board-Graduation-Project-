@extends('layout.master')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center p-5">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-key text-primary" style="font-size: 3rem;"></i>
                        <h2 class="mt-3">Reset Password</h2>
                        <p class="text-muted">Enter your email address and we’ll send you a link to reset your password.</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle"></i> {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="password.email.html">
                        @csrf

                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       required
                                       autofocus
                                       placeholder="example@domain.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send"></i> Send Reset Link
                            </button>
                        </div>

                        <!-- Back to Login -->
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
