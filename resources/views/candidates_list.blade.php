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
            <th class="py-3 px-6 text-center w-10">ID</th>
            <th class="py-3 px-6 text-left">Кандидат</th>
            <th class="py-3 px-6 text-center">Статус</th>
            <th class="py-3 px-6 text-center">Дата</th>
            <th class="py-3 px-6 text-center">Действия</th>
        </tr>
    </thead>
    <tbody class="text-gray-600 text-sm font-light">
        @foreach($candidates as $candidate)
        
        <tr class="border-b border-gray-200 hover:bg-gray-100 transition
            {{ $candidate->status === 'accepted' ? 'bg-green-50' : '' }} 
            {{ $candidate->status === 'rejected' ? 'bg-red-50' : '' }}">
            
            <td class="py-3 px-6 text-center whitespace-nowrap font-bold">
                {{ $candidate->id }}
            </td>

            <td class="py-3 px-6 text-left">
                <div class="flex items-center">
                    <div>
                        <span class="font-medium text-base text-gray-800">{{ $candidate->username }}</span>
                        <br>
                        <span class="text-xs text-gray-500">{{ $candidate->email }}</span>
                        <details class="mt-2 group">
                            <summary class="cursor-pointer text-xs text-blue-500 hover:text-blue-700 font-bold select-none list-none flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                
                                Комментарии ({{ $candidate->comments->count() }})
                            </summary>
                            
                            <div class="mt-2 p-2 bg-gray-50 rounded border border-blue-100">
                                @foreach($candidate->comments as $comment)
                                    <div class="text-xs text-gray-700 mb-1 border-b border-gray-200 pb-1 last:border-0">
                                        <span class="font-bold text-gray-500">{{ $comment->created_at->format('d.m H:i') }}:</span>
                                        {{ $comment->body }}
                                    </div>
                                @endforeach

                                <form action="{{ route('comment.store', $candidate->id) }}" method="POST" class="mt-2 flex gap-1">
                                    @csrf
                                    <input type="text" name="body" placeholder="Написать заметку..." required
                                        class="w-full text-xs p-1 border rounded focus:outline-none focus:border-blue-500">
                                    <button type="submit" class="bg-blue-500 text-white text-xs px-2 py-1 rounded hover:bg-blue-600">
                                        ➤
                                    </button>
                                </form>
                            </div>
                        </details>
                    </div>
                </div>
            </td>

            <td class="py-3 px-6 text-center">
                @if($candidate->status === 'new')
                    <span class="bg-blue-200 text-blue-700 py-1 px-3 rounded-full text-xs">Новый</span>
                @elseif($candidate->status === 'accepted')
                    <span class="bg-green-200 text-green-700 py-1 px-3 rounded-full text-xs">Принят</span>
                @elseif($candidate->status === 'rejected')
                    <span class="bg-red-200 text-red-700 py-1 px-3 rounded-full text-xs">Отклонен</span>
                @endif
            </td>

            <td class="py-3 px-6 text-center whitespace-nowrap">
                {{ $candidate->created_at->diffForHumans() }}
            </td>

            <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center gap-2">
                    
                   <form action="{{ route('candidate.status', $candidate->id) }}" method="POST">
                        @csrf
                        <button type="submit" name="status" value="accepted" title="Принять" 
                            class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center hover:bg-emerald-200 hover:scale-110 transition transform">
                            <span class="text-lg font-bold">✓</span>
                        </button>
                    </form>

                    <form action="{{ route('candidate.status', $candidate->id) }}" method="POST">
                        @csrf
                        <button type="submit" name="status" value="rejected" title="Отклонить" 
                            class="w-8 h-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-300 hover:scale-110 transition transform">
                            <span class="text-lg font-bold">✕</span>
                        </button>
                    </form>

                    <form action="{{ route('candidate.destroy', $candidate->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Удалить?')" title="Удалить" 
                            class="w-8 h-8 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center hover:bg-rose-200 hover:scale-110 transition transform">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </form>

                </div>
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