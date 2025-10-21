<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detalle_programacions', function (Blueprint $table) {
            $table->id();

            $table->string('frente');
            $table->decimal('precio_frente', 10, 2);
            $table->decimal('precio_tn', 10, 4);
            $table->boolean('activo')->default(true);
            $table->text('descripcion')->nullable();
            $table->timestamps();
            
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detalle_programacions');
    }
};