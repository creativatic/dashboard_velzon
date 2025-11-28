<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conductor_unidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conductor_id')
                ->constrained('conductores')
                ->cascadeOnDelete();
            $table->foreignId('unidad_id')
                ->constrained('unidades')
                ->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['conductor_id', 'unidad_id']); // Evita duplicados
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conductor_unidad');
    }
};
