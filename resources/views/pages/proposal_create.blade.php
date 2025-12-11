@extends('layouts.app')
@section('content')
<div class="container mt-4 mb-5">
    <h2 class="fw-bold mb-4 text-danger border-start border-4 border-danger ps-3">{{ __('messages.btn_make') }}</h2>
    
    <form action="{{ route('proposal') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <!-- 1. Card Info Kegiatan -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-danger text-white fw-bold">Informasi Kegiatan</div>
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label">{{ __('messages.activity_name') }}</label><input type="text" name="activity_name" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Tanggal</label><input type="date" name="activity_date" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="activity_address" class="form-control" rows="2" required></textarea></div>
                        <div class="mb-3"><label class="form-label">Target (Rp)</label><input type="number" name="target_amount" class="form-control" required></div>
                    </div>
                </div>
            </div>

            <!-- 2. Card Info Penanggung Jawab -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-dark text-white fw-bold">Penanggung Jawab</div>
                    <div class="card-body">
                        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="pic_name" class="form-control" required></div>
                        <div class="row g-2 mb-3">
                            <div class="col"><label class="form-label">Tempat Lahir</label><input type="text" name="pic_birth_place" class="form-control" required></div>
                            <div class="col"><label class="form-label">Tgl Lahir</label><input type="date" name="pic_birth_date" class="form-control" required></div>
                        </div>
                        <div class="mb-3"><label class="form-label">Alamat</label><textarea name="pic_address" class="form-control" rows="2" required></textarea></div>
                        <div class="row g-2 mb-3">
                            <div class="col"><input type="text" name="pic_city" class="form-control" placeholder="Kota" required></div>
                            <div class="col"><input type="text" name="pic_zip" class="form-control" placeholder="Kode Pos" required></div>
                        </div>
                         <!-- (Silakan lengkapi field lain seperti provinsi/negara jika perlu) -->
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Upload & Submit -->
        <div class="card border-0 shadow-sm mt-4 p-4">
            <div class="mb-3">
                <label class="form-label fw-bold">{{ __('messages.upload') }} (PDF)</label>
                <input type="file" name="file" class="form-control" required>
            </div>
            <button class="btn btn-danger w-100 btn-lg rounded-pill fw-bold">{{ __('messages.btn_propose') }}</button>
        </div>
    </form>
</div>
@endsection