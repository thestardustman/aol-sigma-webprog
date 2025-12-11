<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\WebController;

// Auth Routes
Auth::routes();

// PUBLIC ROUTES
Route::get('/', [WebController::class, 'index'])->name('home');
Route::get('/campaigns', [WebController::class, 'listCampaigns'])->name('pick.list');
Route::get('/campaigns/{id}', [WebController::class, 'detailCampaign'])->name('pick.detail');

// PROTECTED ROUTES (Login Dulu)
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

    // Result, Profile, Settings
    Route::get('/result/{status}', [WebController::class, 'result'])->name('result');
    Route::get('/profile', [WebController::class, 'profile'])->name('profile');
    Route::get('/settings', [WebController::class, 'settings'])->name('settings');
});

Route::get('/about-us', [WebController::class, 'about'])->name('about');