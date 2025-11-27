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
            $table->dateTime('fecha_programacion');
            $table->string('guia_remision', 100)->nullable();
            
            $table->string('tipo_mineral', 50)->nullable();
            $table->enum('tipo_operacion', ['nacional', 'internacional'])->nullable(); // ← Cambiado
            $table->enum('conformidad_adelanto', ['Ok', 'Pendiente'])->nullable(); // ← Cambiado
            $table->string('guia_transportista', 50)->nullable();
            $table->string('grupo_cargio', 100)->nullable();
               
            $table->decimal('monto_adelanto', 10, 2)->default(0);
            $table->date('fecha_pago_adelantos')->nullable();
            $table->text('glosa_banco')->nullable();
            $table->text('notas')->nullable();

            $table->foreignId('detalle_programacion_id')
                ->nullable()
                ->constrained('detalle_programacions')
                ->nullOnDelete();
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
        Schema::dropIfExists('programacions');
    }
};
