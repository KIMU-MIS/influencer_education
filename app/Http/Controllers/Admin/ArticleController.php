<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

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
    public function store(Request $request)
    {
        $request->validate([
            'published_date' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            Article::createArticle($request->only('published_date', 'title', 'content'));
            DB::commit();
            return redirect()->route('admin.article.index')->with('success', 'お知らせを登録しました');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '登録に失敗しました']);
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'published_date' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $article = Article::findOrFail($id);
            $article->updateArticle($request->only('published_date', 'title', 'content'));
            DB::commit();
            return redirect()->route('admin.article.index')->with('success', 'お知らせを更新しました');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '更新に失敗しました']);
        }
    }

    /**
     * 削除処理
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $article = Article::findOrFail($id);
            $article->deleteArticle();
            DB::commit();
            return redirect()->route('admin.article.index')->with('success', 'お知らせを削除しました');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => '削除に失敗しました']);
        }
    }
}
