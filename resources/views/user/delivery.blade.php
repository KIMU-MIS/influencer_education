@extends('layouts.app')

@section('title', '配信ページ')

@section('header-left')
    <a href="{{ route('top') }}"><button class="nav-button">戻る</button></a>
    <a href="{{ auth()->check() ? route('class.list') : route('login') }}"><button class="nav-button">時間割</button></a>
    <a href="{{ auth()->check() ? route('curriculum.progress') : route('login') }}"><button class="nav-button">授業進捗</button></a>
    <a href="{{ auth()->check() ? route('profile.edit') : route('login') }}"><button class="nav-button">プロフィール</button></a>
@endsection

@section('header-right')
    @if(auth()->check())
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
    @else
        <a href="{{ route('login') }}"><button class="logout-button">ログイン</button></a>
    @endif
@endsection

@section('content')
<div class="container">

    @if($lesson)
        <h2>{{ $lesson->curriculum->title ?? '授業タイトル' }}</h2>
        <p>学年: {{ $lesson->curriculum->grade ?? '-' }}</p>
        <p>{{ $lesson->curriculum->overview ?? '授業概要' }}</p>

        @if($lesson->delivery_from <= now() && $lesson->delivery_to >= now())
            <video controls width="100%">
                <source src="{{ $lesson->curriculum->video_url ?? '' }}" type="video/mp4">
                お使いのブラウザは動画再生に対応していません。
            </video>
        @else
            <img src="{{ asset('images/coming_soon.png') }}" alt="配信期間外" style="width:100%;">
        @endif

        <form method="POST" action="{{ route('user.lesson.complete', $lesson->id) }}">
            @csrf
            @if($lesson->status === 'completed')
                <span class="text-green-600 font-bold">受講済み</span>
            @else
                <button type="submit" 
                        @if($lesson->delivery_from > now() || $lesson->delivery_to < now()) disabled @endif>
                    受講しました
                </button>
            @endif
        </form>

    @else
        <p>現在配信中の授業はありません</p>
    @endif

    <hr>
    <h3>授業一覧</h3>
    <ul>
        @foreach($curriculums as $curriculum)
            <li>
                <a href="{{ route('user.delivery.show', $curriculum->id) }}">
                    {{ $curriculum->curriculum->title ?? '授業名' }}
                </a>
                
                {{-- 受講済み判定 --}}
                @if($curriculum->status === 'completed')
                    <span class="text-green-600 font-bold ml-2">受講済み</span>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
