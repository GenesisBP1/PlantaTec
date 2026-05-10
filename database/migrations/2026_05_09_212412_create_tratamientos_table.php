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
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('id_problema')
                ->constrained('problemas')
                ->onDelete('cascade');
        
            $table->foreignId('id_planta')
                ->constrained('plantas')
                ->onDelete('cascade');
        
            $table->text('descripcion')->nullable();
        
            $table->text('indicaciones')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamientos');
    }
};
