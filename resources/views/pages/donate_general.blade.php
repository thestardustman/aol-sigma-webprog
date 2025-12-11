@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card border-0 shadow p-5 text-center" style="max-width: 500px; border-radius: 1rem;">
        <h2 class="text-primary fw-bold mb-3">{{ __('messages.btn_donate') }}</h2>
        <p class="text-muted mb-4">{{ __('messages.desc_donate') }}</p>
        <form action="{{ route('donate') }}" method="POST">
            @csrf
            <label class="form-label fw-bold">{{ __('messages.amount') }}</label>
            <div class="input-group mb-4">
                <span class="input-group-text bg-primary text-white fw-bold">Rp</span>
                <input type="number" name="amount" class="form-control form-control-lg" required>
            </div>
            <button class="btn btn-primary w-100 rounded-pill py-2 fw-bold">{{ __('messages.btn_pay') }}</button>
        </form>
    </div>
</div>
@endsection