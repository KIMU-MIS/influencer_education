<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理画面</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="admin-header5">
        <nav class="admin-nav5">
            <ul>
                @if (Route::has('admin.curriculum.index'))
                  <li><a href="{{ route('admin.curriculum.index') }}">授業管理</a></li>
                @endif
                @if (Route::has('admin.article.index'))
                  <li><a href="{{ route('admin.article.index') }}">お知らせ管理</a></li>
                @endif
                @if (Route::has('admin.banner.edit'))
                  <li><a href="{{ route('admin.banner.edit') }}">バナー管理</a></li>
                @endif
            </ul>
            @if (Route::has('logout'))
            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-button">ログアウト</button>
                </form>
            </div>
            @endif
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2025 Video Learning System</p>
    </footer>
</body>
</html>
