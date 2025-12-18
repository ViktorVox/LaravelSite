<?php

use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

// Страница входа
Route::get('/admin-login', [CandidateController::class, 'login'])->name('login.form');
Route::post('/admin-login', [CandidateController::class, 'checkPassword'])->name('login.check');
Route::get('/logout', [CandidateController::class, 'logout'])->name('candidate.logout');

// Показать форму
Route::get('/candidate', [CandidateController::class, 'create'])->name('candidate.create');

// Сохранить данные
Route::post('/candidate', [CandidateController::class, 'store'])->name('candidate.store');

// Показать список
Route::get('/candidates-list', [CandidateController::class, 'index'])->name('candidate.index');
