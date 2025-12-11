@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->
<div class="hero-section text-center text-white d-flex align-items-center justify-content-center mb-5" 
     style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%); min-height: 400px; margin-top: -1px;">
    <div class="container">
        <h1 class="display-3 fw-bold mb-3">MARI BERBAGI HARAPAN</h1>
        <p class="lead mb-4 mx-auto text-light opacity-75" style="max-width: 700px;">
            Platform donasi terpercaya untuk mewujudkan mimpi mereka yang membutuhkan.
        </p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#actionSection" class="btn btn-light text-primary btn-pill shadow-lg">
                MULAI SEKARANG
            </a>
        </div>
    </div>
</div>

<div class="container pb-5" id="actionSection">
    
    <!-- ARTIKEL SLIDER -->
    <div class="d-flex align-items-center mb-4 ps-2">
        <div class="bg-primary rounded-pill me-3" style="width: 6px; height: 35px;"></div>
        <h3 class="fw-bold m-0 text-dark">Berita Terbaru</h3>
    </div>
    
    <div id="newsCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
        <div class="carousel-inner card-std p-0">
            @foreach($articles as $index => $art)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row g-0">
                    <div class="col-md-6 bg-light" style="min-height: 300px;">
                        <img src="{{ $art['img'] }}" class="d-block w-100 h-100 object-fit-cover"
                             onerror="this.src='https://placehold.co/800x400/e2e8f0/475569?text=No+Image'" alt="Img">
                    </div>
                    <div class="col-md-6 p-5 d-flex flex-column justify-content-center">
                        <div class="mb-2"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill small fw-bold">BERITA</span></div>
                        <h3 class="fw-bold text-dark mb-2">{{ $art['title'] }}</h3>
                        <p class="text-muted small mb-3"><i class="bi bi-calendar-event me-2"></i> {{ $art['date'] }}</p>
                        <p class="text-secondary">{{ $art['description'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon bg-dark rounded-circle p-3 bg-opacity-50"></span></button>
        <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next"><span class="carousel-control-next-icon bg-dark rounded-circle p-3 bg-opacity-50"></span></button>
    </div>

    <!-- TIGA TOMBOL UTAMA -->
    <div class="row g-4 text-center">
        <!-- DONATE -->
        <div class="col-md-4">
            <div class="card-std h-100 card-hover p-4 pt-5">
                <div class="mb-4"><div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2.5rem;">💙</div></div>
                <h4 class="fw-bold text-dark mb-2">DONASI</h4>
                <p class="text-muted small mb-4 px-3">Donasi cepat tanpa memilih program spesifik.</p>
                <div class="mt-auto"><a href="{{ route('donate') }}" class="btn btn-primary w-100 btn-pill shadow-sm">LANJUT</a></div>
            </div>
        </div>
        <!-- PICK -->
        <div class="col-md-4">
            <div class="card-std h-100 card-hover p-4 pt-5">
                <div class="mb-4"><div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2.5rem;">🌍</div></div>
                <h4 class="fw-bold text-dark mb-2">PILIH DONASI</h4>
                <p class="text-muted small mb-4 px-3">Pilih komunitas dan lihat peringkat donatur.</p>
                <div class="mt-auto"><a href="{{ route('pick.list') }}" class="btn btn-success w-100 btn-pill shadow-sm">LANJUT</a></div>
            </div>
        </div>
        <!-- MAKE -->
        <div class="col-md-4">
            <div class="card-std h-100 card-hover p-4 pt-5">
                <div class="mb-4"><div class="bg-danger bg-opacity-10 text-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 2.5rem;">📢</div></div>
                <h4 class="fw-bold text-dark mb-2">BUAT DONASI</h4>
                <p class="text-muted small mb-4 px-3">Ajukan proposal penggalangan dana Anda.</p>
                <div class="mt-auto"><a href="{{ route('proposal') }}" class="btn btn-danger w-100 btn-pill shadow-sm">LANJUT</a></div>
            </div>
        </div>
    </div>
</div>
@endsection