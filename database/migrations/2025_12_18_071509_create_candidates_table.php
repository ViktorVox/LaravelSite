<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
        $table->id(); // Это авто-ID
        $table->string('username'); // Строка
        $table->string('email');
        $table->text('skills')->nullable(); // Текст, может быть пустым
        $table->timestamps(); // Автоматически создаст created_at и updated_at
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
