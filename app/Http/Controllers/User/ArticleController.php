<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published_date', 'desc')->get();
        return view('user.article_list', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('user.article_detail', compact('article'));
    }
}
