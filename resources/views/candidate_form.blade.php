<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Работа мечты (Laravel)</title>
    <script src="https://cdn.tailwindcss.com"></script> </head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">Откликнуться (Laravel)</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('candidate.store') }}" method="POST" class="space-y-4">
            @csrf 

            <div>
                <label class="block text-gray-700">Ваше имя</label>
                <input type="text" name="username" class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Иван Иванов">
            </div>

            <div>
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" placeholder="ivan@example.com">
            </div>

            <div>
                <label class="block text-gray-700">Навыки</label>
                <textarea name="skills" class="w-full mt-1 p-2 border rounded focus:ring-2 focus:ring-blue-500 outline-none" rows="3" placeholder="PHP, Laravel, Git"></textarea>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white p-3 rounded hover:bg-red-700 transition font-bold">
                Отправить заявку
            </button>
        </form>
    </div>
    <a href="{{ route('candidate.index') }}" 
       class="fixed bottom-4 right-4 text-gray-300 hover:text-gray-600 transition duration-500 text-2xl opacity-50 hover:opacity-100"
       title="Вход для администратора">
        🔒
    </a>
</body>
</html>