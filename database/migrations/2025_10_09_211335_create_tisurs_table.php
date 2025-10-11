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
            $table->dateTime('fecha_hora_ingreso')->nullable();
            $table->string('placa_tracto')->nullable();
            $table->dateTime('fecha_hora_salida')->nullable();
            $table->decimal('primer_peso', 10, 2)->nullable();
            $table->decimal('segundo_peso', 10, 2)->nullable();
            $table->string('razon_social')->nullable();
            $table->string('transportista')->nullable();
            $table->string('carga')->nullable();
            $table->integer('numero_bultos')->nullable();
            $table->decimal('peso_neto', 10, 2)->nullable();
            $table->string('tipo')->nullable();
            $table->string('documento_origen')->nullable();
            $table->decimal('precio', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('retencion', 10, 2)->nullable();
            $table->decimal('pago', 10, 2)->nullable();
            $table->string('factura')->nullable();
            $table->string('estado')->default('Pendiente');
            $table->string('guia_remision')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('orden')->nullable();
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
