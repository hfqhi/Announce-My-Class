<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBoardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// --- PUBLIC ROUTES (No login required) ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/board/lookup', [PublicBoardController::class, 'lookup'])->name('board.lookup');
Route::get('/board/{class_code}', [PublicBoardController::class, 'show'])->name('board.show');

// ... (Your admin dashboard routes should still be below this) ...

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AnnouncementController;

// --- ADMIN DASHBOARD ROUTES (Protected by Auth) ---
Route::middleware(['auth', 'verified'])->group(function () {

    // This single line creates all 7 standard CRUD routes for Subjects!
    Route::resource('subjects', SubjectController::class);

    // This creates all 7 standard CRUD routes for Announcements!
    Route::resource('announcements', AnnouncementController::class);
});
require __DIR__ . '/auth.php';
