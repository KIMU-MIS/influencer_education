<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者画面</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="admin-header">
        <nav class="admin-nav">
            <ul>
                <li><a href="{{ route('admin.curriculum.index') }}">授業管理</a></li>
                <li><a href="{{ route('admin.article.index') }}">お知らせ管理</a></li>
                <li><a href="{{ route('admin.banner.edit') }}">バナー管理</a></li>
            </ul>
            <div class="logout">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>
    </header>

    <main class="admin-content">
        @yield('content')
    </main>
</body>
</html>
