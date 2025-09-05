<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\TopController;
use App\Http\Controllers\User\DeliveryController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ProfileController; 

// トップページ
Route::get('/', [TopController::class, 'index'])->name('top');

// お知らせ詳細ページ
Route::get('/article/{id}', [TopController::class, 'showArticle'])->name('article.show');

// 授業関連
Route::get('/list_of_classes', [ClassController::class, 'index'])->name('class.list');
Route::get('/class/fetch', [ClassController::class, 'fetch'])->name('class.fetch');
Route::get('/class_setting', [ClassController::class, 'settingForm'])->name('class.setting');
Route::get('/class_setting/{id}', [ClassController::class, 'edit'])->name('curriculum.edit');
Route::post('/curriculum/store', [ClassController::class, 'store'])->name('curriculum.store');
Route::put('/class_setting/{id}', [ClassController::class, 'update'])->name('curriculum.update');
Route::get('/delivery_times_setting/{id}', [ClassController::class, 'deliveryTimeForm'])->name('delivery.setting');
Route::post('/delivery/store/{id}', [ClassController::class, 'storeDelivery'])->name('delivery.store');

// ゲスト専用ページ
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// 認証後の画面
Route::middleware('auth')->group(function () {
    Route::get('/home', [TopController::class, 'index'])->name('home');
    
    Route::get('/delivery', [DeliveryController::class, 'index'])->name('user.delivery');
    Route::get('/delivery/{id}', [DeliveryController::class, 'show'])->name('user.delivery.show');
    Route::post('/delivery/complete/{id}', [DeliveryController::class, 'complete'])->name('user.lesson.complete');

    Route::get('/curriculum/progress', [CurriculumController::class, 'progress'])->name('curriculum.progress');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
});
