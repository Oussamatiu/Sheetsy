<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'ban'])->group(function () {
    
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard');

    
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    
    Route::resources([
        'expenses' => \App\Http\Controllers\ExpenseController::class,
        'colocations' => \App\Http\Controllers\ColocationController::class,
        'categories' => \App\Http\Controllers\CategoryController::class,
        'payments' => \App\Http\Controllers\PaymentController::class,
      
    ]);

    
    Route::delete('/colocations/{colocation}/leave', [\App\Http\Controllers\ColocationController::class, 'leave'])
        ->name('colocations.leave');


    Route::resource('invitations', \App\Http\Controllers\InvitationController::class)
        ->only(['store', 'destroy']);
    Route::post('/invitations/send/{colocationId}', [\App\Http\Controllers\InvitationController::class, 'sendInvitation'])
        ->name('invitations.send');

    
    Route::patch('/colocations/{colocation}/payments/{payment}/mark-paid', [PaymentController::class, 'markPaid'])
        ->name('payments.mark-paid');
});
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin', \App\Http\Controllers\AdminController::class); 

    Route::patch('/users/{id}/toggle-ban', [\App\Http\Controllers\AdminController::class, 'toggleBan'])
        ->name('admin.toggle-ban');
});

Route::get('/invitations/accept/{token}', [\App\Http\Controllers\InvitationController::class, 'accept'])
    ->name('invitations.accept');
require __DIR__.'/auth.php';
