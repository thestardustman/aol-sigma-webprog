@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- HEADER -->
    <div class="text-center mb-5">
        <h1 class="display-3 font-weight-bold">SDG-HOPE</h1>
        <p class="lead">Platform donasi untuk mendukung SDG 9, 14, 15, dan 16.</p>
    </div>

    <!-- SLIDER / CAROUSEL ARTIKEL -->
    <div id="articleSlider" class="carousel slide mb-5" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($articles as $index => $art)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $art['image'] }}" class="d-block w-100" style="height: 350px; object-fit: cover; opacity: 0.8;">
                <div class="carousel-caption d-none d-md-block bg-dark text-white rounded p-3">
                    <h5><a href="{{ $art['link'] }}" class="text-white">{{ $art['title'] }}</a></h5>
                    <small>{{ $art['date'] }}</small>
                    <p>{{ $art['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#articleSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#articleSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <!-- ISI (3 TOMBOL) -->
    <div class="row text-center">
        <!-- 1. DONATE (General) - Warna Biru -->
        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h3 class="text-primary">DONATE</h3>
                    <p>Donasi umum untuk semua kegiatan.</p>
                    <a href="{{ route('donate.general') }}" class="btn btn-primary btn-lg btn-block">DONATE</a>
                </div>
            </div>
        </div>

        <!-- 2. PICK WHERE - Warna Hijau (Misal) -->
        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h3 class="text-success">PICK WHERE YOUR DONATION GOES</h3>
                    <p>Pilih komunitas spesifik.</p>
                    <a href="{{ route('campaigns.index') }}" class="btn btn-success btn-lg btn-block">PICK</a>
                </div>
            </div>
        </div>

        <!-- 3. MAKE A DONATION - Warna Kuning/Warning (BEDA WARNA) -->
        <div class="col-md-4 mb-3">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h3 class="text-warning">MAKE A DONATION</h3>
                    <p>Ajukan proposal kegiatanmu.</p>
                    <a href="{{ route('proposal.create') }}" class="btn btn-warning btn-lg btn-block text-white">PROPOSE</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection