@extends('layouts.app')

@section('title', '新規会員登録')

@section('header-left')
    <a href="{{ route('home') }}"><button class="nav-button">トップ</button></a>
@endsection

@section('header-right')
    <!-- ログアウトボタンは新規登録画面では不要 -->
@endsection

@section('content')
<div class="container">
    <h2>新規会員登録</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label>ユーザーネーム</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>カナ</label>
            <input type="text" name="name_kana" value="{{ old('name_kana') }}" required>
            @error('name_kana')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
        <label>メールアドレス</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        </div>

        <div>
        <label>パスワード</label>
        <input type="password" name="password" required>
        @error('password')
            <div style="color:red;">{{ $message }}</div>
        @enderror
        </div>

        <div>
        <label>パスワード確認</label>
        <input type="password" name="password_confirmation" required>
        </div>


        <button type="submit">登録</button>
    </form>

    <p> <a href="{{ route('login') }}">ログイン</a>はこちら</p>
</div>
@endsection
