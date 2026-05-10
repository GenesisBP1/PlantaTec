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
        Schema::create('recomendaciones_cuidado', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_adopcion')
                ->constrained('adopciones')
                ->onDelete('cascade');
        
            $table->foreignId('id_planta_cuidado')
                ->constrained('planta_cuidados')
                ->onDelete('cascade');
        
            $table->text('mensaje');
        
            $table->enum('prioridad', [
                'baja',
                'media',
                'alta',
                'urgente'
            ])->default('media');
        
            $table->enum('estado', [
                'pendiente',
                'atendida',
                'descartada'
            ])->default('pendiente');
        
            $table->dateTime('fecha_generada')->useCurrent();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recomendacion_cuidados');
    }
};
