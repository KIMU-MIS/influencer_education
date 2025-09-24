<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Banner;

class TopController extends Controller
{
    // ログイン済みユーザーのみアクセス
    public function __construct()
    {
        $this->middleware('auth');
    }

    // トップページ
    public function index()
    {
        // お知らせを取得（最新5件）
        $articles = Article::latest()->take(5)->get();

        // バナーを取得（最新1件）
        $banner = Banner::latest()->first();


        return view('top', compact('articles', 'banner'));
    }

    // お知らせ詳細画面
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
}
