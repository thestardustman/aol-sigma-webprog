@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="mb-4">
                <a href="{{ route('profile') }}" class="text-decoration-none text-muted d-inline-flex align-items-center fw-bold small">
                    <i class="bi bi-arrow-left-circle-fill fs-4 me-2 text-secondary"></i> Kembali ke Profil
                </a>
            </div>

            <div class="card-std p-0 overflow-hidden">
                <div class="bg-primary text-white p-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Profil</h4>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-4 p-md-5">
                    @csrf
                    @method('PUT')

                    <h6 class="text-primary fw-bold mb-3">Informasi Dasar</h6>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" required>
                            @error('name')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone', $user->phone) }}" placeholder="08xxxxxxxxxx">
                            @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror" 
                                   value="{{ old('birth_place', $user->birth_place) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" 
                                   value="{{ old('birth_date', $user->birth_date) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Jenis Kelamin</label>
                            <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">Pilih...</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-primary fw-bold mb-3">Alamat</h6>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <label class="form-label small fw-bold text-muted">Alamat Lengkap</label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" 
                                      rows="3">{{ old('address', $user->address) }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kota</label>
                            <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" 
                                   value="{{ old('city', $user->city) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Provinsi</label>
                            <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" 
                                   value="{{ old('province', $user->province) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Negara</label>
                            <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" 
                                   value="{{ old('country', $user->country) }}" placeholder="Indonesia">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-muted">Kode Pos</label>
                            <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" 
                                   value="{{ old('zip_code', $user->zip_code) }}">
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-pill px-4">
                            <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('profile') }}" class="btn btn-outline-secondary btn-pill px-4">Batal</a>
                    </div>
                </form>
            </div>

            @if(!$user->isKycVerified())
            <div class="card-std p-0 overflow-hidden mt-4">
                <div class="bg-warning text-dark p-4">
                    <h5 class="fw-bold mb-0"><i class="bi bi-shield-check me-2"></i>Verifikasi Identitas (KYC)</h5>
                </div>

                <div class="p-4 p-md-5">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    @if($user->kyc_status === 'rejected' && $user->kyc_rejection_reason)
                        <div class="alert alert-danger">
                            <strong><i class="bi bi-x-circle me-2"></i>Pengajuan Anda ditolak:</strong><br>
                            {{ $user->kyc_rejection_reason }}
                        </div>
                    @endif

                    @if($user->isKycPending())
                        <div class="alert alert-info">
                            <i class="bi bi-hourglass-split me-2"></i>
                            Dokumen Anda sedang dalam proses verifikasi. Mohon tunggu konfirmasi dari admin.
                        </div>
                    @else
                        @php $profileCompletion = $user->getProfileCompletionPercentage(); @endphp
                        
                        @if($profileCompletion < 70)
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                <strong>Profil belum lengkap!</strong> Anda harus melengkapi minimal 70% profil sebelum mengajukan verifikasi KYC.
                                <br>Kelengkapan saat ini: <strong>{{ $profileCompletion }}%</strong>
                            </div>
                        @endif

                        <p class="text-muted mb-4">
                            Untuk membuat campaign penggalangan dana, Anda perlu memverifikasi identitas dengan mengunggah foto KTP dan selfie.
                        </p>

                        <form action="{{ route('profile.kyc') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label small fw-bold text-muted">Nomor KTP (NIK)</label>
                                    <input type="text" name="ktp_number" class="form-control @error('ktp_number') is-invalid @enderror" 
                                           value="{{ old('ktp_number', $user->ktp_number) }}" 
                                           maxlength="16" placeholder="16 digit NIK">
                                    @error('ktp_number')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Foto KTP</label>
                                    <input type="file" name="ktp_photo" class="form-control @error('ktp_photo') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">JPG/PNG, maksimal 5MB</small>
                                    @error('ktp_photo')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">Selfie Memegang KTP</label>
                                    <input type="file" name="selfie_photo" class="form-control @error('selfie_photo') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">JPG/PNG, maksimal 5MB</small>
                                    @error('selfie_photo')<span class="invalid-feedback d-block">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-warning btn-pill mt-4">
                                <i class="bi bi-upload me-2"></i>Kirim untuk Verifikasi
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
