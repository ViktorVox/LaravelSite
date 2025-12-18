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
        // ПРОВЕРКА: Есть ли у человека пропуск?
        if (!session('is_admin')) {
            // Если нет - возвращаем его на страницу входа
            return redirect()->route('login.form');
        }

        // Если есть - показываем список
        $candidates = Candidate::orderBy('created_at', 'desc')->get();
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
}
