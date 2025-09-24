<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'タイトル')</title>

    <!-- 共通CSSはhead内に -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- 共通ヘッダー -->
    <header class="header">
        <div class="header-left">
            @yield('header-left')
        </div>
        <div class="header-right">
            @yield('header-right')
        </div>
    </header>

    <!-- ページごとのコンテンツ -->
    <main>
        @yield('content')
    </main>

    <!-- 共通JSはbodyの最後に -->
    <script src="{{ asset('js/banner.js') }}" defer></script>
    @stack('scripts')

</body>
</html>
