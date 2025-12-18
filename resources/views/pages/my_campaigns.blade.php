@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="page-title text-danger mb-1">Campaign Saya</h2>
                    <p class="text-muted">Kamu sudah terverifikasi! Berikut adalah daftar campaign yang kamu buat.</p>
                </div>
                <a href="{{ route('proposal') }}" class="btn btn-danger btn-pill px-4">
                    <i class="bi bi-plus-lg me-2"></i>Buat Campaign Baru
                </a>
            </div>

            <!-- Proposals Status -->
            <div class="row g-4 mb-5">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-send me-2"></i>Proposal yang Diajukan</h5>
                </div>
                @forelse($proposals as $proposal)
                <div class="col-md-6 col-lg-4">
                    <div class="card-std h-100">
                        @if($proposal->thumbnail)
                            <img src="{{ asset('storage/' . $proposal->thumbnail) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="fw-bold mb-0">{{ $proposal->activity_name }}</h6>
                                @if($proposal->status === 'pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i>Pending</span>
                                @elseif($proposal->status === 'approved')
                                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Disetujui</span>
                                @else
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Ditolak</span>
                                @endif
                            </div>
                            <p class="text-muted small mb-2">{{ Str::limit($proposal->activity_address, 50) }}</p>
                            <div class="d-flex justify-content-between text-muted small">
                                <span><i class="bi bi-calendar me-1"></i>{{ $proposal->activity_date }}</span>
                                <span class="text-success fw-bold">Rp {{ number_format($proposal->target_amount) }}</span>
                            </div>
                            @if($proposal->status === 'rejected' && $proposal->rejection_reason)
                                <div class="alert alert-danger py-2 mt-2 small mb-0">
                                    <i class="bi bi-info-circle me-1"></i>{{ $proposal->rejection_reason }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                        <p>Belum ada proposal yang diajukan.</p>
                        <a href="{{ route('proposal') }}" class="btn btn-danger btn-pill">Buat Proposal Pertama</a>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Active Campaigns -->
            <div class="row g-4">
                <div class="col-12">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-megaphone me-2"></i>Campaign Aktif</h5>
                </div>
                @forelse($campaigns as $campaign)
                <div class="col-md-6 col-lg-4">
                    <div class="card-std h-100">
                        @if($campaign->img)
                            <img src="{{ asset('storage/' . $campaign->img) }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px;">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        @endif
                        <div class="p-3">
                            <h6 class="fw-bold mb-2">{{ $campaign->title }}</h6>
                            <p class="text-muted small mb-2">{{ Str::limit($campaign->description, 60) }}</p>
                            
                            <!-- Progress -->
                            @php
                                $progress = $campaign->target > 0 ? min(100, ($campaign->collected / $campaign->target) * 100) : 0;
                            @endphp
                            <div class="progress mb-2" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: {{ $progress }}%"></div>
                            </div>
                            <div class="d-flex justify-content-between small">
                                <span class="text-success fw-bold">Rp {{ number_format($campaign->collected) }}</span>
                                <span class="text-muted">{{ number_format($progress, 0) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>Belum ada campaign aktif. Ajukan proposal dan tunggu persetujuan admin!
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
