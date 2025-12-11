<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;

// 1. Auth Routes
Auth::routes();

// 2. Localization (Ganti Bahasa)
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('lang.switch');

// 3. PUBLIC ROUTES
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/campaigns', [WebController::class, 'listCampaigns'])->name('pick.list'); 
Route::get('/campaigns/{id}', [WebController::class, 'detailCampaign'])->name('pick.detail');

// 4. PROTECTED ROUTES (Login Dulu)
Route::middleware(['auth'])->group(function () {

    // --- ALUR 1: Donate General ---
    // Controller kamu pake 'donateGeneral', route name kita set 'donate' biar cocok sama tombol Home
    Route::get('/donate', [WebController::class, 'donateGeneral'])->name('donate');
    Route::post('/donate', [WebController::class, 'storeGeneral']);

    // --- ALUR 2: Campaign Pay ---
    Route::get('/campaigns/{id}/pay', [WebController::class, 'payCampaign'])->name('pick.pay');
    Route::post('/campaigns/{id}/pay', [WebController::class, 'storeCampaign']);

    // --- ALUR 3: Proposal ---
    // Controller kamu pake 'createProposal'
    Route::get('/proposal', [WebController::class, 'createProposal'])->name('proposal');
    Route::post('/proposal', [WebController::class, 'storeProposal']);

    // --- Result Page ---
    Route::get('/result/{status}', [WebController::class, 'result'])->name('result');

    // --- Footer/Navbar Pages ---
    Route::get('/profile', [WebController::class, 'profile'])->name('profile');
    Route::get('/settings', [WebController::class, 'settings'])->name('settings');
});

// Footer About Us
Route::get('/about-us', [WebController::class, 'about'])->name('about');