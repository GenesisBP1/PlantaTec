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
        Schema::create('registro_cuidados', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_adopcion')
                ->constrained('adopciones')
                ->onDelete('cascade');
        
            $table->foreignId('id_planta_cuidado')
                ->constrained('planta_cuidados')
                ->onDelete('cascade');
        
            $table->dateTime('fecha')->useCurrent();
        
            $table->string('imagen')->nullable();
        
            $table->text('descripcion')->nullable();
        
            $table->string('estado_observado')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registro_cuidados');
    }
};
