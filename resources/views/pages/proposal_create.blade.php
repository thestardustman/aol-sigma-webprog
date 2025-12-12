@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            @if(!Auth::user()->isKycVerified())
                <div class="card-std p-5 text-center">
                    <div class="mb-4">
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px; font-size: 3rem;">
                            🔒
                        </div>
                    </div>
                    <h3 class="fw-bold text-dark mb-3">Verifikasi Identitas Diperlukan</h3>
                    <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto;">
                        Untuk membuat campaign penggalangan dana, Anda perlu memverifikasi identitas terlebih dahulu dengan mengunggah foto KTP dan selfie.
                    </p>
                    
                    @if(Auth::user()->isKycPending())
                        <div class="alert alert-info d-inline-block">
                            <i class="bi bi-hourglass-split me-2"></i>Dokumen Anda sedang dalam proses verifikasi oleh tim kami.
                        </div>
                    @else
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning btn-pill px-5 py-3 fw-bold shadow">
                            <i class="bi bi-shield-check me-2"></i>Verifikasi Sekarang
                        </a>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                            <i class="bi bi-arrow-left me-1"></i>Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @else
                <div class="mb-4 text-center">
                    <h2 class="page-title text-danger">{{ __('messages.btn_make') ?? 'Buat Campaign' }}</h2>
                    <p class="text-muted">Lengkapi formulir di bawah untuk mengajukan penggalangan dana.</p>
                </div>

                <form action="{{ route('proposal') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card-std p-4 h-100">
                                <h5 class="fw-bold text-danger mb-4"><i class="bi bi-activity me-2"></i>Informasi Kegiatan</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Nama Kegiatan</label>
                                    <input type="text" name="activity_name" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Tanggal Pelaksanaan</label>
                                    <input type="date" name="activity_date" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Alamat Lokasi</label>
                                    <textarea name="activity_address" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Target Donasi (Rp)</label>
                                    <input type="number" name="target_amount" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card-std p-4 h-100">
                                <h5 class="fw-bold text-dark mb-4"><i class="bi bi-person-badge me-2"></i>Penanggung Jawab</h5>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-secondary">Nama Lengkap PIC</label>
                                    <input type="text" name="pic_name" class="form-control" value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label class="form-label small fw-bold text-secondary">Kota</label>
                                        <input type="text" name="pic_city" class="form-control" value="{{ Auth::user()->city }}" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label small fw-bold text-secondary">Kode Pos</label>
                                        <input type="text" name="pic_zip" class="form-control" value="{{ Auth::user()->zip_code }}" required>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-danger">Upload Proposal (PDF)</label>
                                    <input type="file" name="file" class="form-control" accept=".pdf,.doc,.docx" required>
                                </div>

                                <button class="btn btn-danger btn-pill w-100 mt-3 py-2 shadow">
                                    {{ __('messages.btn_propose') ?? 'AJUKAN PROPOSAL' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection