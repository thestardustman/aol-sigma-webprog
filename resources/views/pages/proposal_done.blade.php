@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center card-std p-5" style="max-width: 500px;">
        <div class="mb-3 text-info"><i class="bi bi-file-earmark-check-fill" style="font-size: 5rem;"></i></div>
        <h1 class="display-5 fw-bold text-info">PROPOSAL TERKIRIM!</h1>
        <p class="text-muted">Data Anda telah kami terima dan sedang dalam proses peninjauan.</p>
        <a href="{{ route('home') }}" class="btn btn-primary btn-pill px-5 mt-4">KEMBALI KE BERANDA</a>
    </div>
</div>
@endsection