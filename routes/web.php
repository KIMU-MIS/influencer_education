<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\User\ArticleController as UserArticleController;

// ----------------------
// 管理者向けルート群
// ----------------------
Route::prefix('admin')->name('admin.')->group(function () {
    // お知らせ一覧
    Route::get('/article/list', [ArticleController::class, 'index'])->name('article.index');

    // お知らせ新規作成フォーム表示
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');

    // お知らせ保存処理（登録）
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');

    // お知らせ編集フォーム表示
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');

    // お知らせ更新処理
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->name('article.update');

    // お知らせ削除処理
    Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
});

// ----------------------
// ユーザー向けルート群
// ----------------------

// 時間割（user.curriculum.list に統一）
Route::get('/schedule', [CurriculumController::class, 'index'])->name('user.curriculum.list');

// 授業進捗画面
Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

// プロフィール画面表示
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// プロフィール更新処理
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

// パスワード変更画面表示
Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');

// パスワード変更処理
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// お知らせ一覧（ユーザー）
Route::get('/articles', [UserArticleController::class, 'index'])->name('user.articles.index');

// お知らせ詳細（ユーザー）
Route::get('/articles/{id}', [UserArticleController::class, 'show'])->name('user.articles.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');