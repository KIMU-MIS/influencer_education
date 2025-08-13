@extends('admin.layouts.app')

@section('content')
    <div class="back-link-area5">
        <a href="{{ route('admin.article.index') }}" class="back-link5">← 戻る</a>
    </div>

    <div class="admin-container5">
        <h1 class="admin-title5">お知らせ新規登録</h1>

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:16px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.article.store') }}" method="POST" class="edit-form4">
            @csrf

            <div class="form-group4">
                <label for="published_date">投稿日時</label>
                <input type="date" id="published_date" name="published_date"
                       value="{{ old('published_date', now()->toDateString()) }}">
            </div>

            <div class="form-group4">
                <label for="title">タイトル</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group4">
                <label for="content">内容</label>
                <textarea id="content" name="content" rows="5">{{ old('content') }}</textarea>
            </div>

            <div class="form-buttons4">
                <button type="submit" class="btn-green4">登録</button>
            </div>
        </form>
    </div>
@endsection
