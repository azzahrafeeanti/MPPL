<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [FrontController::class, 'index'])->name('landing.index');
Route::get('/cariEvent', [FrontController::class, 'cariEvent'])->name('landing.cariEvent');
Route::get('/cariEvent/{slug}', [OrderController::class, 'eventDetail'])->name('order.eventDetail');
Route::get('/csr', [FrontController::class, 'csr'])->name('landing.csr');
Route::get('/aboutUs', [FrontController::class, 'aboutUs'])->name('landing.aboutUs');
Route::get('/panduan', [FrontController::class, 'panduan'])->name('landing.panduan');
Route::get('/order/{slug}/detail-pemesanan/{transaction_id}', [OrderController::class, 'detailPemesanan'])->name('order.detailPemesanan');
Route::post('/order/{slug}/detail-pemesanan', [OrderController::class, 'handleDetailPemesanan'])->name('order.handleDetailPemesanan');
Route::post('/order/{slug}/update-personal-details/{transaction_id}', [OrderController::class, 'updatePersonalDetails'])->name('order.updatePersonalDetails');
Route::get('/order/{slug}/success-confirmation/{transaction_id}', [OrderController::class, 'successPage'])->name('order.successPage');
Route::post('/order/{slug}/apply-promo/{transaction_id}', [OrderController::class, 'applyPromo'])->name('order.applyPromo');

Route::middleware(['guest'])->group(function () { // user yang belum login yang bisa mengakses route ini
    Route::get('/signUp', [AuthController::class, 'signUp'])->name('landing.signUp');
    Route::post('/signUp', [AuthController::class, 'handleSignUp'])->name('landing.handleSignUp');
    Route::get('/signIn', [AuthController::class, 'signIn'])->name('landing.signIn');
    Route::post('/signIn', [AuthController::class, 'handleSignIn'])->name('landing.handleSignIn');
});

Route::middleware(['auth'])->group(function () { // hanya user yang sudah login yang bisa mengakses route ini
    Route::get('/signOut', function () {
        Auth::logout();
        return redirect('/');
    })->name('sign.out');


    //Route::get('/order/detail-pemesanan/{id}', [OrderController::class, 'detailPemesanan'])->name('order.detailPemesanan');
    Route::get('/editProfil', [FrontController::class, 'editProfil'])->name('landing.editProfil');
    Route::put('/user/profile', [AuthController::class, 'updateProfile'])->name('user.updateProfile');
    Route::get('/tiketSaya', [OrderController::class, 'tiketSaya'])->name('order.tiketSaya');
    // Route::get('/success', [SessionController::class, 'success'])->name('session.success');
    // Route::get('/cancel', [SessionController::class, 'cancel'])->name('session.cancel');
    // Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
});
