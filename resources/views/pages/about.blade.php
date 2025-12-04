@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Jumbotron Header -->
    <div class="jumbotron bg-dark text-white text-center">
        <h1 class="display-4">About SDG-HOPE</h1>
        <p class="lead">Bersama membangun masa depan yang berkelanjutan.</p>
    </div>

    <!-- Content SDG -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h3>Who We Are</h3>
            <p class="text-justify">
                SDG-Hope adalah platform donasi yang didedikasikan untuk mendukung pencapaian Sustainable Development Goals (SDGs), 
                khususnya poin ke-9, 14, 15, dan 16. Kami menghubungkan donatur dengan komunitas lokal yang bergerak nyata di lapangan.
            </p>
            <p>
                Kami percaya bahwa perubahan besar dimulai dari langkah kecil. Dengan transparansi dan kemudahan akses, 
                siapapun bisa menjadi pahlawan bagi bumi dan sesama.
            </p>
        </div>
        <div class="col-md-6">
            <h3>Our Focus</h3>
            <ul class="list-group">
                <li class="list-group-item"><strong>SDG 9:</strong> Industri, Inovasi, dan Infrastruktur.</li>
                <li class="list-group-item"><strong>SDG 14:</strong> Ekosistem Laut (Life Below Water).</li>
                <li class="list-group-item"><strong>SDG 15:</strong> Ekosistem Darat (Life on Land).</li>
                <li class="list-group-item"><strong>SDG 16:</strong> Perdamaian, Keadilan, dan Kelembagaan yang Tangguh.</li>
            </ul>
        </div>
    </div>

    <!-- Team Section (Optional) -->
    <div class="row mt-5 text-center">
        <div class="col-12 mb-4">
            <h3>Our Team</h3>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Nama Ketua</h5>
                <p class="text-muted">Project Manager</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Nama Anggota 1</h5>
                <p class="text-muted">Developer</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Nama Anggota 2</h5>
                <p class="text-muted">Designer</p>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Back to Home</a>
    </div>
</div>
@endsection