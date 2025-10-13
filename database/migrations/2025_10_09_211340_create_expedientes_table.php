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

            // Campos propios del expediente
            $table->string('numero_ticket')->nullable();
            $table->string('numero_factura')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('detraccion', 10, 2)->nullable();
            $table->string('estado_pago_detraccion', 50)->nullable();
            $table->decimal('total_con_detraccion', 10, 2)->nullable();
            $table->date('fecha_pago')->nullable();
            $table->string('conformidad', 100)->nullable();
            $table->string('archivo')->nullable();

            // Campos opcionales adicionales de control
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('expedientes');
    }
};
