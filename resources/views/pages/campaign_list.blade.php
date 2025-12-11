@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="mb-5 border-start border-4 border-success ps-4">
        <h2 class="fw-bold text-dark">Daftar Komunitas</h2>
        <p class="text-muted mb-0">Pilih komunitas yang ingin Anda bantu.</p>
    </div>
    <div class="row g-4">
        @foreach($campaigns as $camp)
        <div class="col-md-4">
            <div class="card-std h-100 d-flex flex-column card-hover">
                <div class="bg-light d-flex align-items-center justify-content-center text-muted overflow-hidden" style="height: 200px;">
                    <img src="{{ $camp->image ?? 'https://placehold.co/600x400' }}" class="w-100 h-100 object-fit-cover">
                </div>
                <div class="card-body p-4 d-flex flex-column">
                    <h5 class="fw-bold text-dark">{{ $camp->title }}</h5>
                    <p class="text-muted small mb-3"><i class="bi bi-people-fill me-1 text-success"></i> {{ $camp->community_name }}</p>
                    <div class="mt-auto pt-3">
                        <a href="{{ route('pick.detail', $camp->id) }}" class="btn btn-outline-success btn-pill w-100">LIHAT DETAIL</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection