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
        Schema::create('planta_cuidados', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_planta')
                ->constrained('plantas')
                ->onDelete('cascade');
        
            $table->foreignId('id_cuidado')
                ->constrained('cuidados')
                ->onDelete('cascade');
        
            $table->integer('frecuencia');
        
            $table->text('instrucciones_esp')->nullable();
        
            $table->string('evidencia')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planta_cuidados');
    }
};
