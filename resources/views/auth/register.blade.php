@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg overflow-hidden rounded-3">
                <div class="bg-primary text-white p-4 text-center">
                    <h3 class="fw-bold mb-0">Sign Up</h3>
                </div>
                
                <div class="p-4 p-md-5 bg-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="row g-4">
                            <!-- BAGIAN KIRI -->
                            <div class="col-md-6 border-end-md">
                                <h6 class="text-primary fw-bold mb-3">Akun & Pribadi</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Nomor Telepon</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                    @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Confirm</label>
                                        <input type="password" name="password_confirmation" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Tempat Lahir</label>
                                        <input type="text" name="birth_place" class="form-control @error('birth_place') is-invalid @enderror" value="{{ old('birth_place') }}" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Tgl Lahir</label>
                                        <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- BAGIAN KANAN -->
                            <div class="col-md-6 ps-md-4">
                                <h6 class="text-primary fw-bold mb-3">Alamat Lengkap</h6>
                                
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Jalan / Gedung</label>
                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address') }}</textarea>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Kota</label>
                                        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city') }}" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Provinsi</label>
                                        <input type="text" name="province" class="form-control @error('province') is-invalid @enderror" value="{{ old('province') }}" required>
                                    </div>
                                </div>
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Negara</label>
                                        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label small fw-bold text-muted">Kode Pos</label>
                                        <input type="text" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" value="{{ old('zip_code') }}" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Gender</label>
                                    <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">
                        <button type="submit" class="btn btn-success w-100 py-3 fw-bold shadow">DAFTAR SEKARANG</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection