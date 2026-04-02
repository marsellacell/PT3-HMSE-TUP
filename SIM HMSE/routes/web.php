<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::get('/login', function () {
    return redirect('/admin');
})->name('login');
