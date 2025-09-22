@extends('layouts.app')

@section('title', 'トップページ')

@section('content')

<!-- 共通ヘッダー -->
<nav>
    <!-- 時間割ボタン -->
    <a href="{{ auth()->check() ? route('class.list') : route('login') }}">時間割</a>

    <!-- 授業進捗ボタン -->
    <a href="{{ auth()->check() ? route('curriculum.progress') : route('login') }}">授業進捗</a>

    <!-- プロフィールボタン -->
    <a href="{{ auth()->check() ? route('profile.edit') : route('login') }}">プロフィール設定</a>

    <!-- ログイン／ログアウト -->
    @if(auth()->check())
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
    @else
        <a href="{{ route('login') }}">ログイン</a>
    @endif
</nav>

<!-- バナー表示 -->
<div class="banner-container" style="position: relative; width: 100%; overflow: hidden;">
    @if($banners->count())
        @foreach($banners as $index => $banner)
            <img src="{{ asset('storage/' . $banner->image_path) }}"
                class="banner-image"
                style="width: 100%; display: {{ $index === 0 ? 'block' : 'none' }};">
        @endforeach
    @else
        <!-- 仮画像（public/images/default-banner.pngを作成しておく） -->
        <img src="{{ asset('images/default-banner.png') }}" style="width: 100%;">
    @endif
</div>



<!-- お知らせ -->
<div class="news">
    <h2>お知らせ</h2>
    <ul>
        @foreach($articles as $article)
            <li>
                <a href="{{ route('article.show', $article->id) }}">
                    {{ $article->title }}
                </a>
                <span>{{ $article->created_at->format('Y-m-d') }}</span>
            </li>
        @endforeach
    </ul>
</div>

@endsection

