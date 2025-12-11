@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row g-5">
        <!-- Kiri: Detail -->
        <div class="col-md-8">
            <div class="card-std p-0 mb-4">
                <div class="bg-light d-flex align-items-center justify-content-center text-muted" style="height: 300px;">
                     <!-- Image -->
                     <i class="bi bi-image fs-1"></i>
                </div>
                <div class="p-4 p-md-5">
                    <h2 class="fw-bold mb-2">{{ $campaign->title }}</h2>
                    <div class="d-flex align-items-center text-muted mb-4 small">
                        <span class="me-3"><i class="bi bi-people me-1"></i> {{ $campaign->community_name }}</span>
                        <span><i class="bi bi-calendar me-1"></i> {{ $campaign->date }}</span>
                    </div>
                    <hr class="text-muted my-4">
                    <p class="text-secondary" style="line-height: 1.8;">
                        {{ $campaign->description }}
                    </p>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="card-std p-4 d-flex align-items-center justify-content-between bg-primary text-white">
                <div>
                    <h5 class="mb-0 fw-bold">Ingin membantu mereka?</h5>
                    <small class="text-white-50">Donasi Anda sangat berarti.</small>
                </div>
                <a href="{{ route('pick.pay', $campaign->id) }}" class="btn btn-light btn-pill text-primary px-4 shadow">
                    {{ __('messages.btn_donate') }}
                </a>
            </div>
        </div>

        <!-- Kanan: Leaderboard -->
        <div class="col-md-4">
            <div class="card-std p-4">
                <h5 class="fw-bold border-bottom pb-3 mb-3 text-center">🏆 Top Donaters</h5>
                <ul class="list-group list-group-flush">
                    @forelse($topDonaters as $index => $d)
                    <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <span class="badge bg-light text-dark rounded-circle me-2" style="width:25px;height:25px;display:flex;align-items:center;justify-content:center;">{{ $index + 1 }}</span>
                            <span class="fw-bold text-dark small">{{ $d->user->name }}</span>
                        </div>
                        <span class="text-success fw-bold small">Rp {{ number_format($d->amount) }}</span>
                    </li>
                    @empty
                    <li class="text-center text-muted small py-4">Belum ada donasi. Jadilah yang pertama!</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection