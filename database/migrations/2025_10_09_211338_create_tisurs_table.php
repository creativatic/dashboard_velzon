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
        Schema::create('tisurs', function (Blueprint $table) {
            $table->id();
            $table->string('numero_ticket')->unique();
            $table->foreignId('proveedor_id')
                ->nullable()
                ->constrained('proveedores')
                ->nullOnDelete();
            $table->dateTime('fecha_hora_ingreso')->nullable();
            $table->string('placa_tracto')->nullable();
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->decimal('primer_peso', 20, 5)->nullable();
            $table->decimal('segundo_peso', 20, 5)->nullable();
            $table->string('razon_social')->nullable();
            $table->string('transportista')->nullable();
            $table->string('tipo_carga_tisur')->nullable();
            $table->decimal('numero_bultos')->nullable();
            $table->decimal('peso_neto', 20, 5)->nullable();
            $table->string('tipo_plataforma')->nullable();
            $table->string('documento_origen')->nullable();
            $table->decimal('precio_tisur', 20, 5)->nullable();
            $table->decimal('total_tisur', 20, 5)->nullable();
            $table->decimal('retencion_tisur', 20, 5)->nullable();
            $table->decimal('pago_tisur', 20, 5)->nullable();
            $table->string('factura_tisur')->nullable();
            $table->string('estado')->default('Pendiente');
            $table->date('fecha_pago')->nullable();
            $table->string('orden_tisur')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tisurs');
    }
};
