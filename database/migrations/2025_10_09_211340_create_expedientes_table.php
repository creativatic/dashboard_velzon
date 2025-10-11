<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('expedientes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tisur_id')
                ->nullable()
                ->constrained('tisurs')
                ->nullOnDelete();

            $table->foreignId('programacion_id')
                ->nullable()
                ->constrained('programacions')
                ->nullOnDelete();

            $table->date('fecha_carga')->nullable();
            $table->string('guia_remitente')->nullable();
            $table->string('placa_tracto')->nullable();
            $table->string('placa_carreta')->nullable();
            $table->string('razon_social_empresa')->nullable();
            $table->string('ruc')->nullable();
            $table->string('conductor')->nullable();
            $table->string('licencia')->nullable();
            $table->string('telefono')->nullable();
            $table->string('cuenta_banco')->nullable();
            $table->string('cci_banco')->nullable();
            $table->string('banco')->nullable();
            $table->string('guia_transportista')->nullable();
            $table->string('material')->nullable();
            $table->string('numero_ticket')->nullable();
            $table->string('guia_remision')->nullable();
            $table->string('numero_factura')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->decimal('peso_entrada', 10, 2)->nullable();
            $table->decimal('segundo_pesaje', 10, 2)->nullable();
            $table->decimal('peso_neto', 10, 2)->nullable();
            $table->decimal('costo_tn', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('detraccion', 10, 2)->nullable();
            $table->string('estado_pago_detraccion')->nullable();
            $table->decimal('total_con_detraccion', 10, 2)->nullable();
            $table->decimal('deposito_a_proveer', 10, 2)->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('conformidad')->nullable();
            $table->string('grupo_carguio')->nullable();
            $table->string('archivo')->nullable();
            $table->string('frente')->nullable();
            $table->string('glosa_bancos')->nullable();
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
