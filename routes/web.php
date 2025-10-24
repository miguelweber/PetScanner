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

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/pets', [App\Http\Controllers\AdminController::class, 'pets'])->name('admin.pets');
    Route::patch('/pets/{pet}/toggle', [App\Http\Controllers\AdminController::class, 'togglePet'])->name('admin.pets.toggle');
    Route::delete('/pets/{pet}', [App\Http\Controllers\AdminController::class, 'deletePet'])->name('admin.pets.delete');
});

// Chat Routes
Route::prefix('chat')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::get('/{pet}/{user}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    Route::post('/{pet}', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
});

// Storage route for images
Route::get('/storage/{path}', function ($path) {
    $file = storage_path('app/public/' . $path);
    if (file_exists($file)) {
        return response()->file($file);
    }
    abort(404);
})->where('path', '.*');