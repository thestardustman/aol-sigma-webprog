@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg overflow-hidden rounded-4">
                <div class="bg-primary text-white p-4 text-center">
                    <div class="mb-2" style="font-size: 3rem;">🚀</div>
                    <h3 class="fw-bold mb-1">Buat Akun Baru</h3>
                    <p class="text-white-50 small mb-0">Bergabung dan mulai berbagi kebaikan</p>
                </div>
                
                <div class="p-4 p-md-5 bg-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                            <input type="text" name="name" 
                                   class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="Masukkan nama lengkap"
                                   required autofocus>
                            @error('name') 
                                <span class="invalid-feedback">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Email</label>
                            <input type="email" name="email" 
                                   class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   placeholder="contoh@email.com"
                                   required>
                            @error('email') 
                                <span class="invalid-feedback">{{ $message }}</span> 
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Password</label>
                            <input type="password" name="password" 
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                   placeholder="Minimal 8 karakter"
                                   required>
                            @error('password') 
                                <span class="invalid-feedback">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control form-control-lg" 
                                   placeholder="Ulangi password"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold shadow btn-pill">
                            DAFTAR SEKARANG
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <span class="text-muted">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection