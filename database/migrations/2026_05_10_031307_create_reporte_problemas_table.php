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
        Schema::create('reporte_problemas', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_adopcion')
                ->constrained('adopciones')
                ->onDelete('cascade');
        
            $table->foreignId('id_problema')
                ->constrained('problemas')
                ->onDelete('cascade');
        
            $table->text('descripcion')->nullable();
        
            $table->enum('gravedad', ['leve', 'media', 'grave'])->default('leve');
        
            $table->enum('estado', ['activo', 'en_revision', 'resuelto'])->default('activo');
        
            $table->string('imagen')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_problemas');
    }
};
