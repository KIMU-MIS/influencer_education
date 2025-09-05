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

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label>メールアドレス</label>
            <input type="email" name="email" required>
        </div>
        
        <div>
            <label>パスワード</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">ログイン</button>
    </form>

    <p>新規会員登録は <a href="{{ route('register') }}">こちら</a></p>
</div>
@endsection
