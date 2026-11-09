<?php

use App\Livewire\AssetManager;
use App\Livewire\Dashboard;
use App\Livewire\Login;
use App\Livewire\VendorManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Guest login route
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/assets', AssetManager::class)->name('assets.index');
    Route::get('/vendors', VendorManager::class)->name('vendors.index');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
