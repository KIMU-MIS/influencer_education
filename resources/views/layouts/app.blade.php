<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'タイトル')</title>
    
</head>
<body>

    <!-- 共通ヘッダー -->
    <header class="header">
        <div class="header-left">
            <button class="nav-button">授業管理</button>
            <button class="nav-button">お知らせ管理</button>
            <button class="nav-button">バナー管理</button>
        </div>
        <div class="header-right">
            <button class="logout-button">ログアウト</button>
        </div>
    </header>

    <!-- 各ページのコンテンツ -->
    <main>
        @yield('content')
    </main>

</body>
</html>

<style>
    /* ヘッダー */
.header {
    position: relative; 
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #83d8f5ff;
    padding: 20px 20px;
}

.header-left .nav-button{
    margin-right: 10px;
    padding: 8px 16px;
    background-color: #424647ff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.header-right .logout-button {
    margin-right: 10px;
    padding: 8px 16px;
    background-color: #83d8f5ff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.header-right {
    display: flex;
    align-items: center;
}
</style>
