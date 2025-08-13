<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\User\ProgressController;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\User\ArticleController as UserArticleController;

// ----------------------
// 管理者向け
// ----------------------
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/article/list',   [ArticleController::class, 'index'])->name('article.index');
    Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/article/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('/article/edit/{id}', [ArticleController::class, 'edit'])->whereNumber('id')->name('article.edit');
    Route::put('/article/update/{id}', [ArticleController::class, 'update'])->whereNumber('id')->name('article.update');
    Route::delete('/article/delete/{id}', [ArticleController::class, 'destroy'])->whereNumber('id')->name('article.destroy');
});

// ----------------------
// ユーザー向け
// ----------------------
Route::get('/schedule', [CurriculumController::class, 'index'])->name('user.curriculum.list');
Route::get('/progress', [ProgressController::class, 'index'])->name('progress');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// ユーザーお知らせ
Route::get('/articles', [UserArticleController::class, 'index'])->name('user.articles.index');
Route::get('/articles/{id}', [UserArticleController::class, 'show'])
    ->whereNumber('id')
    ->name('user.articles.show');

// --- 仮ログアウト（Auth未実装のためのダミー） ---
Route::post('/logout', function (Request $request) {
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('progress');
})->name('logout');
