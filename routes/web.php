<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::get('/dashboard', function () {
    // Redirect admin/super_admin users to admin panel
    if (auth()->user()->hasRole(['admin', 'super_admin'])) {
        return redirect()->route('admin.dashboard');
    }
    
    $registration = \App\Models\Registration::where('user_id', auth()->id())->first();
    return view('dashboard', compact('registration'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/registration', [RegistrationController::class, 'create'])->name('registration.create');
    Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');

    Route::middleware(['role:admin|super_admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/approve/{registration}', [AdminController::class, 'approve'])->name('admin.approve');
        Route::post('/admin/reject/{registration}', [AdminController::class, 'reject'])->name('admin.reject');
        Route::delete('/admin/registrations/{registration}', [AdminController::class, 'destroy'])->name('admin.destroy');
        Route::get('/admin/registrations/{registration}/pdf', [AdminController::class, 'downloadPdf'])->name('admin.downloadPdf');
        
        // User Management Routes
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::patch('/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy')->middleware('role:super_admin');
        Route::post('/users/{user}/toggle-role', [\App\Http\Controllers\UserController::class, 'toggleRole'])->name('users.toggleRole')->middleware('role:super_admin');
    });
});

require __DIR__.'/auth.php';
