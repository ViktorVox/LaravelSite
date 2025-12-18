<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    // Разрешаем заполнение полей
    protected $fillable = ['username', 'email', 'skills'];
}
