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
        Schema::create('programacions', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_progracion');
            $table->string('dni', 8)->nullable();
            $table->string('guia_remision', 100)->nullable();
            $table->string('placa_tracto', 20)->nullable();
            $table->string('placa_carreta', 20)->nullable();
            $table->string('marca_vehiculo', 50)->nullable();
            $table->string('tipo_plataforma', 50)->nullable();
            $table->string('constancia_mtc_tracto', 100)->nullable();
            $table->string('constancia_mtc_carreta', 100)->nullable();
            $table->string('razon_social_transporte', 100)->nullable();
            $table->string('ruc_transporte', 11)->nullable();
            //$table->string('conductor_nombres_apell', 100)->nullable();
            $table->string('nombres_conductor', 100)->nullable();
            $table->string('apellidos_conductor', 100)->nullable();
            $table->string('licencia', 20)->nullable();
            $table->string('telefono_conductor', 20)->nullable();
            $table->string('cuenta_banco', 50)->nullable();
            $table->string('cci_banco', 50)->nullable();
            $table->string('banco', 50)->nullable();
            $table->string('tipo_mineral', 50)->nullable();
            $table->enum('tipo_operacion', ['nacional', 'internacional'])->nullable(); // ← Cambiado
            $table->string('conformidad_adelanto', 50)->nullable();
            $table->string('guia_transportista', 50)->nullable();
            $table->string('grupo_cargio', 100)->nullable();
            $table->foreignId('detalle_programacion_id')
                ->nullable()
                ->constrained('detalle_programacions')
                ->nullOnDelete();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programacions');
    }
};
