@extends('layout.master')



@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <h2 class="text-center mb-4">Login</h2>

                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email', $email ?? '') }}" required
                                        autofocus placeholder="example@domain.com">
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" required placeholder="Enter your password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-box-arrow-in-left"></i> Login
                                </button>
                            </div>

                            <!-- Forgot Password
                            <div class="text-center mt-3">
                                <a href={{ route('reset-password') }} class="text-decoration-none">
                                    Forgot your password?
                                </a>
                            </div> -->

                            <hr class="my-4">

                            <!-- Register Redirect -->
                            <div class="text-center">
                                <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Register now</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle"></i>
                    <strong>Security Note:</strong> You will be automatically logged out after 15 minutes of inactivity.
                </div>
            </div>
        </div>
    </div>
@endsection
