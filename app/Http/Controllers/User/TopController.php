<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Banner;

class TopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $articles = Article::latest()->take(5)->get();
        $banners = Banner::latest()->take(5)->get();

        // ビューの場所を user/top.blade.php に変更
        return view('user.top', compact('articles', 'banners'));
    }
}
