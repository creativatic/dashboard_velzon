<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('adelantos', function (Blueprint $table) {
            $table->id();

            // Relación con programacions
            $table->foreignId('programacion_id')
                ->constrained('programacions')
                ->cascadeOnDelete();
            // Datos principales
            //$table->string('nro_guia_remitente', 50);
            $table->decimal('monto_adelanto', 10, 2)->default(0);
            $table->date('fecha_pago_adelantos')->nullable();
            $table->text('glosa_banco')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adelantos');
    }
};