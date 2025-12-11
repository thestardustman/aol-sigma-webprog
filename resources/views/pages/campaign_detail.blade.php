@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row g-5">
        <!-- Kiri: Detail -->
        <div class="col-md-8">
            <h1 class="fw-bold mb-2">{{ $campaign->title }}</h1>
            <p class="text-muted mb-4">{{ $campaign->community_name }} &bull; {{ $campaign->date }}</p>
            <div class="p-4 bg-white shadow-sm rounded mb-4">
                <p>{{ $campaign->description }}</p>
            </div>
            <a href="{{ route('pick.pay', $campaign->id) }}" class="btn btn-success btn-lg rounded-pill px-5 fw-bold shadow">{{ __('messages.btn_donate') }}</a>
        </div>

        <!-- Kanan: Leaderboard -->
        <div class="col-md-4">
            <div class="card border-0 shadow">
                <div class="card-header bg-warning text-dark fw-bold text-center">
                    TOP 10 DONATER
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($topDonors as $d)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span class="fw-bold">{{ $d->user->name }}</span>
                        <span class="badge bg-success rounded-pill">Rp {{ number_format($d->amount) }}</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted">Belum ada donasi.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection