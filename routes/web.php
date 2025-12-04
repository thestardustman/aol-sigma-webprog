<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Tambahkan ini agar aman
use App\Http\Controllers\WebController;

// ====================================================
// 1. AUTHENTICATION ROUTES (WAJIB ADA)
// ====================================================
// Baris ini yang membuat route bernama 'login', 'register', 'logout'
Auth::routes();

// ====================================================
// 2. PUBLIC ROUTES (BISA DIAKSES GUEST/SIAPA SAJA)
// ====================================================

// Home Page
Route::get('/', [WebController::class, 'index'])->name('home');

// Halaman List Komunitas
Route::get('/campaigns', [WebController::class, 'listCampaigns'])->name('campaigns.index');

// Halaman Detail Komunitas
Route::get('/campaigns/{id}', [WebController::class, 'detailCampaign'])->name('campaigns.show');

// Halaman About Us (Footer)
Route::get('/about-us', [WebController::class, 'about'])->name('about');


// ====================================================
// 3. PROTECTED ROUTES (HARUS LOGIN DULU)
// ====================================================
Route::middleware(['auth'])->group(function () {

    // --- ALUR 1: DONATE GENERAL ---
    Route::get('/donate', [WebController::class, 'donateGeneral'])->name('donate.general');
    Route::post('/donate', [WebController::class, 'storeGeneral']);

    // --- ALUR 2: CAMPAIGN PAY ---
    Route::get('/campaigns/{id}/pay', [WebController::class, 'payCampaign'])->name('campaigns.pay');
    Route::post('/campaigns/{id}/pay', [WebController::class, 'storeCampaign']);

    // --- ALUR 3: MAKE DONATION (PROPOSAL) ---
    Route::get('/proposal', [WebController::class, 'createProposal'])->name('proposal.create');
    Route::post('/proposal', [WebController::class, 'storeProposal']);

    // --- USER SPECIFIC ---
    Route::get('/profile', [WebController::class, 'profile'])->name('profile');
    Route::get('/settings', [WebController::class, 'settings'])->name('settings');

    // --- RESULT PAGE ---
    Route::get('/result/{status}', [WebController::class, 'result'])->name('result');
});