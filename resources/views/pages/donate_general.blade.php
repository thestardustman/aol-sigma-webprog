@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-std p-5 text-center">
                <div class="mb-4 text-primary"><i class="bi bi-wallet2" style="font-size: 3rem;"></i></div>
                <h2 class="fw-bold mb-3">Donasi Umum</h2>
                <p class="text-muted mb-4">Bantuan Anda akan disalurkan ke program yang paling membutuhkan.</p>
                <form action="{{ route('donate') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="number" name="amount" class="form-control fs-4 fw-bold text-center" id="amount" placeholder="0" required>
                        <label for="amount" class="w-100 text-center">Nominal (Rp)</label>
                    </div>
                    <button class="btn btn-primary btn-pill w-100 py-3 fs-5 shadow">BAYAR SEKARANG</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection