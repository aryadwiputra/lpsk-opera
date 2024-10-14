<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegulationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/evaluasi', [LandingController::class, 'evaluation'])->name('landing.evaluation');
Route::post('/evaluasi', [LandingController::class, 'evaluationStore'])->name('landing.evaluation.store');

Route::get('/dashboard', function () {

    $users = User::all();

    return view('pages.dashboard.index', compact('users'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);

    Route::resource('peraturan', RegulationController::class);
    Route::put('peraturan/update-status/{id}', [RegulationController::class, 'updateStatus'])->name('peraturan.update-status');

    Route::get('/log', LogController::class)->name('log');
    Route::get('/log-activity', [LogActivityController::class, 'index'])->name('log-activity');
});

require __DIR__ . '/auth.php';
