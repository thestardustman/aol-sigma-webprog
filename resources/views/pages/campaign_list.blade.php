@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-4 border-start border-4 border-success ps-3">{{ __('messages.btn_pick') }}</h2>
    <div class="row g-4">
        <!-- Controller mengirim variabel $campaigns -->
        @foreach($campaigns as $camp)
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                <div class="bg-secondary text-white d-flex justify-content-center align-items-center" style="height: 200px;">
                    <!-- Jika ada image di DB pakai: <img src="{{ $camp->image }}">, ini dummy -->
                    <span class="fs-1">IMAGE</span>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold">{{ $camp->title }}</h5> <!-- Pastikan di DB kolomnya title -->
                    <p class="text-muted small mb-2">{{ $camp->community_name }} | {{ $camp->date }}</p>
                    <a href="{{ route('pick.detail', $camp->id) }}" class="btn btn-outline-success w-100 rounded-pill">{{ __('messages.read_more') }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection