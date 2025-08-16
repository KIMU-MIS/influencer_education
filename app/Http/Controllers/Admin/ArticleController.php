<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Article\StoreArticleRequest;
use App\Http\Requests\Admin\Article\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * 一覧表示
     */
    public function index()
    {
        $articles = Article::orderBy('published_date', 'desc')->get();

        return view('admin.article_list', compact('articles'));
    }

    /**
     * 新規作成画面表示
     */
    public function create()
    {
        return view('admin.article_create');
    }

    /**
     * 新規登録処理
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data) {
                // モデルに用意済みのメソッドを使用
                Article::createArticle($data);
            });

            return redirect()
                ->route('admin.article.index')
                ->with('success', 'お知らせを登録しました');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withErrors(['error' => '登録に失敗しました'])
                ->withInput();
        }
    }

    /**
     * 編集画面表示
     */
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        return view('admin.article_edit', compact('article'));
    }

    /**
     * 更新処理
     */
    public function update(UpdateArticleRequest $request, $id)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($data, $id) {
                $article = Article::findOrFail($id);
                // モデルに用意済みのメソッドを使用
                $article->updateArticle($data);
            });

            return redirect()
                ->route('admin.article.index')
                ->with('success', 'お知らせを更新しました');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withErrors(['error' => '更新に失敗しました'])
                ->withInput();
        }
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $article = Article::findOrFail($id);
                // モデルに用意済みのメソッドを使用
                $article->deleteArticle();
            });

            return redirect()
                ->route('admin.article.index')
                ->with('success', 'お知らせを削除しました');
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withErrors(['error' => '削除に失敗しました']);
        }
    }
}
