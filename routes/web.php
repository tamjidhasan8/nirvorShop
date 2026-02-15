<?php

use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\VendorDashboardController;
use App\Http\Controllers\Frontend\KycController;

Route::get('/', function () {
    return view('frontend.home.index');
});

// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.main.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // profile Routes
    Route::get('/profile', [ProfileController::class, 'index' ])->name('profile');
    Route::put('/profile', [ProfileController::class, 'profileUpdate' ])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'passwordUpdate' ])->name('password.update');

    /**KYC Routes */
    Route::get('/kyc-verification',[KycController::class, 'index'])->name('kyc.index');
});

/** Vendor Routs */
Route::group(['prefix'=> 'vendor', 'as' => 'vendor.', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [VendorDashboardController::class, 'index'])->name('dashboard');


});




require __DIR__ . '/auth.php';
