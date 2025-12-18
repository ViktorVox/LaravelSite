<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список кандидатов</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
        
        <div class="p-6 bg-gray-800 flex justify-between items-center">
            <h1 class="text-xl font-bold text-white">Список заявок ({{ count($candidates) }})</h1>
            
            <div class="flex gap-4">
                <a href="{{ route('candidate.create') }}" class="text-gray-300 hover:text-white text-sm py-2">
                    ← На главную
                </a>

                <a href="{{ route('candidate.logout') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500 text-sm font-bold shadow-md transition">
                    Выйти 🔒
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6">ID</th>
                        <th class="py-3 px-6">Имя</th>
                        <th class="py-3 px-6">Email</th>
                        <th class="py-3 px-6">Навыки</th>
                        <th class="py-3 px-6">Дата</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($candidates as $candidate)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 font-bold">{{ $candidate->id }}</td>
                            <td class="py-3 px-6">{{ $candidate->username }}</td>
                            <td class="py-3 px-6">{{ $candidate->email }}</td>
                            <td class="py-3 px-6 max-w-xs cursor-pointer transition-all duration-300" 
                                onclick="this.querySelector('p').classList.toggle('truncate');"
                                title="Кликни, чтобы развернуть">
                                
                                <div class="bg-blue-100 text-blue-800 py-1 px-3 rounded-lg text-xs">
                                    <p class="truncate font-mono">
                                        {{ $candidate->skills }}
                                    </p>
                                </div>
                            </td>
                            <td class="py-3 px-6">
                                {{ $candidate->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        @if(count($candidates) == 0)
            <div class="p-6 text-center text-gray-500">
                Пока нет ни одной заявки.
            </div>
        @endif

    </div>

</body>
</html>