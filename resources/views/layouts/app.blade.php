<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '授業進捗')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="navbar">
    <nav class="nav-links d-flex w-100 align-items-center justify-content-between">
        <div class="d-flex">
            <a href="{{ route('user.curriculum.list') }}" class="btn btn-info text-white me-2">時間割</a>
            <a href="{{ route('progress') }}" class="btn btn-primary me-2">授業進捗</a>
            <a href="{{ route('profile') }}" class="btn btn-success">プロフィール設定</a>
        </div>

        {{-- 課題ではログイン未実装：ルート存在時のみ表示 --}}
        @if (Route::has('logout'))
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link">ログアウト</button>
        </form>
        @endif
    </nav>
</header>

<main class="container">
    @yield('content')
</main>
</body>
</html>
