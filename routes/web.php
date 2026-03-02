<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('expenses', \App\Http\Controllers\ExpenseController::class)->middleware('auth');
Route::resource('colocations', \App\Http\Controllers\ColocationController::class)->middleware('auth');
Route::delete('/colocations/{colocation}/leave', [\App\Http\Controllers\ColocationController::class, 'leave'])->name('colocations.leave')->middleware('auth');
Route::resource('categories', \App\Http\Controllers\CategoryController::class)->middleware('auth');
Route::resource('invitations', \App\Http\Controllers\InvitationController::class)->middleware('auth')->only(['store', 'destroy']);
Route::post('/invitations/send/{colocationId}', [\App\Http\Controllers\InvitationController::class, 'sendInvitation'])->name('invitations.send')->middleware('auth');
Route::get('/invitations/accept/{token}', [\App\Http\Controllers\InvitationController::class, 'accept'])->name('invitations.accept');
Route::patch('/colocations/{colocation}/payments/{payment}/mark-paid', 
    [PaymentController::class, 'markPaid'])
    ->name('payments.mark-paid')
    ->middleware('auth');
require __DIR__.'/auth.php';
