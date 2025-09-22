@extends('layouts.app')

@section('title', 'ログイン')

@section('header-left')
    <a href="{{ route('home') }}"><button class="nav-button">トップ</button></a>
@endsection

@section('header-right')
    <!-- ログアウトボタンはログイン画面では不要 -->
@endsection

@section('content')
<div class="container">
    <h2>ログイン</h2>

    <!-- 認証エラー -->
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- メールアドレス -->
        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" >
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div class="form-group">
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" >
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">ログイン</button>
    </form>

    <p class="mt-3">新規会員登録は <a href="{{ route('register') }}">こちら</a></p>
</div>
@endsection
