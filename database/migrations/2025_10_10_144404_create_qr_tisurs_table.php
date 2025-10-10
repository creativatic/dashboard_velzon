<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_tisurs', function (Blueprint $table) {
            $table->id();

            // Relación con programacions
            $table->foreignId('programacion_id')
                ->constrained('programacions')
                ->cascadeOnDelete();

            // Datos principales
            $table->string('placa_tracto', 20);
            $table->string('licencia', 20);
            $table->string('dni', 8);
            $table->string('nombres_conductor', 100);
            $table->string('apellidos_conductor', 100);
            $table->string('ruc_transporte', 11);
            $table->string('razon_social_transporte', 100);
            $table->string('nacional', 50)->nullable();
            $table->string('placa_carreta', 20)->nullable();
            $table->string('guia_remision', 50)->nullable();
            $table->string('grupo', 50)->nullable();

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_tisurs');
    }
};
