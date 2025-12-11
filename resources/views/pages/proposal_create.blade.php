@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-4 text-center">
                <h2 class="page-title text-danger">{{ __('messages.btn_make') }}</h2>
                <p class="text-muted">Lengkapi formulir di bawah untuk mengajukan penggalangan dana.</p>
            </div>

            <form action="{{ route('proposal') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Kiri: Info Kegiatan -->
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

                    <!-- Kanan: PIC & File -->
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
                                    <input type="text" name="pic_city" class="form-control" required>
                                </div>
                                <div class="col">
                                    <label class="form-label small fw-bold text-secondary">Kode Pos</label>
                                    <input type="text" name="pic_zip" class="form-control" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-danger">Upload Proposal (PDF)</label>
                                <input type="file" name="file" class="form-control" required>
                            </div>

                            <button class="btn btn-danger btn-pill w-100 mt-3 py-2 shadow">
                                {{ __('messages.btn_propose') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection