@extends('layouts.app')

@section('content')
 <div class="back-link-wrapper6">
        <a href="{{ route('user.articles.index') }}" class="back-link6">← 戻る</a>
    </div>
    <div class="user-article-detail-container6">


        <p class="article-date6">{{ $article->published_date->format('Y年n月j日') }}</p>


        <h2 class="article-title6">{{ $article->title }}</h2>

        <p class="article-body6">{{ $article->content }}</p>

    </div>
@endsection
