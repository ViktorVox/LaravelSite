<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;

class CandidateController extends Controller
{
    // Показать форму входа
    public function login() {
        return view('login');
    }

    // Проверить пароль
    public function checkPassword(Request $request) {
        // Условный пароль "admin123"
        if ($request->password === 'admin123') {
            // Если верно - выдаем "пропуск" (записываем в сессию)
            session(['is_admin' => true]); 
            return redirect()->route('candidate.index');
        }

        return back()->with('error', 'Неверный пароль!');
    }

    // Показать список
    public function index() {
        if (!session('is_admin')) {
            return redirect()->route('login.form');
        }

        $candidates = Candidate::with('comments')->orderBy('created_at', 'desc')->get();
        return view('candidates_list', ['candidates' => $candidates]);
    }

    // Показать форму
    public function create() {
        return view('candidate_form');
    }

    // Сохранить данные
    public function store(Request $request) {
        // Проверка
        $validated = $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email',
            'skills' => 'nullable',
        ]);

        // Сохраняем в базу
        Candidate::create($validated);

        // Сообщение об успехе
        return back()->with('success', 'Заявка успешно отправлена');
    }

    // Метод выхода
    public function logout() {
        // Удаляем метку из сессии
        session()->forget('is_admin');
        
        // Перенаправляем на форму входа с сообщением
        return redirect()->route('login.form')->with('error', 'Вы вышли из системы.');
    }

    // Метод изменения статуса
    public function updateStatus(Request $request, $id) {
        $candidate = Candidate::findOrFail($id);
        $newStatus = $request->input('status');

        if (in_array($newStatus, ['accepted', 'rejected'])) {
            $candidate->update([
                'status' => $newStatus
            ]);
            
            return back()->with('success', 'Статус кандидата обновлен!');
        }
        
        return back()->with('error', 'Некорректный статус');
    }

    public function destroy($id) {
        Candidate::findOrFail($id)->delete();
        return back()->with('success', 'Кандидат удален');
    }
    
    public function storeComment(Request $request, $id) {
        $request->validate([
            'body' => 'required|max:500'
        ]);

        $candidate = Candidate::findOrFail($id);
        $candidate->comments()->create([
            'body' => $request->input('body')
        ]);
    
        return back()->with('success', 'Комментарий добавлен');
    }
}
