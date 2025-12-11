@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5"> <!-- Ukuran card diperkecil biar proporsional -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-dark">Welcome Back</h3>
                        <p class="text-muted small">Please login to continue</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                            <label for="floatingEmail" class="text-muted">{{ __('messages.email') }}</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="floatingPass" placeholder="Password" required>
                            <label for="floatingPass" class="text-muted">{{ __('messages.password') }}</label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm mb-4">Login</button>

                        <!-- Divider -->
                        <div class="d-flex align-items-center mb-4">
                            <hr class="flex-grow-1 my-0 text-muted">
                            <span class="px-3 text-muted small bg-white">or login with</span>
                            <hr class="flex-grow-1 my-0 text-muted">
                        </div>

                        <!-- Social Buttons (Dibuat Grid biar rapi) -->
                        <div class="row g-2">
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-danger w-100 btn-sm py-2"><i class="bi bi-google"></i> Google</button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-dark w-100 btn-sm py-2"><i class="bi bi-apple"></i> Apple</button>
                            </div>
                            <div class="col-4">
                                <button type="button" class="btn btn-outline-primary w-100 btn-sm py-2"><i class="bi bi-facebook"></i> FB</button>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <p class="small text-muted mb-0">Don't have an account?</p>
                            <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Create Account</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection