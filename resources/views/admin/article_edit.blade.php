@extends('admin.layouts.app')

@section('content')
    <div class="back-link-area">
        <a href="{{ route('admin.article.index') }}" class="btn-gray4">← 戻る</a>
    </div>

    <div class="container4">
        <h1 class="page-title4">お知らせ変更</h1>

        {{-- 更新処理用のフォーム --}}
        <form action="{{ route('admin.article.update', $article->id) }}" method="POST" class="edit-form4">
            @csrf
            @method('PUT')

            <div class="form-group4">
                <label for="published_date">投稿日時</label>
                <input type="date" id="published_date" name="published_date" value="{{ $article->published_date->format('Y-m-d') }}">
            </div>

            <div class="form-group4">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="{{ $article->title }}">
            </div>

            <div class="form-group4">
                <label for="content">内容</label>
                <textarea id="content" name="content" rows="5">{{ $article->content }}</textarea>
            </div>

            <div class="form-buttons4">
                <button type="submit" class="btn-green4">変更</button>
            </div>
        </form>
    </div>
@endsection
