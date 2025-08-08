<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * お知らせ詳細表示
     */
public function show($id)
{
    $article = Article::findOrFail($id);
    return view('user.article_detail', compact('article'));
}
    public function index()
{
    $articles = Article::orderBy('published_date', 'desc')->get();
    return view('user.article_list', compact('articles'));
}
}
