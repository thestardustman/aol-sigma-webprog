@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="card border-0 shadow-lg p-4" style="width: 100%; max-width: 450px; border-radius: 1rem;">
        <h3 class="text-center fw-bold mb-4">Login</h3>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="name@example.com" required>
                <label for="floatingEmail">{{ __('messages.email') }}</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPass" placeholder="Password" required>
                <label for="floatingPass">{{ __('messages.password') }}</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 rounded-pill mb-3">Login</button>

            <!-- Social Media Dummy -->
            <p class="text-center text-muted small mb-2">Or login with</p>
            <div class="d-grid gap-2">
                <button type="button" class="btn btn-outline-danger btn-sm"><i class="bi bi-google"></i> Google</button>
                <button type="button" class="btn btn-outline-dark btn-sm"><i class="bi bi-apple"></i> Apple</button>
                <button type="button" class="btn btn-outline-primary btn-sm"><i class="bi bi-facebook"></i> Facebook</button>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('register') }}" class="text-decoration-none">Create an Account</a>
            </div>
        </form>
    </div>
</div>
@endsection