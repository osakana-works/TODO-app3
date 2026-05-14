<!DOCTYPE html>
<html lang = "ja">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
    <title>@yield('title', 'Todo App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>
<body>
    <header class = "bg-[#000] text-[#fff] p-4">
        @auth
            <a href = "/" class = "text-2xl font-bold no-underline">Todo</a>
            <a href = "/categories" class = "ml-4 no-underline">カテゴリー</a>
            <a href = "/dashboard" class = "ml-4 no-underline">ダッシュボード</a>

            <form method = "POST" action = "/logout" class = "inline ml-4">
                @csrf
                <button type = "submit" class = "text-red-500">ログアウト</button>
            </form>
        @else
            <a href = "/login" class = "ml-4 no-underline">ログイン</a>
            <a href = "/register" class = "ml-4 no-underline">登録</a>
        @endauth
    </header>
    
    <main class = "p-6">
        @yield('content')
    </main>

    <footer class = "text-center text-gray-500 py-4">
        <p>&copy; 2026 Todo App</p>
    </footer>
</body>
</html>
