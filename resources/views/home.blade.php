@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section text-center mb-5">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">{{ __('messages.hero_title') }}</h1>
        <p class="lead mb-0">{{ __('messages.hero_desc') }}</p>
    </div>
</div>

<div class="container">
    <!-- Artikel Slider -->
    <h3 class="fw-bold border-start border-4 border-primary ps-3 mb-3">{{ __('messages.latest_news') }}</h3>
    
    <div id="newsCarousel" class="carousel slide mb-5 shadow rounded overflow-hidden" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($articles as $index => $art)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row g-0 bg-white">
                    <div class="col-md-6">
                        <!-- Perbaikan: Controller kamu mengirim key 'img', jadi panggil $art['img'] -->
                        <img src="{{ $art['img'] }}" class="d-block w-100" style="height: 300px; object-fit: cover;">
                    </div>
                    <div class="col-md-6 p-4 d-flex flex-column justify-content-center">
                        <h5 class="fw-bold">{{ $art['title'] }}</h5>
                        <p class="text-muted mb-2"><small>{{ $art['date'] }}</small></p>
                        <p class="card-text">{{ $art['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bg-dark rounded-circle p-3"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon bg-dark rounded-circle p-3"></span>
        </button>
    </div>

    <!-- 3 Tombol Utama (Link Route Sesuai web.php) -->
    <div class="row g-4 text-center mb-5">
        <!-- DONATE -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
                <div class="card-body py-5">
                    <h3 class="fw-bold text-primary">{{ __('messages.btn_donate') }}</h3>
                    <p class="text-muted">{{ __('messages.desc_donate') }}</p>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <!-- Link ke route 'donate' yang mengarah ke donateGeneral() -->
                    <a href="{{ route('donate') }}" class="btn btn-primary w-100 rounded-pill py-2">{{ __('messages.btn_go') }}</a>
                </div>
            </div>
        </div>

        <!-- PICK -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
                <div class="card-body py-5">
                    <h3 class="fw-bold text-success">{{ __('messages.btn_pick') }}</h3>
                    <p class="text-muted">{{ __('messages.desc_pick') }}</p>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <!-- Link ke route 'pick.list' yang mengarah ke listCampaigns() -->
                    <a href="{{ route('pick.list') }}" class="btn btn-success w-100 rounded-pill py-2">{{ __('messages.btn_go') }}</a>
                </div>
            </div>
        </div>

        <!-- MAKE -->
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm card-hover">
                <div class="card-body py-5">
                    <h3 class="fw-bold text-danger">{{ __('messages.btn_make') }}</h3>
                    <p class="text-muted">{{ __('messages.desc_make') }}</p>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <!-- Link ke route 'proposal' yang mengarah ke createProposal() -->
                    <a href="{{ route('proposal') }}" class="btn btn-danger w-100 rounded-pill py-2">{{ __('messages.btn_go') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection