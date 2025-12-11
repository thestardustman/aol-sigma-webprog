@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 1rem;">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0 fw-bold">Sign Up</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row g-3">
                    <!-- Kiri -->
                    <div class="col-md-6 border-end">
                        <h6 class="text-primary fw-bold mb-3">Akun & Pribadi</h6>
                        <div class="mb-3"><label class="form-label">Nama</label><input type="text" name="name" class="form-control" required></div>
                        <div class="mb-3"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="row g-2 mb-3">
                            <div class="col"><label class="form-label">Password</label><input type="password" name="password" class="form-control" required></div>
                            <div class="col"><label class="form-label">Confirm</label><input type="password" name="password_confirmation" class="form-control" required></div>
                        </div>
                        <div class="row g-2">
                            <div class="col"><label class="form-label">Tempat Lahir</label><input type="text" name="birth_place" class="form-control" required></div>
                            <div class="col"><label class="form-label">Tgl Lahir</label><input type="date" name="birth_date" class="form-control" required></div>
                        </div>
                    </div>
                    <!-- Kanan -->
                    <div class="col-md-6 ps-md-4">
                        <h6 class="text-primary fw-bold mb-3">Alamat</h6>
                        <div class="mb-3"><label class="form-label">Alamat Lengkap</label><textarea name="address" class="form-control" rows="2" required></textarea></div>
                        <div class="row g-2 mb-3">
                            <div class="col"><label class="form-label">Kota</label><input type="text" name="city" class="form-control" required></div>
                            <div class="col"><label class="form-label">Provinsi</label><input type="text" name="province" class="form-control" required></div>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col"><label class="form-label">Negara</label><input type="text" name="country" class="form-control" required></div>
                            <div class="col"><label class="form-label">Kode Pos</label><input type="text" name="zip_code" class="form-control" required></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option>Laki-laki</option><option>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success w-100 py-2 rounded-pill">Daftar Sekarang</button>
            </form>
        </div>
    </div>
</div>
@endsection