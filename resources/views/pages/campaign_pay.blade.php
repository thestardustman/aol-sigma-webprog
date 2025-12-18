@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <!-- CARD UTAMA -->
            <div class="card-std p-4 p-md-5">
                
                <!-- 1. Header: Menampilkan Judul Campaign -->
                <div class="text-center mb-5">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px; font-size: 2rem;">
                        💖
                    </div>
                    <h6 class="text-uppercase text-muted fw-bold small ls-1">Anda akan berdonasi untuk:</h6>
                    <h3 class="fw-bold text-dark mt-2">{{ $campaign->title }}</h3>
                </div>

                <!-- Form -->
                <form action="{{ url('/campaigns/'.$campaign->id.'/pay') }}" method="POST">
                    @csrf
                    
                    <!-- 2. Pilihan Nominal Cepat (Opsional - Agar UX lebih bagus) -->
                    <label class="form-label small fw-bold text-secondary mb-2">Pilih Nominal</label>
                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-secondary w-100 btn-sm py-2 fw-bold" onclick="setAmount(10000)">10rb</button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-secondary w-100 btn-sm py-2 fw-bold" onclick="setAmount(50000)">50rb</button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-outline-secondary w-100 btn-sm py-2 fw-bold" onclick="setAmount(100000)">100rb</button>
                        </div>
                    </div>

                    <!-- 3. Input Manual -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary">Atau Masukkan Nominal Lain</label>
                        <div class="input-group input-group-lg shadow-sm border rounded overflow-hidden">
                            <span class="input-group-text bg-white border-0 text-success fw-bold fs-4 pe-1">Rp</span>
                            <input type="number" name="amount" id="amountInput" class="form-control border-0 fw-bold fs-4 text-dark" placeholder="0" min="1000" required>
                        </div>
                        <div class="form-text text-end mt-1 small">Minimal donasi Rp 1.000</div>
                    </div>

                    <!-- 4. Payment Method Selection -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary mb-2">Pilih Metode Pembayaran</label>
                        
                        <div class="payment-method-list">
                            <div class="form-check payment-option mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="ewallet" value="ewallet" checked>
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100" for="ewallet">
                                    <span><i class="bi bi-wallet2 me-2 text-success"></i> E-Wallet (GoPay, OVO, Dana)</span>
                                    <i class="bi bi-chevron-right text-muted"></i>
                                </label>
                            </div>
                            
                            <div class="form-check payment-option mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="bank" value="bank">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100" for="bank">
                                    <span><i class="bi bi-bank me-2 text-primary"></i> Transfer Bank</span>
                                    <i class="bi bi-chevron-right text-muted"></i>
                                </label>
                            </div>
                            
                            <div class="form-check payment-option mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100" for="card">
                                    <span><i class="bi bi-credit-card me-2 text-danger"></i> Kartu Kredit/Debit</span>
                                    <i class="bi bi-chevron-right text-muted"></i>
                                </label>
                            </div>
                            
                            <div class="form-check payment-option">
                                <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris">
                                <label class="form-check-label d-flex align-items-center justify-content-between w-100" for="qris">
                                    <span><i class="bi bi-qr-code me-2 text-dark"></i> QRIS</span>
                                    <i class="bi bi-chevron-right text-muted"></i>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- 5. Tombol Bayar -->
                    <button type="submit" class="btn btn-success btn-pill w-100 py-3 fs-5 shadow hover-scale">
                        Lanjutkan Pembayaran <i class="bi bi-arrow-right ms-2"></i>
                    </button>

                    <div class="text-center mt-4">
                        <a href="{{ route('pick.detail', $campaign->id) }}" class="text-decoration-none text-muted small fw-bold">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Script Sederhana untuk Tombol Nominal Cepat -->
<script>
    function setAmount(value) {
        document.getElementById('amountInput').value = value;
    }
</script>

<style>
    .payment-option {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        padding: 12px 15px;
        transition: all 0.2s;
        cursor: pointer;
    }
    .payment-option:hover {
        border-color: #198754;
        background: #f0fff4;
    }
    .payment-option:has(input:checked) {
        border-color: #198754;
        background: #d1e7dd;
    }
    .payment-option .form-check-input {
        margin-top: 0.3em;
    }
    .payment-option label {
        cursor: pointer;
        padding-left: 8px;
    }
</style>
@endsection