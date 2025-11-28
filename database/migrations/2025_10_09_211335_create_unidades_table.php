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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('placa_tracto', 20)->nullable();
            $table->string('placa_carreta', 20)->nullable();
            $table->string('marca_vehiculo', 50)->nullable();
            $table->string('tipo_plataforma', 50)->nullable();
            $table->string('constancia_mtc_tracto', 100)->nullable();
            $table->string('constancia_mtc_carreta', 100)->nullable();
        
            // 🌟 AÑADIR ESTA LÍNEA PARA SOFT DELETES
            $table->softDeletes();

            $table->foreignId('proveedor_id')
                    ->nullable()
                    ->constrained('proveedores')
                    ->nullOnDelete();
  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};