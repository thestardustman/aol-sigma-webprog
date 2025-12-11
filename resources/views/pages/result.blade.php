@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center card-std p-5" style="max-width: 500px;">
        @if($status == 'successful')
            <div class="mb-3 text-success"><i class="bi bi-check-circle-fill" style="font-size: 5rem;"></i></div>
            <h1 class="display-5 fw-bold text-success">BERHASIL!</h1>
            <p class="text-muted">Pembayaran Anda telah diterima. Terima kasih atas donasi Anda.</p>
        @else
            <div class="mb-3 text-danger"><i class="bi bi-x-circle-fill" style="font-size: 5rem;"></i></div>
            <h1 class="display-5 fw-bold text-danger">GAGAL</h1>
            <p class="text-muted">Maaf, pembayaran gagal diproses. Silakan coba lagi.</p>
        @endif
        <a href="{{ route('home') }}" class="btn btn-primary btn-pill px-5 mt-4">KEMBALI KE BERANDA</a>
    </div>
</div>
@endsection