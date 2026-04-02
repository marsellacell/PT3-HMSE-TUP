<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Public Routes — Halaman Publik (Landing Page)
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/news', [PageController::class, 'newsIndex'])->name('news.index');
Route::get('/news/{slug}', [PageController::class, 'newsShow'])->name('news.show');

/*
|--------------------------------------------------------------------------
| Auth Redirect — akan diisi nanti saat modul auth selesai
|--------------------------------------------------------------------------
*/

Route::get('/login', [DashboardController::class, 'loginForm'])->name('login');
Route::post('/login', [DashboardController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Dashboard Routes — Halaman Manajemen Internal
|--------------------------------------------------------------------------
| Sementara tanpa auth middleware agar bisa diakses langsung.
| Nanti tinggal wrap dengan: Route::middleware('auth')->group(...)
|--------------------------------------------------------------------------
*/

Route::prefix('dashboard')->name('dashboard')->group(function () {

    // Dashboard Overview
    Route::get('/', [DashboardController::class, 'index']);

    // Program Kerja
    Route::prefix('/proker')->name('.proker')->group(function () {
        Route::get('/', [DashboardController::class, 'prokerIndex'])->name('.index');
        Route::get('/create', [DashboardController::class, 'prokerCreate'])->name('.create');
        Route::get('/{id}', [DashboardController::class, 'prokerShow'])->name('.show');
    });

    // Kalender
    Route::get('/calendar', [DashboardController::class, 'calendar'])->name('.calendar');

    // Proposal
    Route::prefix('/proposal')->name('.proposal')->group(function () {
        Route::get('/', [DashboardController::class, 'proposalIndex'])->name('.index');
        Route::get('/create', [DashboardController::class, 'proposalCreate'])->name('.create');
        Route::get('/preview/{id}', [DashboardController::class, 'proposalPreview'])->name('.preview');
        Route::get('/{id}', [DashboardController::class, 'proposalShow'])->name('.show');
    });

    // Keuangan
    Route::prefix('/finance')->name('.finance')->group(function () {
        Route::get('/', [DashboardController::class, 'financeIndex'])->name('.index');
        Route::get('/internal', [DashboardController::class, 'financeInternal'])->name('.internal');
        Route::get('/proker', [DashboardController::class, 'financeProker'])->name('.proker');
    });

    // SOTK / Keanggotaan
    Route::prefix('/sotk')->name('.sotk')->group(function () {
        Route::get('/', [DashboardController::class, 'sotkIndex'])->name('.index');
        Route::get('/create', [DashboardController::class, 'sotkCreate'])->name('.create');
    });

    // Events
    Route::prefix('/events')->name('.events')->group(function () {
        Route::get('/', [DashboardController::class, 'eventsIndex'])->name('.index');
    });

    // Dokumentasi
    Route::prefix('/documents')->name('.documents')->group(function () {
        Route::get('/', [DashboardController::class, 'documentsIndex'])->name('.index');
    });

    // Pengaturan
    Route::get('/settings', [DashboardController::class, 'settings'])->name('.settings');

});
