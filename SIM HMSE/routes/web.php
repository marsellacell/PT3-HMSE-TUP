<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProposalController;

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
        Route::get('/test-download', function() {
            return response()->json(['message' => 'test ok', 'time' => now()]);
        })->name('.test');
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

/*
|--------------------------------------------------------------------------
| Proposal Generator Routes
|--------------------------------------------------------------------------
*/
// Public template download (no auth required)
Route::get('/proposals/template/{riskLevel}', [ProposalController::class, 'downloadTemplate'])->name('proposals.download-template');

// Protected proposal routes
Route::middleware(['auth'])->prefix('proposals')->name('proposals')->group(function () {
    Route::get('/', [ProposalController::class, 'index'])->name('.index');
    Route::get('/create', [ProposalController::class, 'create'])->name('.create');
    Route::post('/', [ProposalController::class, 'store'])->name('.store');
    Route::get('/{proposal}', [ProposalController::class, 'show'])->name('.show');
    Route::get('/{proposal}/edit', [ProposalController::class, 'edit'])->name('.edit');
    Route::put('/{proposal}', [ProposalController::class, 'update'])->name('.update');
    Route::post('/{proposal}/submit', [ProposalController::class, 'submit'])->name('.submit');
    Route::post('/{proposal}/generate-pdf', [ProposalController::class, 'generatePdf'])->name('.generate-pdf');
    Route::get('/{proposal}/download-pdf', [ProposalController::class, 'downloadPdf'])->name('.download-pdf');
    Route::get('/{proposal}/generate-filled', [ProposalController::class, 'generateFilledDocument'])->name('.generate-filled');
    Route::get('/{proposal}/preview-filled', [ProposalController::class, 'previewFilledDocument'])->name('.preview-filled');
    Route::post('/approval/{approval}/approve', [ProposalController::class, 'approve'])->name('.approve');
    Route::post('/approval/{approval}/reject', [ProposalController::class, 'reject'])->name('.reject');
    Route::delete('/{proposal}', [ProposalController::class, 'destroy'])->name('.destroy');
});


Route::post('/proposal/preview', [ProposalController::class, 'preview'])
    ->name('dashboard.proposal.preview.post');

Route::post('/proposal/download-docx', [ProposalController::class, 'downloadPreviewDocx'])
    ->name('dashboard.proposal.download-docx');