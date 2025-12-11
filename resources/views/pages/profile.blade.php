@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-std p-5">
                <div class="text-center mb-5">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow" style="width: 100px; height: 100px; font-size: 3rem;">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <h2 class="fw-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-muted">{{ Auth::user()->email }} | {{ Auth::user()->phone }}</p>
                </div>

                <h5 class="fw-bold text-primary border-bottom pb-2 mb-4">Biodata Lengkap</h5>
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted fw-bold d-block">Tempat, Tanggal Lahir</small>
                        <span class="fs-5">{{ Auth::user()->birth_place }}, {{ Auth::user()->birth_date }}</span>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted fw-bold d-block">Jenis Kelamin</small>
                        <span class="fs-5">{{ Auth::user()->gender }}</span>
                    </div>
                    <div class="col-md-12">
                        <small class="text-muted fw-bold d-block">Alamat</small>
                        <span class="fs-5">{{ Auth::user()->address }}</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted fw-bold d-block">Kota</small>
                        <span class="fs-5">{{ Auth::user()->city }}</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted fw-bold d-block">Provinsi</small>
                        <span class="fs-5">{{ Auth::user()->province }}</span>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted fw-bold d-block">Negara</small>
                        <span class="fs-5">{{ Auth::user()->country }}</span>
                    </div>
                </div>

                <div class="mt-5 text-center">
                    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-pill px-4">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection