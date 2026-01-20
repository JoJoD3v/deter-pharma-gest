<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DDTController;
use App\Http\Controllers\LavoroController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Gestione Utenti
    Route::resource('users', UserController::class);

    // Gestione Clienti
    Route::get('/clienti/search', [ClienteController::class, 'search'])->name('clienti.search');
    Route::resource('clienti', ClienteController::class)->parameters(['clienti' => 'cliente']);

    // Gestione DDT
    Route::resource('ddts', DDTController::class);
    Route::get('/ddts/{ddt}/pdf-amministratore', [DDTController::class, 'pdfAmministratore'])->name('ddts.pdf.amministratore');
    Route::get('/ddts/{ddt}/pdf-vettore', [DDTController::class, 'pdfVettore'])->name('ddts.pdf.vettore');

    // Gestione Lavori
    Route::resource('lavori', LavoroController::class)->parameters(['lavori' => 'lavoro']);
    Route::get('/lavori/{lavoro}/pdf-ricevuta', [LavoroController::class, 'pdfRicevuta'])->name('lavori.pdf.ricevuta');
});
