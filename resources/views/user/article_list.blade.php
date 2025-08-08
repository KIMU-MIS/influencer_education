@extends('layouts.app')

@section('content')
    <div class="user-article-list-container">
        <h1 class="page-title">お知らせ一覧</h1>

        @foreach($articles as $article)
            <div class="article-item">
                {{-- 投稿日 --}}
                <p class="article-date">{{ $article->published_date->format('Y年n月j日') }}</p>

                {{-- タイトル（クリックで詳細へ） --}}
                <h2 class="article-title">
                    <a href="{{ route('user.articles.show', $article->id) }}">
                        {{ $article->title }}
                    </a>
                </h2>
            </div>
        @endforeach
    </div>
@endsection
