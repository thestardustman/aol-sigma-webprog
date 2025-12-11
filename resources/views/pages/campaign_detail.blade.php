@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        
        <!-- =======================
             KOLOM KIRI (DETAIL) 
        ======================== -->
        <div class="col-md-8">
            
            <!-- Tombol Kembali -->
            <div class="mb-4">
                <a href="{{ route('pick.list') }}" class="text-decoration-none text-muted d-inline-flex align-items-center fw-bold small hover-scale">
                    <i class="bi bi-arrow-left-circle-fill fs-4 me-2 text-secondary"></i> Kembali ke Daftar
                </a>
            </div>

            <!-- Kartu Detail Utama -->
            <div class="card-std p-0 mb-4 overflow-hidden">
                <!-- Gambar -->
                <div class="bg-light d-flex align-items-center justify-content-center text-muted position-relative" style="height: 400px; width: 100%;">
                    @if($campaign->image)
                        <img src="{{ $campaign->image }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $campaign->title }}"
                             onerror="this.onerror=null; this.src='https://placehold.co/800x400/e2e8f0/475569?text=No+Image';">
                    @else
                        <!-- Fallback jika tidak ada gambar -->
                        <div class="text-center">
                            <i class="bi bi-image fs-1 d-block mb-2 opacity-25"></i>
                            <span>No Image Available</span>
                        </div>
                    @endif
                </div>

                <!-- Teks Detail -->
                <div class="p-4 p-md-5">
                    <h2 class="fw-bold mb-3 text-dark">{{ $campaign->title }}</h2>
                    
                    <div class="d-flex flex-wrap align-items-center gap-4 text-muted mb-4 small">
                        <span class="d-flex align-items-center">
                            <i class="bi bi-people-fill me-2 text-success fs-5"></i> 
                            <span class="fw-bold text-dark">{{ $campaign->community_name }}</span>
                        </span>
                        <span class="d-flex align-items-center">
                            <i class="bi bi-calendar-event me-2 text-primary fs-5"></i> 
                            {{ $campaign->date }}
                        </span>
                    </div>

                    <hr class="text-muted opacity-25 my-4">
                    
                    <div class="text-secondary" style="line-height: 1.8; font-size: 1.05rem; text-align: justify;">
                        {{ $campaign->description }}
                    </div>
                </div>
            </div>
            
            <!-- Tombol Aksi Donasi (Sticky Call to Action) -->
            <div class="card-std p-4 d-flex align-items-center justify-content-between bg-primary text-white shadow-lg">
                <div class="me-3">
                    <h5 class="mb-1 fw-bold">Ingin membantu mereka?</h5>
                    <small class="text-white-50">Donasi Anda sangat berarti bagi program ini.</small>
                </div>
                <a href="{{ route('pick.pay', $campaign->id) }}" class="btn btn-light btn-pill text-primary px-5 py-2 fw-bold shadow hover-scale">
                    DONASI
                </a>
            </div>
        </div>

        <!-- =======================
             KOLOM KANAN (LEADERBOARD) 
        ======================== -->
        <div class="col-md-4">
            <!-- Spacer agar sejajar (Opsional) -->
            <div class="d-none d-md-block" style="height: 54px;"></div> 

            <!-- Kartu Top Donater -->
            <div class="card-std p-4 sticky-top" style="top: 100px; z-index: 1;">
                <div class="text-center mb-4">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        🏆
                    </div>
                    <h5 class="fw-bold mt-2">Top Donaters</h5>
                    <p class="text-muted small mb-0">Terima kasih #OrangBaik</p>
                </div>

                <ul class="list-group list-group-flush">
                    @forelse($topDonaters as $index => $d)

                    @php
                        $colors = ['#FFD700', '#C0C0C0', '#CD7F32']; // Emas, Perak, Perunggu
                        $bgColor = $colors[$index] ?? '#f8f9fa';      // Ambil warna berdasarkan index, atau default
                        $textColor = $index < 3 ? 'white' : 'black';  // Teks putih untuk juara 1-3
                        $styleCSS = "width:30px; height:30px; background-color: $bgColor; color: $textColor; font-weight: bold;";
                    @endphp
                    
                    <li class="list-group-item border-0 px-0 d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <!-- Badge Nomor -->
                            <span class="badge rounded-circle me-3 d-flex align-items-center justify-content-center shadow-sm" style="{{ $styleCSS }}">
                                {{ $index + 1 }}
                            </span>
                            <div class="lh-1">
                                <span class="fw-bold text-dark d-block text-truncate" style="max-width: 120px;">{{ $d->user->name }}</span>
                                <small class="text-muted" style="font-size: 0.7rem;">Donatur</small>
                            </div>
                        </div>
                        <span class="text-success fw-bold small">Rp {{ number_format($d->amount) }}</span>
                    </li>
                    @empty
                    <li class="text-center text-muted small py-5">
                        <i class="bi bi-inbox fs-1 d-block mb-3 opacity-25"></i>
                        Belum ada donasi. <br> Jadilah yang pertama!
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection