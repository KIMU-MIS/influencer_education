<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// 授業一覧
Route::get('/list_of_classes', [ClassController::class, 'index'])->name('class.list');
// 授業設定フォームAjax 用
Route::get('/class/fetch', [ClassController::class, 'fetch'])->name('class.fetch');
// 授業設定フォーム
Route::get('/class_setting', [ClassController::class, 'settingForm'])->name('class.setting');
// 授業設定フォーム（プルダウン用）
Route::get('/class_setting', [ClassController::class, 'classSettingForm'])->name('curriculum.setting');
// 授業登録処理
Route::post('/curriculum/store', [ClassController::class, 'store'])->name('curriculum.store');
// 授業編集フォーム
Route::get('/class_setting/{id}', [ClassController::class, 'edit'])->name('curriculum.edit');
// 授業更新処理
Route::put('/class_setting/{id}', [ClassController::class, 'update'])->name('curriculum.update');
// 配信時間設定フォーム
Route::get('/delivery_times_setting/{id}', [ClassController::class, 'deliveryTimeForm'])->name('delivery.setting');
// 配信時間登録処理
Route::post('/delivery/store/{id}', [ClassController::class, 'storeDelivery'])->name('delivery.store');
// 配信時間更新処理
Route::get('/delivery_times_setting/{id}', [ClassController::class, 'deliveryTimeForm'])->name('delivery.edit');