<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ProfileController;

// Auth Routes
Auth::routes();

// PUBLIC ROUTES
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/campaigns', [WebController::class, 'listCampaigns'])->name('pick.list');
Route::get('/campaigns/{id}', [WebController::class, 'detailCampaign'])->name('pick.detail');

// PROTECTED ROUTES (Login Required)
Route::middleware(['auth'])->group(function () {
    // Donate General
    Route::get('/donate', [WebController::class, 'donateGeneral'])->name('donate');
    Route::post('/donate', [WebController::class, 'storeGeneral']);

    // Campaign Pay
    Route::get('/campaigns/{id}/pay', [WebController::class, 'payCampaign'])->name('pick.pay');
    Route::post('/campaigns/{id}/pay', [WebController::class, 'storeCampaign']);

    // Proposal
    Route::get('/proposal', [WebController::class, 'createProposal'])->name('proposal');
    Route::post('/proposal', [WebController::class, 'storeProposal']);

    // Result
    Route::get('/result/{status}', [WebController::class, 'result'])->name('result');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/kyc', [ProfileController::class, 'uploadKyc'])->name('profile.kyc');
    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])->name('profile.photo');

    // Settings
    Route::get('/settings', [WebController::class, 'settings'])->name('settings');
});

Route::get('/about-us', [WebController::class, 'about'])->name('about');