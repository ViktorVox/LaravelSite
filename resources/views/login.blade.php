<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход для персонала</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex items-center justify-center h-screen">
    <div class="bg-gray-800 p-8 rounded-lg shadow-lg text-center w-full max-w-sm">
        <h2 class="text-white text-xl mb-4">🔒 Доступ закрыт</h2>
        
        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500 text-red-200 text-sm p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.check') }}" method="POST">
            @csrf
            <input type="password" name="password" placeholder="Пароль админа" 
                   class="w-full p-2 rounded border border-gray-600 bg-gray-700 text-white outline-none focus:border-blue-500 mb-4 transition">
            
            <button class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-500 transition font-bold">
                Войти
            </button>
        </form>

        <div class="mt-4 pt-4 border-t border-gray-700">
            <a href="{{ route('candidate.create') }}" class="text-gray-400 hover:text-white text-sm transition flex items-center justify-center gap-1">
                <span>←</span> Вернуться на главную
            </a>
        </div>
        </div>
</body>
</html>