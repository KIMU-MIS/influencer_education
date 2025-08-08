@extends('layouts.app')

@section('title', 'プロフィール編集')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="profile-container">
    <a href="{{ route('progress') }}" class="btn-back">←戻る</a>

    <h2>プロフィール設定</h2>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- プロフィール画像とファイル選択を横並び -->
        <div class="profile-image-group">
            <img src="{{ asset('storage/images/' . $user->profile_image) }}" alt="プロフィール画像" class="profile-image">

            <div class="profile-image-input-group">
                <label for="profile_image">プロフィール画像</label>
                <input type="file" name="profile_image" id="profile_image">
                @error('profile_image')
                    <div class="error-msg">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- 名前 -->
        <div class="form-row">
            <label for="name">名前</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- カナ -->
        <div class="form-row">
            <label for="name_kana">カナ</label>
            <input type="text" name="name_kana" id="name_kana" class="form-control" value="{{ old('name_kana', $user->name_kana) }}" required>
            @error('name_kana')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-row">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード変更リンク -->
        <div class="form-row password-change-group">
            <label>パスワード</label>
            <a href="{{ route('profile.password.edit') }}" class="btn-password-change">パスワードを変更する</a>
        </div>

        <!-- 送信・戻るボタン -->
        <div class="form-actions">
            <button type="submit" class="btn-submit">更新する</button>
        </div>
    </form>
</div>
@endsection
