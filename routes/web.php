<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PetController::class, 'index'])->name('home');
Route::resource('pets', PetController::class);
Route::get('/meus-pets', [PetController::class, 'myPets'])->name('pets.my-pets')->middleware('auth');
Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');
Route::get('/perfil/editar', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::put('/perfil/senha', [ProfileController::class, 'updatePassword'])->name('profile.password')->middleware('auth');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Storage route for images
Route::get('/storage/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (file_exists($file)) {
        return response()->file($file);
    }
    abort(404);
})->where('path', '.*');

// Termos de uso
Route::get('/termos-de-uso', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/politica-de-privacidade', function () {
    return view('legal.privacy');
})->name('privacy');
