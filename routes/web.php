<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\services\SmsService;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category.show');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/sendOtp', [LoginController::class, 'sendOtp'])->name('sendOtp');
Route::get('/otp', [LoginController::class, 'otp'])->name('otp');
Route::post('/verifyOtp', [LoginController::class, 'verifyOtp'])->name('verifyOtp');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('auth:poster');
Route::post('/update-phone', [DashboardController::class, 'updatePhone'])->name('update-phone')->middleware('auth:poster');

Route::post('/create-ad', [AdController::class, 'create'])->name('create-ad')->middleware('auth:poster');
Route::delete('/delete-ad/{id}', [AdController::class, 'delete'])->name('delete-ad')->middleware('auth:poster');
Route::post('/restore-ad/{id}', [AdController::class, 'restore'])->name('restore-ad')->middleware('auth:poster');
Route::get('/ad/{id}', [AdController::class, 'show'])->name('ad.show');
Route::post('/ad/{id}/toggle-like', [AdController::class, 'toggleLike'])->name('ad.toggle-like');
Route::post('/report', [ReportController::class, 'store'])->name('report.store');
Route::get('/saved-ads', [HomeController::class, 'savedAds'])->name('saved-ads');
Route::post('/api/saved-ads-data', [HomeController::class, 'getSavedAdsData'])->name('api.saved-ads-data');
Route::get('/search', [HomeController::class, 'search'])->name('search.ads');

// Static Pages
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about-us');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return-policy');
Route::get('/how-to-publish', [HomeController::class, 'howToPublish'])->name('how-to-publish');


Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [PaymentController::class, 'processPayment'])->name('checkout.process');
Route::get('/checkout/success', [PaymentController::class, 'success'])->name('checkout.success');
Route::get('/checkout/cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel');