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
        Schema::create('volquetes', function (Blueprint $table) {
            $table->id();

            // Fecha principal del servicio
            $table->date('fecha')->nullable();

            // Relación principal (Unidad)
            $table->foreignId('proveedor_id')
                  ->nullable()
                  ->constrained('proveedores')
                  ->nullOnDelete();

            // Relación con los frentes (detalle_programacions)
            $table->foreignId('detalle_programacion_id')
                  ->nullable()
                  ->constrained('detalle_programacions')
                  ->nullOnDelete();

            // ----------- Datos Vuelta 1 -----------
            $table->time('hora_vuelta_1')->nullable();
            $table->integer('lampadas_vuelta_1')->nullable();
            $table->decimal('peso_vuelta_1', 10, 2)->nullable();

            // ----------- Datos Vuelta 2 -----------
            $table->time('hora_vuelta_2')->nullable();
            $table->integer('lampadas_vuelta_2')->nullable();
            $table->decimal('peso_vuelta_2', 10, 2)->nullable();

            // ----------- Totales del día -----------
            $table->string('conformidad')->nullable();
            $table->integer('total_lampadas_dia')->nullable();
            $table->decimal('total_peso_dia', 10, 2)->nullable();

            // ----------- Costos y Cálculos -----------
            $table->integer('pasadas')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('detraccion', 10, 2)->nullable();
            $table->decimal('retencion', 10, 2)->nullable();
            $table->decimal('deposito_a_proveer', 10, 2)->nullable();
            $table->decimal('deposito_total', 10, 2)->nullable();

            // Pago
            $table->date('fecha_pago')->nullable();
            $table->string('factura')->nullable();
            
            $table->string('comprobante_pago')->nullable();

            // Observaciones
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volquetes');
    }
};
