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
            $table->string('nro_guia_remitente', 50);
            $table->string('placa', 20);
            $table->string('razon_social', 100);
            $table->string('ruc', 11);
            $table->string('conductor', 100);
            $table->string('telefono', 20)->nullable();
            $table->string('cuenta_banco', 50)->nullable();
            $table->string('cci_banco', 50)->nullable();
            $table->string('banco', 50)->nullable();
            $table->string('frente', 50)->nullable();
            $table->string('material', 50)->nullable();
            $table->decimal('monto_adelanto', 10, 2)->default(0);
            $table->date('fecha_pago')->nullable();
            $table->string('grupo', 50)->nullable();
            $table->text('glosa_banco')->nullable();
            $table->text('notas')->nullable();

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('adelantos');
    }
};