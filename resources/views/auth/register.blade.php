@extends('layouts.app')

@section('title', '新規会員登録')

@section('header-left')
    <a href="{{ route('home') }}"><button class="nav-button">トップ</button></a>
@endsection

@section('header-right')
    <!-- ログアウトボタンは不要 -->
@endsection

@section('content')
<div class="container">
    <h2>新規会員登録</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- ユーザーネーム -->
        <div class="form-group">
            <label for="name">ユーザーネーム</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" >
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- カナ -->
        <div class="form-group">
            <label for="name_kana">カナ</label>
            <input id="name_kana" type="text" name="name_kana" value="{{ old('name_kana') }}" >
            @error('name_kana')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" >
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" >
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード確認 -->
        <div class="form-group">
            <label for="password_confirmation">パスワード確認</label>
            <input id="password_confirmation" type="password" name="password_confirmation" >
        </div>

        <button type="submit" class="btn btn-primary mt-2">登録</button>
    </form>

    <p class="mt-3"><a href="{{ route('login') }}">ログイン</a>はこちら</p>
</div>
@endsection
