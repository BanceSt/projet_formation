<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomePageController::class, 'show'])->name('home');
Route::get("/test", function () {
    return view('show_layout');
});

Route::prefix("Story")->name("story")->group(function () {
    Route::get("/create/{id?}", [StoryController::class, "create"])->name('.create');
    Route::post("/store", [StoryController::class, "store"])->name('.store');
    Route::get("/{id}", [StoryController::class, "show"])->name('.show');
});

Route::prefix("profil")->name("profil")->group(function () {
    Route::get("/{name}", [UserController::class, "show"])->name(".show");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
