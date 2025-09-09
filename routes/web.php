<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\DetailBarang;
use App\Http\Livewire\Feedback\TableFeedback;
use App\Http\Livewire\PrintQrBarang;
use App\Http\Livewire\Profile\ProfileEdit;
use App\Http\Livewire\User\RiwayatPenjelajahan;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Route::get('/dashboard', function () {
    return view('dashboard',['role' => Role::all(),'user' => User::all()]);
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () { 
    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::get('/profile/edit', ProfileEdit::class)->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/data-diri/simpan-dan-kirim-untuk-diverifikasi', [ProfileController::class, 'SaveForConfirmation'])->name('profile.saveforconfirmation');
    
    // untuk show gambar
    Route::get('/assets/{folder}/{file}',AssetController::class)->name('assets');
    Route::view('/panduan','panduan');
    
    Route::get('print-QR/{id}',PrintQrBarang::class);

  
    Route::get('/riwayat',RiwayatPenjelajahan::class);
    Route::get('/feedback',TableFeedback::class);
   
});
Route::get('/detail/{id}/barang',DetailBarang::class);

require __DIR__.'/auth.php';
require __DIR__.'/userweb.php';
require __DIR__.'/adminweb.php';

